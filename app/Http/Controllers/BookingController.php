<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use App\Models\BookingLawyer;
use App\Models\BookingTimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function dashboard(Request $request)
    {
        $filters = [
            'keyword' => trim((string) $request->query('keyword', '')),
            'specialty' => trim((string) $request->query('specialty', '')),
        ];

        $lawyers = BookingLawyer::query()
            ->lawyer()
            ->with('lawyerProfile')
            ->when($filters['keyword'] !== '', function ($query) use ($filters) {
                $query->where(function ($nestedQuery) use ($filters) {
                    $nestedQuery->where('name', 'like', "%{$filters['keyword']}%")
                        ->orWhereHas('lawyerProfile', function ($profileQuery) use ($filters) {
                            $profileQuery->where('expertise', 'like', "%{$filters['keyword']}%")
                                ->orWhere('bio', 'like', "%{$filters['keyword']}%");
                        });
                });
            })
            ->when($filters['specialty'] !== '', function ($query) use ($filters) {
                $query->whereHas('lawyerProfile', function ($profileQuery) use ($filters) {
                    $profileQuery->where('expertise', 'like', "%{$filters['specialty']}%");
                });
            })
            ->get()
            ->filter(fn ($lawyer) => $lawyer->is_active)
            ->values();

        $upcomingAppointments = BookingAppointment::query()
            ->where('customer_id', auth()->id())
            ->where('status', '!=', 'CANCELLED')
            ->where('scheduled_start_at', '>=', now())
            ->with('lawyer.lawyerProfile')
            ->orderBy('scheduled_start_at')
            ->take(5)
            ->get();

        $specialties = $lawyers
            ->map(fn ($lawyer) => $lawyer->specialty)
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('dashboard', compact('filters', 'lawyers', 'upcomingAppointments', 'specialties'));
    }

    public function showBookingForm(BookingLawyer $lawyer)
    {
        abort_unless($lawyer->is_active && (int) $lawyer->role_id === 2, 404);

        $availableSlots = $lawyer->timeSlots()
            ->where('status', 'OPEN')
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->take(30)
            ->get();

        return view('appointments.book', [
            'lawyer' => $lawyer,
            'availableSlots' => $availableSlots,
            'user' => auth()->user(),
        ]);
    }

    public function storeAppointment(Request $request, BookingLawyer $lawyer)
    {
        abort_unless($lawyer->is_active && (int) $lawyer->role_id === 2, 404);

        $validated = $request->validate([
            'slot_id' => ['required', 'integer'],
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'issue_summary' => ['nullable', 'string', 'max:2000'],
        ]);

        $appointment = DB::transaction(function () use ($validated, $lawyer) {
            $slot = BookingTimeSlot::query()
                ->where('id', $validated['slot_id'])
                ->where('lawyer_id', $lawyer->id)
                ->where('status', 'OPEN')
                ->where('start_time', '>=', now())
                ->lockForUpdate()
                ->first();

            if (! $slot) {
                return null;
            }

            $slot->update(['status' => 'BOOKED']);

            $fee = (float) $lawyer->consultation_fee;

            return BookingAppointment::create([
                'booking_code' => 'BK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                'lawyer_id' => $lawyer->id,
                'customer_id' => auth()->id(),
                'slot_id' => $slot->id,
                'status' => 'CONFIRMED',
                'consultation_topic' => 'Tư vấn pháp lý',
                'consultation_summary' => $validated['issue_summary'] ?? null,
                'scheduled_start_at' => $slot->start_time,
                'scheduled_end_at' => $slot->end_time,
                'timezone' => 'Asia/Ho_Chi_Minh',
                'price_amount' => $fee,
                'deposit_amount' => $fee > 0 ? round($fee * 0.3, 2) : 0,
                'final_amount' => $fee,
                'customer_note' => trim(implode(' | ', [
                    'Người đặt: ' . $validated['customer_name'],
                    'Email: ' . $validated['customer_email'],
                    'Điện thoại: ' . $validated['customer_phone'],
                ])),
            ]);
        });

        if (! $appointment) {
            return back()
                ->withInput()
                ->withErrors(['slot_id' => 'Khung giờ này vừa được đặt. Vui lòng chọn khung giờ khác.']);
        }

        return redirect()
            ->route('appointments.confirmation', $appointment)
            ->with('status', 'Đặt lịch thành công.');
    }

    public function confirmation(BookingAppointment $appointment)
    {
        $this->ensureAppointmentOwner($appointment);

        $appointment->load('lawyer.lawyerProfile', 'customer');

        return view('appointments.confirmation', compact('appointment'));
    }

    public function index()
    {
        $appointments = BookingAppointment::query()
            ->where('customer_id', auth()->id())
            ->with('lawyer.lawyerProfile', 'customer')
            ->orderByDesc('scheduled_start_at')
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function cancel(BookingAppointment $appointment)
    {
        $this->ensureAppointmentOwner($appointment);

        if ($appointment->status === 'CANCELLED') {
            return back()->with('status', 'Lịch hẹn đã được hủy trước đó.');
        }

        DB::transaction(function () use ($appointment) {
            $appointment->update([
                'status' => 'CANCELLED',
                'cancelled_at' => now(),
                'cancelled_by_user_id' => auth()->id(),
            ]);

            if ($appointment->slot_id) {
                BookingTimeSlot::query()
                    ->where('id', $appointment->slot_id)
                    ->update(['status' => 'OPEN']);
            }
        });

        return back()->with('status', 'Đã hủy lịch hẹn thành công.');
    }

    private function ensureAppointmentOwner(BookingAppointment $appointment): void
    {
        abort_unless((int) $appointment->customer_id === (int) auth()->id(), 403);
    }
}

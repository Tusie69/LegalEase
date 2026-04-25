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
            'location' => trim((string) $request->query('location', '')),
        ];

        $lawyers = BookingLawyer::query()
            ->where('is_active', true)
            ->when($filters['keyword'] !== '', function ($query) use ($filters) {
                $query->where(function ($nestedQuery) use ($filters) {
                    $nestedQuery->where('display_name', 'like', "%{$filters['keyword']}%")
                        ->orWhere('specialty', 'like', "%{$filters['keyword']}%")
                        ->orWhere('bio', 'like', "%{$filters['keyword']}%");
                });
            })
            ->when($filters['specialty'] !== '', fn ($query) => $query->where('specialty', $filters['specialty']))
            ->when($filters['location'] !== '', fn ($query) => $query->where('location', $filters['location']))
            ->withCount([
                'timeSlots as available_slots_count' => fn ($query) => $query
                    ->where('is_booked', false)
                    ->where('start_at', '>=', now()),
            ])
            ->with([
                'timeSlots' => fn ($query) => $query
                    ->where('is_booked', false)
                    ->where('start_at', '>=', now())
                    ->orderBy('start_at')
                    ->limit(3),
            ])
            ->orderByDesc('rating')
            ->paginate(9)
            ->withQueryString();

        $upcomingAppointments = BookingAppointment::query()
            ->where('customer_user_id', auth()->id())
            ->where('status', '!=', 'CANCELLED')
            ->where('appointment_start_at', '>=', now())
            ->with('lawyer')
            ->orderBy('appointment_start_at')
            ->take(5)
            ->get();

        $specialties = BookingLawyer::query()
            ->where('is_active', true)
            ->select('specialty')
            ->distinct()
            ->orderBy('specialty')
            ->pluck('specialty');

        $locations = BookingLawyer::query()
            ->where('is_active', true)
            ->select('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('dashboard', compact(
            'filters',
            'lawyers',
            'upcomingAppointments',
            'specialties',
            'locations',
        ));
    }

    public function showBookingForm(BookingLawyer $lawyer)
    {
        abort_unless($lawyer->is_active, 404);

        $availableSlots = $lawyer->timeSlots()
            ->where('is_booked', false)
            ->where('start_at', '>=', now())
            ->orderBy('start_at')
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
        abort_unless($lawyer->is_active, 404);

        $validated = $request->validate([
            'slot_id' => ['required', 'integer'],
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'issue_summary' => ['nullable', 'string', 'max:2000'],
        ], [
            'slot_id.required' => 'Vui lòng chọn khung giờ hẹn.',
            'slot_id.integer' => 'Khung giờ không hợp lệ.',
            'customer_name.required' => 'Vui lòng nhập họ và tên.',
            'customer_name.max' => 'Họ và tên không được vượt quá 150 ký tự.',
            'customer_email.required' => 'Vui lòng nhập email.',
            'customer_email.email' => 'Email không hợp lệ.',
            'customer_email.max' => 'Email không được vượt quá 255 ký tự.',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại.',
            'customer_phone.max' => 'Số điện thoại không được vượt quá 30 ký tự.',
            'issue_summary.max' => 'Mô tả vấn đề không được vượt quá 2000 ký tự.',
        ]);

        $appointment = DB::transaction(function () use ($validated, $lawyer) {
            $slot = BookingTimeSlot::query()
                ->where('id', $validated['slot_id'])
                ->where('booking_lawyer_id', $lawyer->id)
                ->where('is_booked', false)
                ->where('start_at', '>=', now())
                ->lockForUpdate()
                ->first();

            if (! $slot) {
                return null;
            }

            $slot->update(['is_booked' => true]);

            return BookingAppointment::create([
                'booking_code' => 'BK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                'customer_user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'booking_lawyer_id' => $lawyer->id,
                'booking_time_slot_id' => $slot->id,
                'appointment_start_at' => $slot->start_at,
                'appointment_end_at' => $slot->end_at,
                'issue_summary' => $validated['issue_summary'] ?? null,
                'status' => 'CONFIRMED',
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

        $appointment->load('lawyer');

        return view('appointments.confirmation', compact('appointment'));
    }

    public function index()
    {
        $appointments = BookingAppointment::query()
            ->where('customer_user_id', auth()->id())
            ->with('lawyer')
            ->orderByDesc('appointment_start_at')
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
            ]);

            if ($appointment->booking_time_slot_id) {
                BookingTimeSlot::query()
                    ->where('id', $appointment->booking_time_slot_id)
                    ->update(['is_booked' => false]);
            }
        });

        return back()->with('status', 'Đã hủy lịch hẹn thành công.');
    }

    private function ensureAppointmentOwner(BookingAppointment $appointment): void
    {
        abort_unless((int) $appointment->customer_user_id === (int) auth()->id(), 403);
    }
}

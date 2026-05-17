<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use App\Models\BookingLawyer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index()
    {
        abort_unless((int) auth()->user()->role_id === 1, 403);

        $now = now();

        $stats = [
            'total_users' => User::count(),
            'total_lawyers' => BookingLawyer::query()->lawyer()->where('status', 'ACTIVE')->count(),
            'total_customers' => User::where('role_id', 3)->count(),
            'total_appointments' => BookingAppointment::count(),
            'today_appointments' => BookingAppointment::whereDate('scheduled_start_at', $now->toDateString())->count(),
            'upcoming_appointments' => BookingAppointment::where('status', 'CONFIRMED')
                ->where('scheduled_start_at', '>=', $now)
                ->count(),
            'pending_appointments' => BookingAppointment::whereIn('status', ['PENDING', 'PAYMENT_PENDING'])->count(),
            'completed_appointments' => BookingAppointment::where('status', 'COMPLETED')->count(),
            'cancelled_appointments' => BookingAppointment::where('status', 'CANCELLED')->count(),
            'revenue_vnd' => BookingAppointment::where('status', 'COMPLETED')->sum('final_amount'),
            'unread_notifications' => Schema::hasTable('notifications')
                ? (int) \DB::table('notifications')->where('is_read', 0)->count()
                : 0,
            'paid_payments' => Schema::hasTable('payments')
                ? (int) \DB::table('payments')->whereIn('status', ['PAID', 'COMPLETED'])->count()
                : 0,
        ];

        $recentAppointments = BookingAppointment::with('lawyer.lawyerProfile', 'customer', 'payments')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $statusCounts = BookingAppointment::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.index', [
            'stats' => $stats,
            'recentAppointments' => $recentAppointments,
            'statusCounts' => $statusCounts,
        ]);
    }

    public function confirmAppointment(BookingAppointment $appointment): RedirectResponse
    {
        abort_unless((int) auth()->user()->role_id === 1, 403);
        abort_unless($appointment->status === 'PENDING', 422);

        $appointment->forceFill([
            'status' => 'CONFIRMED',
        ])->save();

        return redirect()
            ->route('admin.index')
            ->with('status', 'Appointment ' . $appointment->booking_code . ' confirmed.');
    }
}

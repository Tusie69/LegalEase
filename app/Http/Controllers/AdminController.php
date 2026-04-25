<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use App\Models\BookingLawyer;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        abort_unless((int) auth()->user()->role_id === 1, 403);

        $now = now();

        $stats = [
            'total_users' => User::count(),
            'total_lawyers' => BookingLawyer::where('is_active', true)->count(),
            'total_appointments' => BookingAppointment::count(),
            'today_appointments' => BookingAppointment::whereDate('appointment_start_at', $now->toDateString())->count(),
            'upcoming_appointments' => BookingAppointment::where('status', 'CONFIRMED')
                ->where('appointment_start_at', '>=', $now)
                ->count(),
            'cancelled_appointments' => BookingAppointment::where('status', 'CANCELLED')->count(),
        ];

        $recentAppointments = BookingAppointment::with('lawyer')
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
}

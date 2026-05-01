<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $lawyerRoleId = DB::table('roles')->where('code', 'LAWYER')->value('id');
    $customerRoleId = DB::table('roles')->where('code', 'CUSTOMER')->value('id');

    $stats = [
        'total_lawyers' => DB::table('users')->where('role_id', $lawyerRoleId)->count(),
        'total_customers' => DB::table('users')->where('role_id', $customerRoleId)->count(),
        'total_appointments' => DB::table('appointments')->count(),
        'pending_appointments' => DB::table('appointments')->where('status', 'PENDING')->count(),
        'completed_appointments' => DB::table('appointments')->where('status', 'COMPLETED')->count(),
        'cancelled_appointments' => DB::table('appointments')->where('status', 'CANCELLED')->count(),
        'paid_payments' => DB::table('payments')->where('status', 'PAID')->count(),
        'unread_notifications' => DB::table('notifications')->where('is_read', false)->count(),
        'revenue_vnd' => (float) DB::table('appointments')
            ->whereIn('status', ['COMPLETED', 'CONFIRMED'])
            ->sum('final_amount'),
    ];

    return view('admin_view', compact('stats'));
});

Route::get('/index.html', function () {
    return redirect('/');
});

<?php

namespace App\Http\Controllers;

use App\Models\BookingAppointment;
use App\Models\BookingLawyer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminTemplateController extends Controller
{
    public function index(Request $request): View
    {
        $now = now();
        $startMonth = $now->copy()->startOfMonth()->subMonths(7);

        $stats = [
            'total_lawyers' => BookingLawyer::query()->lawyer()->where('status', 'ACTIVE')->count(),
            'total_customers' => User::query()->where('role_id', 3)->count(),
            'total_appointments' => BookingAppointment::query()->count(),
            'revenue_vnd' => BookingAppointment::query()->where('status', 'COMPLETED')->sum('final_amount'),
            'pending_appointments' => BookingAppointment::query()->where('status', 'PENDING')->count(),
            'completed_appointments' => BookingAppointment::query()->where('status', 'COMPLETED')->count(),
            'cancelled_appointments' => BookingAppointment::query()->where('status', 'CANCELLED')->count(),
            'unread_notifications' => Schema::hasTable('notifications')
                ? (int) DB::table('notifications')->where('is_read', 0)->count()
                : 0,
            'paid_payments' => Schema::hasTable('payments')
                ? (int) DB::table('payments')->whereIn('status', ['PAID', 'COMPLETED'])->count()
                : 0,
        ];

        $recentAppointments = BookingAppointment::query()
            ->with(['customer', 'lawyer'])
            ->orderByDesc('scheduled_start_at')
            ->limit(6)
            ->get()
            ->map(function (BookingAppointment $appointment): array {
                return [
                    'code' => $appointment->booking_code,
                    'customer' => $appointment->customer?->name ?? 'Khách hàng',
                    'lawyer' => $appointment->lawyer?->display_name ?? '-',
                    'time' => optional($appointment->scheduled_start_at)->format('d/m H:i') ?? '-',
                    'status' => match ($appointment->status) {
                        'COMPLETED' => 'Hoàn tất',
                        'CANCELLED' => 'Đã hủy',
                        default => 'Đang chờ',
                    },
                ];
            })
            ->values()
            ->all();

        $revenueRows = BookingAppointment::query()
            ->selectRaw("DATE_FORMAT(scheduled_start_at, '%Y-%m') as ym, COALESCE(SUM(final_amount), 0) as total")
            ->where('status', 'COMPLETED')
            ->where('scheduled_start_at', '>=', $startMonth)
            ->groupBy('ym')
            ->orderBy('ym')
            ->get()
            ->keyBy('ym');

        $monthlyRevenue = [];
        $monthlyLabels = [];
        for ($i = 0; $i < 8; $i++) {
            $month = $startMonth->copy()->addMonths($i);
            $ym = $month->format('Y-m');
            $monthlyLabels[] = 'T' . $month->format('n');
            $monthlyRevenue[] = (float) (($revenueRows[$ym]->total ?? 0) / 1000000);
        }

        $filters = [
            'id' => trim((string) $request->query('id', '')),
            'name' => trim((string) $request->query('name', '')),
        ];

        $usersQuery = User::query()->orderByDesc('id');

        if ($filters['id'] !== '') {
            $usersQuery->where('id', (int) $filters['id']);
        }

        if ($filters['name'] !== '') {
            $usersQuery->where('name', 'like', '%' . $filters['name'] . '%');
        }

        $users = $usersQuery->paginate(8)->withQueryString();

        return view('admin_view', compact(
            'stats',
            'recentAppointments',
            'monthlyRevenue',
            'monthlyLabels',
            'users',
            'filters'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.view.test')->with('success', 'Thêm người dùng thành công.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);

        return redirect()->route('admin.view.test')->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->check() && (int) auth()->id() === (int) $user->id) {
            return redirect()->route('admin.view.test')->with('error', 'Không thể xóa tài khoản đang đăng nhập.');
        }

        $user->delete();

        return redirect()->route('admin.view.test')->with('success', 'Xóa người dùng thành công.');
    }
}

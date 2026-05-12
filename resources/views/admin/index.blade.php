<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển quản trị</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        }
                    },
                    boxShadow: {
                        card: '0 10px 30px rgba(2, 6, 23, 0.05)'
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="min-h-screen lg:flex">
        <aside class="w-full border-b border-slate-200 bg-white lg:w-72 lg:border-b-0 lg:border-r">
            <div class="flex items-center justify-between px-6 py-5">
                <a href="{{ route('admin.index') }}" class="text-xl font-bold tracking-tight text-slate-900">
                    TailAdmin <span class="text-primary-600">Lite</span>
                </a>
                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Quản trị</span>
            </div>

            <nav class="space-y-1 px-3 pb-6">
                <a href="{{ route('admin.index') }}" class="flex items-center rounded-xl bg-primary-50 px-4 py-3 text-sm font-semibold text-primary-700">
                    Bảng điều khiển
                </a>
                <a href="{{ route('dashboard') }}" class="flex items-center rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-100">
                    Trang đặt lịch
                </a>
                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-left text-sm font-medium text-slate-600 hover:bg-slate-100">
                        Đăng xuất
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <header class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Bảng điều khiển quản trị</h1>
                    <p class="mt-1 text-sm text-slate-500">Tổng quan người dùng và hoạt động đặt lịch.</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-600 shadow-sm">
                    Đăng nhập bởi <span class="font-semibold">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card">
                    <p class="text-sm font-medium text-slate-500">Tổng người dùng</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format($stats['total_users']) }}</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card">
                    <p class="text-sm font-medium text-slate-500">Luật sư đang hoạt động</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format($stats['total_lawyers']) }}</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card">
                    <p class="text-sm font-medium text-slate-500">Lịch hẹn hôm nay</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format($stats['today_appointments']) }}</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card">
                    <p class="text-sm font-medium text-slate-500">Tổng lịch hẹn</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format($stats['total_appointments']) }}</p>
                </article>
            </section>

            <section class="mt-6 grid grid-cols-1 gap-4 xl:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card">
                    <h2 class="text-base font-semibold text-slate-900">Trạng thái lịch hẹn</h2>
                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between rounded-lg bg-emerald-50 px-3 py-2">
                            <span class="text-sm font-medium text-emerald-700">Đã xác nhận</span>
                            <span class="text-sm font-bold text-emerald-800">{{ (int) ($statusCounts['CONFIRMED'] ?? 0) }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-rose-50 px-3 py-2">
                            <span class="text-sm font-medium text-rose-700">Đã hủy</span>
                            <span class="text-sm font-bold text-rose-800">{{ (int) ($statusCounts['CANCELLED'] ?? 0) }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-blue-50 px-3 py-2">
                            <span class="text-sm font-medium text-blue-700">Sắp diễn ra</span>
                            <span class="text-sm font-bold text-blue-800">{{ (int) $stats['upcoming_appointments'] }}</span>
                        </div>
                    </div>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card xl:col-span-2">
                    <h2 class="text-base font-semibold text-slate-900">Lịch hẹn gần đây</h2>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-3 py-2 font-semibold">Mã</th>
                                    <th class="px-3 py-2 font-semibold">Khách hàng</th>
                                    <th class="px-3 py-2 font-semibold">Luật sư</th>
                                    <th class="px-3 py-2 font-semibold">Thời gian</th>
                                    <th class="px-3 py-2 font-semibold">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAppointments as $appointment)
                                    <tr class="border-b border-slate-100 last:border-b-0">
                                        <td class="px-3 py-3 font-semibold text-slate-800">{{ $appointment->booking_code }}</td>
                                        <td class="px-3 py-3">{{ $appointment->customer_name }}</td>
                                        <td class="px-3 py-3">{{ $appointment->lawyer->display_name ?? '-' }}</td>
                                        <td class="px-3 py-3">{{ $appointment->appointment_start_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-3 py-3">
                                            @if($appointment->status === 'CANCELLED')
                                                <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">{{ $appointment->status_label }}</span>
                                            @else
                                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">{{ $appointment->status_label }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-3 py-4 text-center text-slate-500">Chưa có dữ liệu lịch hẹn.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </article>
            </section>
        </main>
    </div>
</body>
</html>

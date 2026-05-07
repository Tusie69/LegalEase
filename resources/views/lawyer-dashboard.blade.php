@extends('layouts.app', ['title' => 'Bảng thông tin luật sư · LegalEase'])

@php
    use Illuminate\Support\Str;

    $user = auth()->user();
    $firstName = explode(' ', trim($user->name))[0];

    $appointments = collect(\App\Data\LawyerAppointments::withSessionOutcomes());

    $upcoming = $appointments->filter(function ($a) {
        $start = \Carbon\Carbon::parse($a['date'] . ' ' . $a['time']);
        return $a['status'] === 'CONFIRMED' && $start->isFuture();
    })->sortBy(fn ($a) => $a['date'] . ' ' . $a['time'])->values();

    $awaitingOutcome = $appointments->filter(function ($a) {
        $start = \Carbon\Carbon::parse($a['date'] . ' ' . $a['time']);
        return $a['status'] === 'CONFIRMED' && $start->isPast();
    })->sortByDesc('date')->values();

    $reported = $appointments->filter(function ($a) {
        return in_array($a['status'], ['COMPLETED', 'NO_SHOW_BY_CUSTOMER'], true);
    })->sortByDesc('date')->values();

    $today = \Carbon\Carbon::today('Asia/Ho_Chi_Minh');
    $todayLabel = Str::title($today->translatedFormat('l, d/m/Y'));

    $next = $upcoming->first();
    $nextStart = $next ? \Carbon\Carbon::parse($next['date'] . ' ' . $next['time'], 'Asia/Ho_Chi_Minh') : null;

    $nextDayLabel = null;
    $nextRelativeLabel = null;
    if ($nextStart) {
        $nextDayLabel = $nextStart->isToday()
            ? 'Hôm nay'
            : ($nextStart->isTomorrow() ? 'Ngày mai' : Str::title($nextStart->translatedFormat('l')));

        $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
        $minutes = (int) $now->diffInMinutes($nextStart, false);
        if ($minutes < 60) {
            $nextRelativeLabel = "Trong {$minutes} phút";
        } elseif ($minutes < 24 * 60) {
            $hours = (int) floor($minutes / 60);
            $nextRelativeLabel = "Trong {$hours} giờ";
        } else {
            $nextRelativeLabel = $nextDayLabel . ' lúc ' . $nextStart->format('H:i');
        }
    }

    $upcomingRest = $upcoming->skip(1)->values();
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 pt-24 pb-32">
    @if (session('status'))
        <div class="mb-12 rounded-2xl border border-success/40 bg-bg px-6 py-4">
            <p class="text-[14px] text-success">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <p class="text-eyebrow">{{ $todayLabel }}</p>
    <h1 class="text-page-h1 mt-3">
        Xin chào, {{ $firstName }}.
    </h1>
    <p class="text-flow-intro mt-4 max-w-[640px]">
        @if ($upcoming->isEmpty() && $awaitingOutcome->isEmpty())
            Lịch của bạn trống hôm nay. Đây là khoảng nghỉ, hoặc thời điểm để mở thêm khung giờ.
        @elseif ($next && $nextStart->isToday())
            Hôm nay bạn có {{ $upcoming->count() }} {{ $upcoming->count() === 1 ? 'cuộc hẹn' : 'cuộc hẹn' }}@if ($awaitingOutcome->isNotEmpty()), và {{ $awaitingOutcome->count() }} buổi chờ báo cáo kết quả@endif.
        @else
            Cuộc hẹn tiếp theo của bạn là {{ Str::lower($nextDayLabel) }}.
        @endif
    </p>

    @if ($next)
        <div class="mt-24">
            <div class="flex items-baseline justify-between gap-4">
                <h2 class="text-section-h2">Cuộc hẹn tiếp theo</h2>
                <p class="text-eyebrow text-accent">{{ $nextRelativeLabel }}</p>
            </div>

            <a href="{{ route('lawyer.appointments.show', $next['booking_code']) }}"
               class="group mt-8 block rounded-2xl border border-accent/30 bg-accent/5 p-8 transition-colors hover:border-accent">
                <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-bg">
                            <span class="text-card-h6 text-text">{{ $next['customer_initials'] }}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-card-h4">{{ $next['customer_name'] }}</p>
                            <p class="text-[14px]">{{ $next['customer_phone'] }}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-8">
                        <p class="text-eyebrow">Thời gian</p>
                        <p class="mt-1 font-display text-[28px] font-medium leading-tight tracking-tight md:text-[36px]">
                            {{ $nextStart->format('H:i') }}
                        </p>
                        <p class="text-[14px]">{{ $nextDayLabel }} · {{ $nextStart->format('d/m/Y') }}</p>
                    </div>

                    <div class="md:text-right">
                        <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                            <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                            <span class="text-[12px] font-medium text-success">Đã xác nhận</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endif

    {{-- Awaiting outcome --}}
    @if ($awaitingOutcome->isNotEmpty())
        <div class="mt-24">
            <h2 class="text-section-h2">Đang chờ kết quả</h2>
            <p class="mt-3 max-w-[560px] text-[16px]">
                Các cuộc hẹn này đã diễn ra. Báo cáo từng cuộc hẹn có thực hiện hay không để khách hàng có thể để lại đánh giá.
            </p>

            <div class="mt-8 space-y-4">
                @foreach ($awaitingOutcome as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-gold/40 bg-bg p-6 transition-colors hover:border-gold">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-text/10">
                                    <span class="text-[14px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-card-h5">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[14px]">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-eyebrow">Cuộc hẹn</p>
                                <p class="mt-1 text-card-h6">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('d/m/Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('H:i') }}
                                </p>
                                <p class="text-[12px]">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Action --}}
                            <p class="text-[14px] font-medium text-gold md:text-right">
                                Báo cáo kết quả →
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Upcoming --}}
    @if ($upcomingRest->isNotEmpty())
        <div class="mt-24">
            <h2 class="text-section-h2">Lịch sắp tới</h2>

            <div class="mt-8 space-y-4">
                @foreach ($upcomingRest as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block card-base transition-colors hover:border-accent">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-text/10">
                                    <span class="text-[14px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-card-h5">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[14px]">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            {{-- When --}}
                            <div class="md:flex md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-eyebrow">Cuộc hẹn</p>
                                <p class="mt-1 text-card-h6">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('d/m/Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('H:i') }}
                                </p>
                                <p class="text-[12px]">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                                    <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                                    <span class="text-[12px] font-medium text-success">Đã xác nhận</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Past --}}
    @if ($reported->isNotEmpty())
        <div class="mt-24">
            <h2 class="text-section-h2">Cuộc hẹn trước đây</h2>

            <div class="mt-8 space-y-4">
                @foreach ($reported as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block card-base transition-colors hover:border-accent">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-text/10">
                                    <span class="text-[14px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-card-h5">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[14px]">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-eyebrow">Cuộc hẹn</p>
                                <p class="mt-1 text-card-h6">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('d/m/Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('H:i') }}
                                </p>
                                <p class="text-[12px]">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                @if ($appt['status'] === 'COMPLETED')
                                    <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                                        <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                                        <span class="text-[12px] font-medium text-success">Hoàn tất</span>
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-3 py-1">
                                        <span class="block h-1.5 w-1.5 rounded-full bg-error"></span>
                                        <span class="text-[12px] font-medium text-error">Khách hàng vắng mặt</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection

@extends('layouts.app', ['title' => 'Bảng thông tin luật sư · LegalEase'])

@php
    $user = auth()->user();
    $firstName = explode(' ', trim($user->name))[0];

    $appointments = collect(\App\Data\LawyerAppointments::withSessionOutcomes());

    $upcoming = $appointments->filter(function ($a) {
        $start = \Carbon\Carbon::parse($a['date'] . ' ' . $a['time']);
        return $a['status'] === 'CONFIRMED' && $start->isFuture();
    })->sortBy('date')->values();

    $awaitingOutcome = $appointments->filter(function ($a) {
        $start = \Carbon\Carbon::parse($a['date'] . ' ' . $a['time']);
        return $a['status'] === 'CONFIRMED' && $start->isPast();
    })->sortByDesc('date')->values();

    $reported = $appointments->filter(function ($a) {
        return in_array($a['status'], ['COMPLETED', 'NO_SHOW_BY_CUSTOMER'], true);
    })->sortByDesc('date')->values();
@endphp

@section('content')
{{-- Visual strip --}}
<div class="relative -mt-[72px] h-[280px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1714974528749-fc028e54feb9?q=80"
         alt=""
         class="absolute inset-0 h-full w-full object-cover grayscale brightness-[0.55]">
    <div class="absolute inset-0 bg-gradient-to-b from-bg/40 via-bg/20 to-bg"></div>
</div>

<section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
    @if (session('status'))
        <div class="mb-12 rounded-2xl border border-success/40 bg-surface px-6 py-4">
            <p class="text-[14px] text-success">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Chào mừng trở lại</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Hi, {{ $firstName }}.
    </h1>
    <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
        @if ($upcoming->isEmpty() && $awaitingOutcome->isEmpty())
            No appointments on the books right now. Open up more time to receive new bookings.
        @else
            Here's what's on your schedule.
        @endif
    </p>

    {{-- Awaiting outcome --}}
    @if ($awaitingOutcome->isNotEmpty())
        <div class="mt-16">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Đang chờ kết quả của bạn</h2>
            <p class="mt-3 max-w-[560px] text-[15px] text-secondary">
                These appointments have passed. Report whether each one took place so the customer can leave a review.
            </p>

            <div class="mt-12 space-y-4">
                @foreach ($awaitingOutcome as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-gold/40 bg-surface p-6 transition-colors hover:border-gold ">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
                                    <span class="font-display text-[15px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[13px] text-muted">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Appointment</p>
                                <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('M j, Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('g:i A') }}
                                </p>
                                <p class="text-[12px] text-muted">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Action --}}
                            <div class="md:text-right">
                                <p class="text-[14px] font-medium text-gold transition-colors group-hover:text-text">
                                    Report outcome →
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Upcoming --}}
    <div class="mt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Cuộc hẹn sắp tới</h2>

        @if ($upcoming->isEmpty())
            <p class="mt-12 text-[15px] text-muted">Không có cuộc hẹn sắp tới.</p>
        @else
            <div class="mt-12 space-y-4">
                @foreach ($upcoming as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-text/10 bg-surface p-6 transition-colors hover:border-accent ">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
                                    <span class="font-display text-[15px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[13px] text-muted">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Appointment</p>
                                <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('M j, Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('g:i A') }}
                                </p>
                                <p class="text-[12px] text-muted">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                                    <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                                    <span class="text-[12px] font-medium text-success">Confirmed</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Past --}}
    <div class="mt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Cuộc hẹn trước đây</h2>

        @if ($reported->isEmpty())
            <p class="mt-12 text-[15px] text-muted">Chưa có cuộc hẹn nào trước đây.</p>
        @else
            <div class="mt-12 space-y-4">
                @foreach ($reported as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-text/10 bg-surface p-6 transition-colors hover:border-accent ">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
                                    <span class="font-display text-[15px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[13px] text-muted">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Appointment</p>
                                <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('M j, Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('g:i A') }}
                                </p>
                                <p class="text-[12px] text-muted">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                @if ($appt['status'] === 'COMPLETED')
                                    <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                                        <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                                        <span class="text-[12px] font-medium text-success">Completed</span>
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
        @endif
    </div>
</section>
@endsection

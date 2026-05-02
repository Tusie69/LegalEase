@extends('layouts.app', ['title' => 'Appointment · LegalEase'])

@php
    $start = \Carbon\Carbon::parse($appointment['date'] . ' ' . $appointment['time']);
    $isUpcoming = $appointment['status'] === 'CONFIRMED' && $start->isFuture();
    $isAwaitingOutcome = $appointment['status'] === 'CONFIRMED' && $start->isPast();
    $isCompleted = $appointment['status'] === 'COMPLETED';
    $isNoShow = $appointment['status'] === 'NO_SHOW_BY_CUSTOMER';
@endphp

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.dashboard') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
        ← Back to dashboard
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Appointment</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        Appointment with {{ $appointment['customer_name'] }}
    </h1>
    <p class="mt-4 text-[14px] text-muted">{{ $appointment['booking_code'] }}</p>

    {{-- Customer card --}}
    <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-5">
            <div class="flex h-20 w-20 flex-none items-center justify-center rounded-full bg-avatar">
                <span class="font-display text-[22px] font-medium text-text">{{ $appointment['customer_initials'] }}</span>
            </div>
            <div class="min-w-0">
                <p class="font-display text-[22px] font-medium tracking-tight">{{ $appointment['customer_name'] }}</p>
                <p class="text-[14px] text-muted">
                    <a href="tel:{{ str_replace(' ', '', $appointment['customer_phone']) }}" class="transition-colors hover:text-accent">
                        {{ $appointment['customer_phone'] }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    {{-- When --}}
    <div class="mt-10">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
        <p class="mt-2 font-display text-[20px] font-medium tracking-tight">
            {{ $start->format('l, F j, Y') }}
        </p>
        <p class="text-[14px] text-secondary">
            {{ $start->format('g:i A') }} · 60 minutes
        </p>
    </div>

    {{-- Status --}}
    <div class="mt-16 border-t border-text/10 pt-12">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Status</p>

        @if ($isUpcoming)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">Confirmed</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                The customer has paid the deposit. Once the consultation is finished, come back here to report the outcome.
            </p>
        @elseif ($isAwaitingOutcome)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-gold/40 bg-gold/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-gold"></span>
                <span class="text-[13px] font-medium text-gold">Awaiting outcome</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                The appointment time has passed. Report whether it took place so we can release payment and unlock the customer's review.
            </p>
            <div class="mt-8">
                <x-button variant="primary" :href="route('lawyer.appointments.outcome', $appointment['booking_code'])">
                    Report outcome
                </x-button>
            </div>
        @elseif ($isCompleted)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">Completed</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                You reported this consultation as completed on {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('M j, Y') }}.
            </p>
        @elseif ($isNoShow)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-[13px] font-medium text-error">Customer no-show</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Reported on {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('M j, Y') }}. The customer forfeited the deposit. Your compensation (25% of the deposit) is processed within 3 to 5 business days.
            </p>
        @endif
    </div>

    {{-- Customer review (if any) --}}
    @if ($isCompleted && !empty($appointment['customer_review']))
        <div class="mt-12 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Customer review</p>
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <x-rating-stars :rating="$appointment['customer_review']['stars']" size="md" />
                <span class="text-[13px] text-muted">
                    Submitted {{ \Carbon\Carbon::parse($appointment['customer_review']['reviewed_at'])->format('M j, Y') }}
                </span>
            </div>
            @if (!empty($appointment['customer_review']['review_text']))
                <blockquote class="mt-6 border-l-2 border-text/10 pl-5 text-[17px] leading-relaxed text-secondary">
                    “{{ $appointment['customer_review']['review_text'] }}”
                </blockquote>
            @endif
            <p class="mt-6 text-[13px] text-muted">
                If this review violates our guidelines, you can
                <a href="{{ route('contact') }}" class="text-text transition-colors hover:text-accent">flag it for admin review →</a>
            </p>
        </div>
    @endif
</section>
@endsection

@extends('layouts.app', ['title' => 'Booking confirmed · LegalEase'])

@php
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $user = auth()->user();
    $firstName = $user ? explode(' ', trim($user->name))[0] : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$completed || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">No booking found. Browse lawyers to make a new one.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Browse lawyers
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Booking confirmed</p>
        <h1 class="mt-3 font-display text-[48px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[60px]">
            You're all set{{ $firstName ? ', ' . $firstName : '' }}.
        </h1>
        <p class="mt-4 text-[17px] text-secondary">
            We've sent the details to your email. {{ $lawyer['name'] }} has been notified.
        </p>

        {{-- Booking card --}}
        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Booking code</p>
            <p class="mt-2 font-display text-[28px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                <div class="min-w-0">
                    <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                    <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Date</span>
                    <span class="text-right text-text">{{ \Carbon\Carbon::parse($completed['date'])->format('l, F j, Y') }}</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Time</span>
                    <span class="text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('g:i A') }}</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="flex-none text-muted">Address</span>
                    <span class="text-right text-text">
                        {{ $lawyer['address']['street_address'] ?? '' }}<br>
                        {{ $lawyer['address']['province'] ?? '' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- What happens next --}}
        <div class="mt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">What happens next</p>
            <ul class="mt-6 space-y-4 text-[15px] leading-relaxed text-secondary">
                <li>You'll get a reminder via {{ $completed['contact_preference'] === 'phone' ? 'phone' : 'email' }} 24 hours before your appointment.</li>
                <li>Arrive at the office a few minutes early. Bring any documents you want the lawyer to review.</li>
                <li>Need to cancel? Cancellations more than 24 hours ahead get a full refund.</li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="mt-12">
            <x-button variant="primary" href="{{ route('lawyers.index') }}" class="w-full">
                Browse more lawyers
            </x-button>
            <p class="mt-4 text-center text-[14px]">
                <a href="/" class="text-muted transition-colors hover:text-accent">Back to home</a>
            </p>
        </div>
    @endif
</section>
@endsection

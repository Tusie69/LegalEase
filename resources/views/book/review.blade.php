@extends('layouts.app', ['title' => 'Review your booking · LegalEase'])

@php
    $booking = session('booking');
    $bookingDetails = session('booking_details');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$booking || !$lawyer || !$bookingDetails)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">No booking in progress. Pick a lawyer and time first.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Browse lawyers
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
            Review your booking
        </h1>
        <p class="mt-3 text-[17px] text-secondary">
            Confirm the details below.
        </p>

        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            {{-- Lawyer --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Lawyer</p>
                <div class="mt-4 flex items-center gap-4">
                    <img src="{{ $lawyer['portrait_url'] }}" alt=""
                         class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                    <div class="min-w-0">
                        <p class="font-display text-[22px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                        <p class="text-[13px] text-muted">
                            {{ $lawyer['primary_specialty'] }}@if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }}@endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- When --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
                <p class="mt-3 text-[18px] text-text">
                    {{ \Carbon\Carbon::parse($booking['date'])->format('l, F j, Y') }}
                </p>
                <p class="mt-1 text-[15px] text-secondary">
                    {{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('g:i A') }} · 60-minute consultation
                </p>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Where --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Where</p>
                <p class="mt-3 text-[15px] text-text">
                    {{ $lawyer['address']['street_address'] ?? '' }}
                </p>
                <p class="text-[15px] text-secondary">
                    {{ $lawyer['address']['province'] ?? '' }}
                </p>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Preferences --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Preferences</p>
                <div class="mt-3 grid grid-cols-2 gap-4 text-[14px]">
                    <div>
                        <p class="text-muted">Meeting language</p>
                        <p class="mt-1 text-text">{{ $bookingDetails['meeting_language'] === 'vi' ? 'Vietnamese' : 'English' }}</p>
                    </div>
                    <div>
                        <p class="text-muted">Contact for confirmations</p>
                        <p class="mt-1 text-text">{{ ucfirst($bookingDetails['contact_preference']) }}</p>
                    </div>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Payment --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Payment</p>
                <div class="mt-3 flex items-baseline justify-between gap-4">
                    <p class="text-[15px] text-text">Consultation fee</p>
                    <p class="font-display text-[22px] font-medium tracking-tight">
                        {{ number_format($lawyer['price_per_hour']) }} VND
                    </p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <form method="POST" action="{{ route('book.confirm') }}" class="mt-10">
            @csrf
            <x-button variant="primary" type="submit" class="w-full">Confirm booking</x-button>
        </form>

        <p class="mt-4 text-center text-[14px]">
            <a href="{{ route('book.details') }}" class="text-muted transition-colors hover:text-accent">
                Edit preferences
            </a>
            <span class="mx-2 text-muted/40">·</span>
            <a href="{{ route('lawyers.show', ['slug' => $booking['lawyer_slug']]) }}" class="text-muted transition-colors hover:text-accent">
                Change slot
            </a>
        </p>
    @endif
</section>
@endsection

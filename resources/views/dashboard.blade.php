@extends('layouts.app', ['title' => 'Dashboard · LegalEase'])

@php
    $user = auth()->user();
    $firstName = explode(' ', trim($user->name))[0];
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $hasUpcoming = $completed && $lawyer;
    $featuredLawyers = \App\Data\Lawyers::featured(3);
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
    {{-- Header --}}
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Welcome back</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Hi, {{ $firstName }}.
    </h1>
    @unless ($hasUpcoming)
        <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
            Pick a lawyer below to book your first consultation.
        </p>
    @endunless

    {{-- Upcoming consultations --}}
    @if ($hasUpcoming)
        <div class="mt-16">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Upcoming consultations</h2>

            <div class="mt-8 rounded-2xl border border-text/10 bg-surface p-8">
                <div class="grid gap-8 md:grid-cols-[auto_1fr_auto] md:items-center">
                    {{-- Lawyer --}}
                    <div class="flex items-center gap-4">
                        <img src="{{ $lawyer['portrait_url'] }}" alt=""
                             class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                            <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    {{-- When + Where --}}
                    <div class="md:border-l md:border-text/10 md:pl-8">
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
                        <p class="mt-2 font-display text-[18px] font-medium tracking-tight">
                            {{ \Carbon\Carbon::parse($completed['date'])->format('M j, Y') }}
                        </p>
                        <p class="text-[14px] text-secondary">
                            {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('g:i A') }}
                        </p>
                        <p class="mt-3 text-[13px] text-muted">
                            {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                        </p>
                    </div>

                    {{-- Booking code --}}
                    <div class="md:text-right">
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Booking code</p>
                        <p class="mt-2 font-display text-[18px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Lawyers we recommend --}}
    <div class="mt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Lawyers we recommend</h2>
            <x-button variant="ghost" href="{{ route('lawyers.index') }}">See all lawyers →</x-button>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredLawyers as $featured)
                <x-lawyer-card :lawyer="$featured" />
            @endforeach
        </div>
    </div>
</section>
@endsection

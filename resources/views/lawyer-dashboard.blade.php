@extends('layouts.app', ['title' => 'Lawyer dashboard · LegalEase'])

@php
    $user = auth()->user();
    $firstName = explode(' ', trim($user->name))[0];

    $onboardingSteps = [
        [
            'title'  => 'Account created',
            'desc'   => 'Your application is submitted.',
            'status' => 'done',
        ],
        [
            'title'  => 'Profile under review',
            'desc'   => "We're verifying your bar credentials. Usually within a few business days.",
            'status' => 'current',
        ],
        [
            'title'  => 'Set availability',
            'desc'   => 'Add your office hours and slot preferences once verified.',
            'status' => 'pending',
        ],
        [
            'title'  => 'Receive bookings',
            'desc'   => 'Customers will see your profile and book consultations.',
            'status' => 'pending',
        ],
    ];
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 py-20">
    {{-- Header --}}
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Welcome back</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Hi, {{ $firstName }}.
    </h1>
    <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
        Your account is being reviewed. Once verified, you'll be able to set availability and receive bookings.
    </p>

    {{-- Getting set up / onboarding checklist --}}
    <div class="mt-16 max-w-[760px]">
        <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Getting set up</h2>
        <div class="mt-8 rounded-2xl border border-text/10 bg-surface">
            @foreach ($onboardingSteps as $i => $step)
                <div class="flex items-start gap-5 px-8 py-8 {{ $i > 0 ? 'border-t border-text/10' : '' }}">
                    {{-- Status indicator --}}
                    <div class="mt-1 flex-none">
                        @if ($step['status'] === 'done')
                            <svg class="h-5 w-5 text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        @elseif ($step['status'] === 'current')
                            <span class="block h-5 w-5 rounded-full border-2 border-text"></span>
                        @else
                            <span class="block h-5 w-5 rounded-full border border-text/20"></span>
                        @endif
                    </div>

                    {{-- Step content --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-display text-[18px] font-medium tracking-tight {{ $step['status'] === 'pending' ? 'text-muted' : 'text-text' }}">
                            {{ $step['title'] }}
                        </p>
                        <p class="mt-1 text-[14px] leading-relaxed {{ $step['status'] === 'pending' ? 'text-muted/70' : 'text-secondary' }}">
                            {{ $step['desc'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>
@endsection

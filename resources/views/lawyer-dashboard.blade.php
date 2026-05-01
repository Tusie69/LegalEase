@extends('layouts.app', ['title' => 'Lawyer dashboard · LegalEase'])

@php
    $user = auth()->user();
    $firstName = explode(' ', trim($user->name))[0];

    $onboardingSteps = [
        [
            'title'  => 'Account created',
            'desc'   => 'Your account is set up.',
            'status' => 'done',
        ],
        [
            'title'  => 'Upload credentials',
            'desc'   => 'Submit your bar card, identity document, and education certificate. Reviewed within 2 to 3 business days.',
            'status' => 'current',
            'action' => ['route' => 'lawyer.credentials', 'label' => 'Upload now →'],
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
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Welcome back</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Hi, {{ $firstName }}.
    </h1>
    <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
        Your account is being reviewed. Once verified, you'll be able to set availability and receive bookings.
    </p>

    {{-- Getting set up / onboarding checklist --}}
    <div class="mt-16 max-w-[760px]">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Getting set up</h2>
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
                        @if (isset($step['action']) && $step['status'] === 'current')
                            <a href="{{ route($step['action']['route']) }}"
                               class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                                {{ $step['action']['label'] }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>
@endsection

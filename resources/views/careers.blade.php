@extends('layouts.app', ['title' => 'Careers · LegalEase'])

@php
    $values = [
        ['title' => 'Mission-driven',  'desc' => "Work that reaches users this week."],
        ['title' => 'Hybrid in Hanoi', 'desc' => "Three days office, two days remote."],
        ['title' => 'Real impact',     'desc' => "Small team. Your work ships fast."],
        ['title' => 'Learning budget', 'desc' => "Annual stipend for what sharpens your craft."],
    ];

    $roles = [
        [
            'title' => 'Senior Backend Engineer',
            'meta'  => 'Engineering · Hanoi · Full-time',
            'desc'  => "Laravel and MySQL. Scale the platform that powers 500+ lawyer profiles.",
        ],
        [
            'title' => 'Product Designer',
            'meta'  => 'Product · Hanoi · Full-time',
            'desc'  => "Lead the customer flow from search to consultation.",
        ],
        [
            'title' => 'Lawyer Verification Specialist',
            'meta'  => 'Operations · Hanoi · Full-time',
            'desc'  => "Vet every lawyer before they list. Background in law preferred.",
        ],
        [
            'title' => 'Customer Operations Lead',
            'meta'  => 'Operations · Hanoi or Ho Chi Minh City · Full-time',
            'desc'  => "First responder for clients. Build the playbooks that scale support.",
        ],
        [
            'title' => 'Marketing Manager',
            'meta'  => 'Marketing · Hanoi · Full-time',
            'desc'  => "Brand, content, and growth across Vietnam.",
        ],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Apply',          'desc' => "No cover letter."],
        ['n' => '02', 'title' => 'Two interviews', 'desc' => "Hiring manager, then team."],
        ['n' => '03', 'title' => 'Decision',       'desc' => "Within ten days."],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=2000&h=1200&fit=crop&q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">We're hiring</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Build the legal layer for Vietnam.
            </h1>
        </div>
    </section>

    {{-- 01 / Why work here --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-4">
            <p class="font-display text-[14px] font-medium text-muted">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Why work here</h2>
        </div>
        <p class="mt-6 max-w-[680px] text-[18px] leading-relaxed text-secondary">
            We're building the legal platform Vietnam doesn't have yet. Small team, big mission.
        </p>
    </section>

    {{-- 02 / What it's like --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-4">
            <p class="font-display text-[14px] font-medium text-muted">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">What it's like</h2>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[20px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 03 / Open positions --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-4">
            <p class="font-display text-[14px] font-medium text-muted">03</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Open positions</h2>
        </div>

        <div class="mt-10 divide-y divide-text/10 border-y border-text/10">
            @foreach ($roles as $role)
                <article class="grid gap-6 py-8 md:grid-cols-[1fr_auto] md:items-baseline">
                    <div>
                        <h3 class="font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[30px]">
                            {{ $role['title'] }}
                        </h3>
                        <p class="mt-2 text-[13px] uppercase tracking-[0.08em] text-muted">
                            {{ $role['meta'] }}
                        </p>
                        <p class="mt-4 max-w-[640px] text-[15px] leading-relaxed text-secondary">
                            {{ $role['desc'] }}
                        </p>
                    </div>
                    <a href="mailto:careers@legalease.vn?subject={{ urlencode('Application: ' . $role['title']) }}"
                       class="inline-flex items-center gap-2 self-start whitespace-nowrap text-[14px] font-medium text-text transition-colors hover:text-secondary">
                        Apply
                        <span aria-hidden="true">→</span>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 04 / How we hire --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-4">
            <p class="font-display text-[14px] font-medium text-muted">04</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">How we hire</h2>
        </div>

        <div class="mt-10 grid gap-12 md:grid-cols-3">
            @foreach ($hiring as $step)
                <div>
                    <p class="font-display text-[14px] font-medium text-muted">{{ $step['n'] }}</p>
                    <h3 class="mt-3 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-[15px] leading-relaxed text-muted">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Don't see your role?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="mailto:careers@legalease.vn">Get in touch →</x-button>
        </div>
    </section>
@endsection

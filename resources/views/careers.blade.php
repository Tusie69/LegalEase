@extends('layouts.app', ['title' => 'Careers · LegalEase'])

@php
    $values = [
        ['title' => 'Mission-driven',  'desc' => "Work that reaches users this week."],
        ['title' => 'Hybrid in Hanoi', 'desc' => "Three days office, two days remote."],
        ['title' => 'Real impact',     'desc' => "Small team. Your work ships fast."],
        ['title' => 'Learning budget', 'desc' => "Annual stipend for what sharpens your craft."],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Apply',          'desc' => "No cover letter."],
        ['n' => '02', 'title' => 'Two interviews', 'desc' => "Hiring manager, then team."],
        ['n' => '03', 'title' => 'Decision',       'desc' => "Within ten days."],
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

    {{-- Two-column: context (left) + roles (right) --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid gap-16 md:grid-cols-3">

            {{-- Left: context --}}
            <aside class="md:col-span-1">
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Why work here</p>
                    <p class="mt-4 text-[16px] leading-relaxed text-secondary">
                        We're building the legal platform Vietnam doesn't have yet. Small team, big mission.
                    </p>
                </div>

                <div class="mt-12">
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">What it's like</p>
                    <div class="mt-4 space-y-5">
                        @foreach ($values as $v)
                            <div class="border-t border-text/10 pt-4">
                                <h3 class="font-display text-[18px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                                <p class="mt-1 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12">
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">How we hire</p>
                    <div class="mt-4 space-y-5">
                        @foreach ($hiring as $step)
                            <div class="flex gap-4">
                                <span class="font-display text-[14px] font-medium text-muted">{{ $step['n'] }}</span>
                                <div>
                                    <h3 class="font-display text-[16px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                                    <p class="mt-1 text-[14px] leading-relaxed text-muted">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- Right: roles --}}
            <div class="md:col-span-2">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Open positions</p>
                <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
                    {{ count($roles) }} roles, all in Vietnam.
                </h2>

                <div class="mt-10 space-y-12">
                    @foreach ($roles as $role)
                        <article>
                            <h3 class="font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[28px]">
                                {{ $role['title'] }}
                            </h3>
                            <p class="mt-2 text-[13px] uppercase tracking-[0.08em] text-muted">
                                {{ $role['meta'] }}
                            </p>
                            <p class="mt-4 max-w-[560px] text-[15px] leading-relaxed text-secondary">
                                {{ $role['desc'] }}
                            </p>
                            <a href="mailto:careers@legalease.vn?subject={{ urlencode('Application: ' . $role['title']) }}"
                               class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                                Apply
                                <span aria-hidden="true">→</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Don't see your role?
        </h2>
        <div class="mt-10 flex flex-col items-center gap-3">
            <x-button variant="primary" href="mailto:careers@legalease.vn">Get in touch →</x-button>
            <p class="text-[13px] text-muted">careers@legalease.vn</p>
        </div>
    </section>
@endsection

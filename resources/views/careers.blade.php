@extends('layouts.app', ['title' => 'Careers · LegalEase'])

@php
    $values = [
        ['title' => 'Mission-driven',  'desc' => "Every feature changes how someone in Vietnam finds legal help."],
        ['title' => 'Hybrid in Hanoi', 'desc' => "Three days in office, two days remote. Anchored in one city."],
        ['title' => 'Real impact',     'desc' => "Small team. The work you ship reaches users this week."],
        ['title' => 'Learning budget', 'desc' => "Annual stipend for courses, conferences, books, whatever sharpens your craft."],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Apply',          'desc' => "Short application, no cover letter."],
        ['n' => '02', 'title' => 'Two interviews', 'desc' => "One with the hiring manager, one with the team."],
        ['n' => '03', 'title' => 'Decision',       'desc' => "Yes, no, or what's needed within ten days."],
    ];

    $roles = [
        [
            'title' => 'Senior Backend Engineer',
            'department' => 'Engineering',
            'location' => 'Hanoi',
            'type' => 'Full-time',
            'description' => "Build and maintain the platform that connects 500+ lawyers with clients across Vietnam. Laravel, MySQL, and a small React front end.",
        ],
        [
            'title' => 'Product Designer',
            'department' => 'Product',
            'location' => 'Hanoi',
            'type' => 'Full-time',
            'description' => "Lead the customer flow from search to consultation. Work alongside engineering and lawyers to design end-to-end experiences.",
        ],
        [
            'title' => 'Lawyer Verification Specialist',
            'department' => 'Operations',
            'location' => 'Hanoi',
            'type' => 'Full-time',
            'description' => "Vet every lawyer before they list. Review credentials, bar memberships, and practice histories. Background in law preferred.",
        ],
        [
            'title' => 'Customer Operations Lead',
            'department' => 'Operations',
            'location' => 'Hanoi or Ho Chi Minh City',
            'type' => 'Full-time',
            'description' => "First responder for client questions, escalations, and platform issues. Build the playbooks that scale our support function.",
        ],
        [
            'title' => 'Marketing Manager',
            'department' => 'Marketing',
            'location' => 'Hanoi',
            'type' => 'Full-time',
            'description' => "Run brand, content, and growth across Vietnam. Tell our story to people who haven't thought about hiring a lawyer online.",
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

            <p class="mx-auto mt-8 max-w-[600px] text-[18px] leading-relaxed text-secondary">
                A small team in Hanoi making legal help feel like a choice, not a guess.
            </p>
        </div>
    </section>

    {{-- Two-column: sticky context (left) + scrolling roles (right) --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid gap-16 md:grid-cols-3">

            {{-- Left: sticky context --}}
            <aside class="self-start md:sticky md:top-[88px] md:col-span-1">
                {{-- Why work here --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Why work here</p>
                    <p class="mt-4 text-[16px] leading-relaxed text-secondary">
                        We're building the legal platform Vietnam doesn't have yet. A small team out of Hanoi connecting people to verified lawyers, fast and clear.
                    </p>
                </div>

                {{-- Values --}}
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

                {{-- Hiring process --}}
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

            {{-- Right: roles list --}}
            <div class="md:col-span-2">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Open positions</p>
                <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
                    {{ count($roles) }} roles, all in Vietnam.
                </h2>

                <div class="mt-10 divide-y divide-text/10 border-y border-text/10">
                    @foreach ($roles as $role)
                        <article class="grid gap-6 py-8 md:grid-cols-[1fr_auto] md:items-start">
                            <div>
                                <h3 class="font-display text-[24px] font-medium leading-tight tracking-[-0.01em] md:text-[26px]">
                                    {{ $role['title'] }}
                                </h3>
                                <p class="mt-2 text-[13px] uppercase tracking-[0.08em] text-muted">
                                    {{ $role['department'] }} · {{ $role['location'] }} · {{ $role['type'] }}
                                </p>
                                <p class="mt-4 max-w-[560px] text-[15px] leading-relaxed text-secondary">
                                    {{ $role['description'] }}
                                </p>
                            </div>
                            <a href="mailto:careers@legalease.vn?subject={{ urlencode('Application: ' . $role['title']) }}"
                               class="inline-flex items-center gap-2 self-end whitespace-nowrap text-[14px] font-medium text-text transition-colors hover:text-secondary md:self-start md:mt-2">
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
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Don't see your role?</p>
        <h2 class="mt-6 font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Send us a note anyway.
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            We're a small team and we keep an eye out for people who care about legal access in Vietnam.
        </p>
        <div class="mt-10 flex flex-col items-center gap-3">
            <x-button variant="primary" href="mailto:careers@legalease.vn">Get in touch →</x-button>
            <p class="text-[13px] text-muted">careers@legalease.vn</p>
        </div>
    </section>
@endsection

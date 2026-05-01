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
            'title'     => 'Senior Backend Engineer',
            'meta'      => 'Engineering · Hanoi · Full-time',
            'desc'      => "Laravel and MySQL. Scale the platform that powers 500+ lawyer profiles.",
            'salary'    => '50-80M',
            'image_url' => 'https://images.unsplash.com/photo-1631624222568-6619ce21a683?q=80',
        ],
        [
            'title'     => 'Product Designer',
            'meta'      => 'Product · Hanoi · Full-time',
            'desc'      => "Lead the customer flow from search to consultation.",
            'salary'    => '40-65M',
            'image_url' => 'https://images.unsplash.com/photo-1600697394936-59934aa5951f?q=80',
        ],
        [
            'title'     => 'Lawyer Verification Specialist',
            'meta'      => 'Operations · Hanoi · Full-time',
            'desc'      => "Vet every lawyer before they list. Background in law preferred.",
            'salary'    => '25-40M',
            'image_url' => 'https://images.unsplash.com/photo-1688828792704-4218151b5d97?q=80',
        ],
        [
            'title'     => 'Customer Operations Lead',
            'meta'      => 'Operations · Hanoi or Ho Chi Minh City · Full-time',
            'desc'      => "First responder for clients. Build the playbooks that scale support.",
            'salary'    => '30-45M',
            'image_url' => 'https://images.unsplash.com/photo-1554774853-719586f82d77?q=80',
        ],
        [
            'title'     => 'Marketing Manager',
            'meta'      => 'Marketing · Hanoi · Full-time',
            'desc'      => "Brand, content, and growth across Vietnam.",
            'salary'    => '35-55M',
            'image_url' => 'https://images.unsplash.com/photo-1758873268131-a2636b120d81?q=80',
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

    {{-- 01 / What it's like --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">What it's like</h2>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[24px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 02 / Open positions --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Open positions</h2>
        </div>

        <div class="mt-12">
            @foreach ($roles as $i => $role)
                <article class="{{ $i > 0 ? 'pt-20' : '' }} grid grid-cols-1 gap-6 md:grid-cols-[100px_1fr_auto] md:gap-10">
                    {{-- Role image --}}
                    <div class="aspect-square w-[100px] overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $role['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="h-full w-full object-cover object-top grayscale">
                    </div>

                    {{-- Title, meta, description --}}
                    <div>
                        <h3 class="font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[30px]">
                            {{ $role['title'] }}
                        </h3>
                        <p class="mt-2 text-[12px] uppercase tracking-[0.1em] text-muted">
                            {{ $role['meta'] }}
                        </p>
                        <p class="mt-4 max-w-[560px] text-[15px] leading-relaxed text-secondary">
                            {{ $role['desc'] }}
                        </p>
                    </div>

                    {{-- Salary --}}
                    <div class="md:text-right">
                        <p class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                            {{ $role['salary'] }}
                        </p>
                        <p class="mt-1 text-[12px] uppercase tracking-[0.08em] text-muted">
                            VND / month
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 03 / How we hire --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">03</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">How we hire</h2>
        </div>

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($hiring as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Ready to apply?
        </h2>
        <div class="mt-8 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Get in touch →</x-button>
        </div>
    </section>
@endsection

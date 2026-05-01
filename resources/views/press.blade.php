@extends('layouts.app', ['title' => 'Press · LegalEase'])

@php
    $coverage = [
        [
            'publication' => 'Forbes Vietnam',
            'date'        => 'Mar 28, 2026',
            'headline'    => 'Three lawyers walked into a frustration. They built a marketplace.',
            'url'         => '#',
        ],
        [
            'publication' => 'VnExpress',
            'date'        => 'Mar 12, 2026',
            'headline'    => 'LegalEase đặt cược vào tư vấn luật minh bạch tại Việt Nam',
            'url'         => '#',
        ],
        [
            'publication' => 'Vietcetera',
            'date'        => 'Feb 14, 2026',
            'headline'    => 'How LegalEase is unbundling Vietnamese legal practice',
            'url'         => '#',
        ],
        [
            'publication' => 'Tuổi Trẻ',
            'date'        => 'Feb 5, 2026',
            'headline'    => 'Hà Nội startup mở cửa cho hơn 500 luật sư',
            'url'         => '#',
        ],
        [
            'publication' => 'Tech in Asia',
            'date'        => 'Jan 22, 2026',
            'headline'    => "Vietnam's legal-tech wave finds its first consumer brand",
            'url'         => '#',
        ],
        [
            'publication' => 'Saigon Times',
            'date'        => 'Dec 18, 2025',
            'headline'    => "Booking a lawyer used to mean asking around. Now there's an app.",
            'url'         => '#',
        ],
        [
            'publication' => 'e27',
            'date'        => 'Nov 30, 2025',
            'headline'    => "Inside LegalEase's seed round and the team behind it",
            'url'         => '#',
        ],
        [
            'publication' => 'ICTNews',
            'date'        => 'Oct 14, 2025',
            'headline'    => 'Khởi nghiệp công nghệ pháp lý: LegalEase đi đường dài',
            'url'         => '#',
        ],
    ];

    $contact = [
        'name'  => 'Đỗ Thị Lan',
        'role'  => 'Co-founder, CEO',
        'email' => 'press@legalease.vn',
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=2000&h=1200&fit=crop&q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Press</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                What people are saying.
            </h1>
        </div>
    </section>

    {{-- 01 / In the news --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">In the news</h2>
        </div>

        <div class="mt-12">
            @foreach ($coverage as $i => $item)
                <article class="grid grid-cols-1 gap-4 border-b border-text/10 py-16 first:pt-0 last:border-b-0 md:grid-cols-[1fr_auto] md:items-center md:gap-12">
                    <div>
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                            {{ $item['publication'] }}
                        </p>
                        <h3 class="mt-3 max-w-[760px] font-display text-[24px] font-medium leading-tight tracking-[-0.01em] md:text-[28px]">
                            {{ $item['headline'] }}
                        </h3>
                        <p class="mt-3 text-[13px] text-muted">{{ $item['date'] }}</p>
                    </div>
                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary md:justify-self-end">
                        Read
                        <span aria-hidden="true">→</span>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 02 / For journalists --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">For journalists</h2>
        </div>

        <div class="mt-12 grid gap-12 md:grid-cols-2 md:gap-20">
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Press contact</p>
                <p class="mt-5 font-display text-[26px] font-medium tracking-tight md:text-[28px]">
                    {{ $contact['name'] }}
                </p>
                <p class="mt-1 text-[14px] text-muted">{{ $contact['role'] }}</p>
                <a href="mailto:{{ $contact['email'] }}"
                   class="mt-5 inline-flex items-center gap-2 text-[15px] text-text transition-colors hover:text-secondary">
                    {{ $contact['email'] }}
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Boilerplate</p>
                <div class="mt-5 space-y-4 text-[15px] leading-relaxed text-secondary">
                    <p>
                        LegalEase is a verified marketplace for legal consultations in Vietnam. Founded in Hanoi in 2024, we connect individuals and businesses with 500+ vetted lawyers across 12 cities.
                    </p>
                    <p>
                        Every lawyer's credentials are reviewed before they list. Hourly rates are public. No referral fees, no paid rankings.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'About · LegalEase'])

@section('content')
    {{-- Hero: full-bleed photo with overlay --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1610374792793-f016b77ca51a?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/50 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Our story
            </p>

            <h1 class="mx-auto mt-6 max-w-[900px] font-display text-[56px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[88px]">
                Legal help, without the guesswork.
            </h1>

            <p class="mx-auto mt-8 max-w-[560px] text-[18px] leading-relaxed text-secondary">
                We connect people in Vietnam with verified lawyers, fast.
            </p>
        </div>
    </section>

    {{-- Pronunciation moment --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24 text-center">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Le · gal · ease</p>
        <h2 class="mx-auto mt-6 max-w-[820px] font-display text-[40px] font-medium leading-[1.15] tracking-[-0.01em] md:text-[56px]">
            LegalEase: <span class="text-secondary">/lē &middot; gəl &middot; ēz/</span>
        </h2>
        <p class="mx-auto mt-6 max-w-[600px] text-[17px] leading-relaxed text-secondary">
            A platform built so finding a lawyer feels less like a guess and more like a choice.
        </p>
    </section>

    {{-- Problem block: image left, text right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1726649339367-c2577a28881b?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">The problem</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Asking around isn't a strategy.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    For most people in Vietnam, finding a lawyer means asking a friend and hoping for the best. Prices vary wildly. Credentials are hard to verify.
                </p>
            </div>
        </div>
    </section>

    {{-- Solution block: text left, image right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="md:order-2 overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1758518726775-70e538b0d46e?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div class="md:order-1">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">What we built</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Verified, transparent, ready.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    Every lawyer is reviewed by our team before they list. Hourly rates are public. Booking takes minutes.
                </p>
            </div>
        </div>
    </section>

    {{-- Stat moment --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1758518731722-320023fb8e66?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div>
                <p class="font-display text-[56px] font-medium leading-none tracking-[-0.03em] md:text-[72px]">
                    500+
                </p>
                <h3 class="mt-5 font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    Verified lawyers across Vietnam.
                </h3>
                <p class="mt-4 max-w-[420px] text-[16px] leading-relaxed text-secondary">
                    Across 12 cities, with bar membership and credentials checked before they go live.
                </p>
            </div>
        </div>
    </section>

    {{-- Testimonial --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="border-y border-text/10 py-20 md:py-24">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">“</span>It felt like having a friend who happens to be a lawyer.<span class="text-muted">”</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.12em] text-muted">
                A client, divorce case in Hanoi
            </p>
        </div>
    </section>

    {{-- Team --}}
    @php
        $team = [
            [
                'name' => 'Đỗ Thị Lan',
                'role' => 'Co-founder, CEO',
                'bio'  => "Eight years as a litigator at a top Hanoi firm. Left to build something simpler.",
                'portrait' => 'https://images.unsplash.com/photo-1714974528915-4c74c4c0bb27?q=80',
            ],
            [
                'name' => 'Trần Quốc Việt',
                'role' => 'Co-founder, Verification',
                'bio'  => "Six years at the Vietnam Bar Federation handling licensing and ethics.",
                'portrait' => 'https://images.unsplash.com/photo-1591702694482-ecc51ff9642e?q=80',
            ],
            [
                'name' => 'Nguyễn Hà My',
                'role' => 'Co-founder, Product',
                'bio'  => "Built consumer fintech products used by millions of Vietnamese.",
                'portrait' => 'https://images.unsplash.com/photo-1733348137479-2e726d326d9b?q=80',
            ],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">The team</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Three people, one shared frustration.
        </h2>

        <div class="mt-12 grid gap-10 md:grid-cols-3">
            @foreach ($team as $member)
                <div>
                    <div class="overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $member['portrait'] }}"
                             alt="{{ $member['name'] }}"
                             loading="lazy"
                             class="aspect-[4/5] w-full object-cover object-top grayscale">
                    </div>
                    <h3 class="mt-5 font-display text-[24px] font-medium tracking-tight">{{ $member['name'] }}</h3>
                    <p class="mt-1 text-[13px] uppercase tracking-[0.06em] text-muted">{{ $member['role'] }}</p>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Values --}}
    @php
        $values = [
            ['title' => 'Transparent pricing',     'desc' => 'Hourly rates posted before you book.'],
            ['title' => "We don't pick favorites", 'desc' => 'No referral fees. No paid rankings.'],
            ['title' => 'Verified credentials',    'desc' => 'Every lawyer reviewed before listing.'],
            ['title' => 'No obligation',           'desc' => 'After your consultation, the next step is yours.'],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">How we work</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Four commitments.
        </h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-8">
                    <h3 class="font-display text-[24px] font-medium leading-tight tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Ready to find your lawyer?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Browse lawyers →</x-button>
        </div>
    </section>
@endsection

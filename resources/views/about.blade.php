@extends('layouts.app', ['title' => 'About · LegalEase'])

@section('content')
    {{-- Hero --}}
    <section class="mx-auto flex min-h-[320px] max-w-[1280px] items-center px-8 py-20">
        <div class="max-w-[720px]">
            <p class="animate-fade-up text-[12px] font-medium uppercase tracking-[0.1em] text-muted"
               style="animation-delay: 0ms">
                Our story
            </p>

            <h1 class="animate-fade-up mt-6 font-display text-[48px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[60px]"
                style="animation-delay: 100ms">
                Built so legal help isn't a guessing game.
            </h1>

            <p class="animate-fade-up mt-6 max-w-[600px] text-[18px] leading-relaxed text-secondary"
               style="animation-delay: 200ms">
                LegalEase exists because finding the right lawyer in Vietnam shouldn't depend on who you happen to know.
            </p>
        </div>
    </section>

    {{-- The problem --}}
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">
            The problem we kept seeing
        </h2>
        <div class="mt-6 max-w-[720px] space-y-5 text-[17px] leading-relaxed text-secondary">
            <p>For most people in Vietnam, finding a lawyer means asking a friend, hoping they know someone, and trusting whatever quote you're given. Prices vary wildly. Credentials are hard to verify. The whole experience runs on personal networks — which works fine until your network doesn't include a lawyer who handles what you need.</p>
            <p>We've watched this play out with our own families. A cousin overpays for a divorce filing. An uncle gets pressured into a contract review by someone he met once. A friend spends three weeks trying to figure out which kind of lawyer handles inheritance. None of this is anyone's fault — it's just how the market works. We thought it could work better.</p>
        </div>
    </section>

    {{-- What we built --}}
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">
            What we built
        </h2>
        <div class="mt-6 max-w-[720px] space-y-5 text-[17px] leading-relaxed text-secondary">
            <p>LegalEase is a marketplace of verified lawyers across Vietnam. Every lawyer on the platform is checked by our team before they go live — credentials, bar association membership, areas of practice. We don't take referral fees from lawyers, and we don't promote some over others based on payment.</p>
            <p>Prices are transparent. Availability is real. You can read what other clients said, see how many years a lawyer has practiced, and book a 60-minute consultation without sending a single email. After the consultation, you decide what happens next — there's no obligation to continue with that lawyer.</p>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-surface">
        <div class="mx-auto flex h-24 max-w-[1280px] items-center justify-center px-8">
            <div class="grid w-full grid-cols-1 divide-y divide-text/10 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">500+</p>
                    <p class="mt-2 text-[14px] text-muted">Verified lawyers</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">12</p>
                    <p class="mt-2 text-[14px] text-muted">Cities across Vietnam</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">2025</p>
                    <p class="mt-2 text-[14px] text-muted">Founded in Hanoi</p>
                </div>
            </div>
        </div>
    </section>

    {{-- The team --}}
    @php
        $team = [
            [
                'name' => 'Đỗ Thị Lan',
                'role' => 'Co-founder & CEO',
                'bio'  => "Lan spent eight years as a litigator at a top Hanoi firm before leaving to build LegalEase. She watched too many clients arrive late and underprepared because they'd been searching for the right lawyer for weeks.",
                'portrait' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&h=1000&fit=crop&q=80',
            ],
            [
                'name' => 'Trần Quốc Việt',
                'role' => 'Co-founder & Head of Verification',
                'bio'  => "Việt manages the lawyer onboarding process. He spent six years at the Vietnam Bar Federation handling licensing and ethics, which gives LegalEase a deep view into who is and isn't qualified to practice.",
                'portrait' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=1000&fit=crop&q=80',
            ],
            [
                'name' => 'Nguyễn Hà My',
                'role' => 'Co-founder & Head of Product',
                'bio'  => "My designs the product. She came from a fintech background where she built consumer products used by millions of Vietnamese — that experience shaped LegalEase's commitment to making legal services feel calm, not intimidating.",
                'portrait' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=800&h=1000&fit=crop&q=80',
            ],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">
            The team
        </h2>
        <p class="mt-6 max-w-[720px] text-[17px] leading-relaxed text-secondary">
            LegalEase was started by three people who'd each been on the wrong side of an opaque legal process. We're based in Hanoi, with team members in Ho Chi Minh City and Da Nang.
        </p>

        <div class="mt-12 grid gap-8 md:grid-cols-3">
            @foreach ($team as $member)
                <div>
                    <div class="overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $member['portrait'] }}"
                             alt="{{ $member['name'] }}"
                             loading="lazy"
                             class="aspect-[4/5] w-full object-cover object-top grayscale">
                    </div>
                    <h3 class="mt-5 font-display text-[24px] font-medium tracking-tight">{{ $member['name'] }}</h3>
                    <p class="mt-1 text-[14px] text-muted">{{ $member['role'] }}</p>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Values --}}
    @php
        $values = [
            ['eyebrow' => 'No hidden fees',        'title' => 'Transparent pricing',     'desc' => "Every lawyer's hourly rate is posted before you book. No upsells, no surprise charges."],
            ['eyebrow' => 'Neutral platform',      'title' => "We don't pick favorites", 'desc' => "We don't take referral fees and we don't rank lawyers based on what they pay us."],
            ['eyebrow' => 'Verified credentials',  'title' => 'We check before they list','desc' => "Every lawyer is verified by our team before clients can book them."],
            ['eyebrow' => 'Your decision',         'title' => 'No obligation, ever',     'desc' => "After a consultation, you decide what's next. There's no pressure to continue."],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">
            How we work
        </h2>

        <div class="mt-12 grid gap-x-12 gap-y-10 md:grid-cols-2">
            @foreach ($values as $v)
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $v['eyebrow'] }}</p>
                    <h3 class="mt-3 font-display text-[20px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[15px] leading-relaxed text-secondary">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 py-32 text-center">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">
            Ready to find your lawyer?
        </h2>
        <div class="mt-8 flex justify-center">
            <x-button variant="primary" href="/lawyers">Browse lawyers →</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Resources · LegalEase'])

@php
    $featured = [
        'category'  => 'Growing your practice',
        'title'     => 'How top lawyers on LegalEase fill their week',
        'lead'      => 'A look at how the most-booked lawyers on the platform structure their availability, set rates, and turn first consultations into long-term clients.',
        'read_time' => '8 min read',
        'image_url' => 'https://images.unsplash.com/photo-1758519291932-6263fc870e01?q=80',
    ];

    $articles = [
        [
            'category'  => 'Getting started',
            'title'     => 'Setting up your profile in 30 minutes',
            'desc'      => 'A walk-through of bio, photo, specializations, and slot configuration.',
            'read_time' => '5 min read',
            'image_url' => 'https://images.unsplash.com/photo-1515378960530-7c0da6231fb1?q=80',
        ],
        [
            'category'  => 'Getting started',
            'title'     => 'Choosing your first hourly rate',
            'desc'      => 'How experience, specialty, and location should shape what you charge.',
            'read_time' => '4 min read',
            'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop&q=80',
        ],
        [
            'category'  => 'Growing your practice',
            'title'     => 'Three ways to encourage repeat consultations',
            'desc'      => 'What experienced lawyers do during the first meeting to build trust.',
            'read_time' => '6 min read',
            'image_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80',
        ],
        [
            'category'  => 'Growing your practice',
            'title'     => 'Writing a bio that builds trust',
            'desc'      => 'Specifics, plain language, and what to leave out.',
            'read_time' => '3 min read',
            'image_url' => 'https://images.unsplash.com/photo-1542435503-956c469947f6?q=80',
        ],
        [
            'category'  => 'Platform updates',
            'title'     => 'What changed in our verification process this year',
            'desc'      => 'Faster reviews, new document checks, and what reviewers look for.',
            'read_time' => '4 min read',
            'image_url' => 'https://images.unsplash.com/photo-1624555130882-dcfa8ecb17ce?q=80',
        ],
        [
            'category'  => 'Earnings & payments',
            'title'     => 'How deposits and payouts work',
            'desc'      => 'What the platform holds, what goes to you, and when.',
            'read_time' => '5 min read',
            'image_url' => 'https://images.unsplash.com/photo-1633158829585-23ba8f7c8caf?q=80',
        ],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=2000&h=1200&fit=crop&q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Resources</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Run a better practice.
            </h1>
        </div>
    </section>

    {{-- Featured article --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Featured</h2>

        <a href="#" class="mt-12 block group">
            <article class="grid gap-8 md:grid-cols-2 md:items-center md:gap-12">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $featured['image_url'] }}"
                         alt=""
                         loading="lazy"
                         class="aspect-[4/3] w-full object-cover grayscale transition-transform duration-500 group-hover:scale-[1.02]">
                </div>
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $featured['category'] }}</p>
                    <h2 class="mt-4 font-display text-[32px] font-medium leading-[1.1] tracking-[-0.02em] md:text-[40px] group-hover:text-accent">
                        {{ $featured['title'] }}
                    </h2>
                    <p class="mt-5 max-w-[520px] text-[16px] leading-relaxed text-secondary">
                        {{ $featured['lead'] }}
                    </p>
                    <p class="mt-6 inline-flex items-center gap-2 text-[14px] font-medium text-text">
                        {{ $featured['read_time'] }}
                        <span class="mx-1 text-muted/40">·</span>
                        <span class="transition-colors group-hover:text-accent">Read →</span>
                    </p>
                </div>
            </article>
        </a>
    </section>

    {{-- All resources --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">All resources</h2>

        <div class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
                <a href="#" class="group flex flex-col">
                    <div class="overflow-hidden rounded-xl">
                        <img src="{{ $article['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="aspect-[4/3] w-full object-cover grayscale transition-transform duration-500 group-hover:scale-[1.02]">
                    </div>
                    <p class="mt-5 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $article['category'] }}</p>
                    <h3 class="mt-2 font-display text-[22px] font-medium leading-tight tracking-tight transition-colors group-hover:text-accent">
                        {{ $article['title'] }}
                    </h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                        {{ $article['desc'] }}
                    </p>
                    <p class="mt-4 text-[13px] text-muted">{{ $article['read_time'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Can't find what you need?
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            Our support team responds within one business day.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Contact support →</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app')

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $featuredLawyers = \App\Data\Lawyers::featured(3);
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative mx-auto flex min-h-[85vh] max-w-[1280px] items-center px-8 py-20">
        <div class="grid w-full items-center gap-12 md:grid-cols-5">
            <div class="md:col-span-3">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                    Trusted legal consultation
                </p>

                <h1 class="mt-6 font-display text-[64px] font-medium leading-[1.02] tracking-[-0.03em] md:text-[80px]">
                    Find the right lawyer, for the moment that matters.
                </h1>

                <p class="mt-6 max-w-xl text-[18px] leading-relaxed text-secondary">
                    Transparent pricing. Verified credentials. Real-time availability. Meet Vietnam's most trusted legal professionals on your terms.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-button variant="primary" href="/lawyers">Browse lawyers →</x-button>
                    <x-button variant="ghost" href="#how-it-works">How it works</x-button>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="relative">
                    <div aria-hidden="true"
                         class="pointer-events-none absolute -inset-10 rounded-full bg-gradient-to-br from-muted to-accent opacity-15 blur-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1758518727600-2c5f48419eac?q=80"
                         alt=""
                         class="relative aspect-[3/4] w-full rounded-2xl object-cover grayscale">
                </div>
            </div>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="bg-surface">
        <div class="mx-auto flex h-24 max-w-[1280px] items-center justify-center px-8">
            <div class="grid w-full grid-cols-1 divide-y divide-text/10 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">500+</p>
                    <p class="mt-2 text-[14px] text-muted">Verified lawyers</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">4.8</p>
                    <p class="mt-2 text-[14px] text-muted">Average rating</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">10,000+</p>
                    <p class="mt-2 text-[14px] text-muted">Consultations completed</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Practice areas --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-20">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">Areas we cover</h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                <div class="rounded-2xl border border-text/10 bg-surface p-8">
                    <x-icon :name="$area['icon']" :size="32" class="text-accent" />
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $area['name'] }}</h3>
                    <p class="mt-2 text-[14px] text-muted">{{ $area['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Featured lawyers --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-20">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">Featured lawyers</h2>
            <x-button variant="ghost" href="/lawyers">See all lawyers →</x-button>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredLawyers as $lawyer)
                <x-lawyer-card :lawyer="$lawyer" />
            @endforeach
        </div>
    </section>

    {{-- How it works --}}
    <section id="how-it-works" class="mx-auto max-w-[1280px] px-8 py-20">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[40px]">How it works</h2>

        @php
            $steps = [
                ['n' => '01', 'title' => 'Search',  'text' => 'Tell us your legal area and preferred time.'],
                ['n' => '02', 'title' => 'Choose',  'text' => 'Review profiles, ratings, and real-time availability.'],
                ['n' => '03', 'title' => 'Meet',    'text' => 'Confirm your 60-minute consultation.'],
            ];
        @endphp

        <div class="relative mt-16 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($steps as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection

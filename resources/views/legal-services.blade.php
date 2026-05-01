@extends('layouts.app', ['title' => 'Legal Services · LegalEase'])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $firstHalf  = array_slice($practiceAreas, 0, 3);
    $secondHalf = array_slice($practiceAreas, 3);
@endphp

@section('content')
    {{-- Hero: full-bleed photo with overlay --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Browse by need
            </p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Not sure where to start?
            </h1>

            <p class="mx-auto mt-8 max-w-[600px] text-[18px] leading-relaxed text-secondary">
                Most people don't know what kind of lawyer they need until someone explains it. This page does that.
            </p>
        </div>
    </section>

    {{-- Practice areas grid: first half --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($firstHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 1])
            @endforeach
        </div>
    </section>

    {{-- Pull quote --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-20">
        <div class="border-y border-text/10 py-16 md:py-20">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">“</span>You're going through a divorce and need to figure out child custody.<span class="text-muted">”</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.12em] text-muted">
                The kind of sentence that brings someone here
            </p>
        </div>
    </section>

    {{-- Practice areas grid: second half --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-20">
        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($secondHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 4])
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Still not sure?</p>
        <h2 class="mt-6 font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Browse all lawyers and filter as you go.
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            500+ verified lawyers across 12 cities, with rates and credentials posted upfront.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Browse all lawyers →</x-button>
        </div>
    </section>
@endsection

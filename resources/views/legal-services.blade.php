@extends('layouts.app', ['title' => 'Legal Services · LegalEase'])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
@endphp

@section('content')
    {{-- Hero --}}
    <section class="mx-auto flex min-h-[320px] max-w-[1280px] items-end px-8 pt-32 pb-16">
        <div class="max-w-[820px]">
            <p class="animate-fade-up text-[12px] font-medium uppercase tracking-[0.1em] text-muted"
               style="animation-delay: 0ms">
                Browse by need
            </p>

            <h1 class="animate-fade-up mt-6 font-display text-[52px] font-medium leading-[1.04] tracking-[-0.02em] md:text-[76px]"
                style="animation-delay: 100ms">
                Not sure where to start?
            </h1>

            <p class="animate-fade-up mt-8 max-w-[640px] text-[18px] leading-relaxed text-secondary"
               style="animation-delay: 200ms">
                Most people don't know what kind of lawyer they need until someone explains it. This page does that.
            </p>
        </div>
    </section>

    {{-- Intro --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-16">
        <p class="max-w-[720px] text-[17px] leading-relaxed text-secondary">
            Each practice area below covers a different kind of legal problem. Find the one that matches your situation, then browse lawyers who specialize in it.
        </p>
    </section>

    {{-- Practice areas grid --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-16">
        <div class="grid gap-px overflow-hidden rounded-2xl bg-text/10 md:grid-cols-2">
            @foreach ($practiceAreas as $i => $area)
                <article class="flex flex-col bg-bg p-8 md:p-10">
                    <div class="flex items-center gap-4">
                        <span class="font-display text-[14px] font-medium text-muted">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="h-px flex-1 max-w-[40px] bg-text/20"></span>
                        <x-icon :name="$area['icon']" :size="22" class="text-muted" />
                    </div>

                    <h2 class="mt-6 font-display text-[28px] font-medium leading-tight tracking-[-0.01em] md:text-[32px]">
                        {{ $area['name'] }}
                    </h2>

                    <p class="mt-3 text-[15px] text-muted">
                        {{ $area['description'] }}
                    </p>

                    @if (!empty($area['scenarios']))
                        <p class="mt-8 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                            You might come here if
                        </p>
                        <ul class="mt-4 space-y-3 text-[15px] leading-relaxed text-secondary">
                            @foreach ($area['scenarios'] as $scenario)
                                <li class="flex gap-3">
                                    <span class="mt-[10px] block h-px w-3 flex-none bg-text/30"></span>
                                    <span>{{ $scenario }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-auto pt-8">
                        <a href="/lawyers"
                           class="inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                            Browse {{ $area['name'] }} lawyers
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </article>
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

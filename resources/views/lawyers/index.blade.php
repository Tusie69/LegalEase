@extends('layouts.app', ['title' => 'Lawyers · LegalEase'])

@php
    $lawyers = \App\Data\Lawyers::all();

    $specialties = [
        'Family Law', 'Business Law', 'Real Estate', 'Criminal Defense',
        'Labor Law', 'Civil Litigation', 'Tax Law', 'Immigration Law',
    ];
    $languages = ['Vietnamese', 'English', 'Both'];
@endphp

@section('content')
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        {{-- Header --}}
        <nav class="text-[14px] text-muted">
            <a href="/" class="transition-colors hover:text-accent">Home</a>
            <span class="px-1">/</span>
            <span class="text-text">Lawyers</span>
        </nav>

        <h1 class="mt-6 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
            Find your lawyer
        </h1>
        <p class="mt-3 text-[17px] text-secondary">Browse 500+ verified lawyers across Vietnam.</p>

        <div class="mt-10 grid grid-cols-1 gap-12 md:grid-cols-[240px_1fr]">
            {{-- Sidebar filters --}}
            <aside class="self-start md:sticky md:top-[88px]">
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[20px] font-medium tracking-tight">Filters</h3>

                    {{-- Specialty --}}
                    <div class="mt-6">
                        <h4 class="text-[13px] font-medium uppercase tracking-[0.08em] text-muted">Specialty</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($specialties as $spec)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $spec }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price range --}}
                    <div class="mt-8" x-data="{ max: 3000000 }">
                        <h4 class="text-[13px] font-medium uppercase tracking-[0.08em] text-muted">Price range</h4>
                        <input type="range" min="500000" max="5000000" step="100000"
                               x-model="max"
                               class="mt-4 w-full accent-accent">
                        <p class="mt-2 text-[13px] text-muted">
                            500,000 — <span x-text="Number(max).toLocaleString('en-US')"></span> VND
                        </p>
                    </div>

                    {{-- Minimum rating --}}
                    <div class="mt-8" x-data="{ stars: 4 }">
                        <h4 class="text-[13px] font-medium uppercase tracking-[0.08em] text-muted">Minimum rating</h4>
                        <div class="mt-3 flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button"
                                        @click="stars = {{ $i }}"
                                        class="p-0.5 transition-colors"
                                        :class="stars >= {{ $i }} ? 'text-accent' : 'text-text/20 hover:text-text/40'">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        <p class="mt-2 text-[13px] text-muted">
                            <span x-text="stars"></span>+ stars
                        </p>
                    </div>

                    {{-- Language --}}
                    <div class="mt-8">
                        <h4 class="text-[13px] font-medium uppercase tracking-[0.08em] text-muted">Language</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($languages as $lang)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 border-t border-text/10 pt-4">
                        <button type="button" class="text-[14px] text-muted transition-colors hover:text-accent hover:underline underline-offset-4">
                            Reset filters
                        </button>
                    </div>
                </div>
            </aside>

            {{-- Results --}}
            <div>
                {{-- Search + Sort row --}}
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="relative flex-1 md:max-w-md">
                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-muted">
                            <x-icon name="search" :size="18" />
                        </span>
                        <input type="search"
                               placeholder="Search by name or specialty"
                               class="w-full rounded-full border border-text/10 bg-surface py-3 pl-11 pr-4 text-[14px] text-text placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>

                    <div class="relative">
                        <select class="appearance-none rounded-full border border-text/10 bg-surface py-3 pl-5 pr-11 text-[14px] text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                            <option>Best match</option>
                            <option>Highest rated</option>
                            <option>Lowest price</option>
                            <option>Most experienced</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-muted">
                            <x-icon name="chevron-down" :size="16" />
                        </span>
                    </div>
                </div>

                {{-- Results grid --}}
                <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($lawyers as $lawyer)
                        <x-lawyer-card :lawyer="$lawyer" />
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-16 flex items-center justify-center gap-2 text-[14px]">
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">← Previous</a>
                    <a href="#" class="rounded-full bg-surface px-4 py-2 text-accent">1</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">2</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">3</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">Next →</a>
                </div>
            </div>
        </div>
    </section>
@endsection

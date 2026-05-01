@extends('layouts.app', ['title' => 'Lawyers · LegalEase'])

@php
    $allLawyers = \App\Data\Lawyers::all();

    $specialties = [
        'Family Law', 'Business Law', 'Real Estate', 'Criminal Defense',
        'Labor Law', 'Civil Litigation',
    ];
    $locations = ['Hanoi', 'Ho Chi Minh City', 'Da Nang'];
    $languages = ['Vietnamese', 'English'];

    // Minimal slice of lawyer data for client-side filtering — keeps the JS payload small.
    $lawyersForFilter = array_map(fn ($l) => [
        'specialty_tags' => $l['specialty_tags'],
        'price_per_hour' => $l['price_per_hour'],
        'languages'      => $l['languages'],
        'province'       => $l['address']['province'] ?? null,
    ], $allLawyers);
@endphp

@section('content')
    <section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24"
             x-data="lawyerFilters({{ json_encode($lawyersForFilter) }})">
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
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Specialty</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($specialties as $spec)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $spec }}" x-model="specialties"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $spec }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Location</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($locations as $loc)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $loc }}" x-model="locations"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $loc }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price range --}}
                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Price range</h4>
                        <input type="range" min="500000" max="5000000" step="100000"
                               x-model.number="maxPrice"
                               class="mt-4 w-full accent-accent">
                        <p class="mt-2 text-[13px] text-muted">
                            500,000 to <span x-text="Number(maxPrice).toLocaleString('en-US')"></span> VND
                        </p>
                    </div>

                    {{-- Language --}}
                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Language</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($languages as $lang)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $lang }}" x-model="languages"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Reset --}}
                    <div class="mt-8 border-t border-text/10 pt-4" x-show="hasActiveFilters" x-cloak>
                        <button type="button" @click="reset()"
                                class="text-[14px] text-muted transition-colors hover:text-accent hover:underline underline-offset-4">
                            Reset filters
                        </button>
                    </div>
                </div>
            </aside>

            {{-- Results --}}
            <div>
                {{-- No results --}}
                <div x-show="visibleCount === 0" x-cloak
                     class="flex flex-col items-center justify-center rounded-2xl border border-text/10 bg-surface px-8 py-20 text-center">
                    <h3 class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                        No lawyers match your filters.
                    </h3>
                    <p class="mt-3 max-w-md text-[15px] leading-relaxed text-secondary">
                        Try adjusting or clearing some filters to see more options.
                    </p>
                    <button type="button" @click="reset()"
                            class="mt-8 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                        Reset filters
                        <span aria-hidden="true">→</span>
                    </button>
                </div>

                {{-- Results grid --}}
                <div x-show="visibleCount > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($allLawyers as $i => $lawyer)
                        <div x-show="matches(lawyersForFilter[{{ $i }}])" x-cloak>
                            <x-lawyer-card :lawyer="$lawyer" />
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div x-show="visibleCount > 0"
                     class="mt-16 flex items-center justify-center gap-2 text-[14px]">
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">← Previous</a>
                    <a href="#" class="rounded-full bg-surface px-4 py-2 text-accent">1</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">2</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">3</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">Next →</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function lawyerFilters(allLawyers) {
            return {
                lawyersForFilter: allLawyers,
                specialties: [],
                locations: [],
                languages: [],
                maxPrice: 5000000,

                get hasActiveFilters() {
                    return this.specialties.length > 0
                        || this.locations.length > 0
                        || this.languages.length > 0
                        || this.maxPrice < 5000000;
                },

                get visibleCount() {
                    return this.lawyersForFilter.filter(l => this.matches(l)).length;
                },

                matches(lawyer) {
                    if (this.specialties.length > 0
                        && !lawyer.specialty_tags.some(s => this.specialties.includes(s))) return false;
                    if (this.locations.length > 0
                        && !this.locations.includes(lawyer.province)) return false;
                    if (this.languages.length > 0
                        && !lawyer.languages.some(l => this.languages.includes(l))) return false;
                    if (lawyer.price_per_hour > this.maxPrice) return false;
                    return true;
                },

                reset() {
                    this.specialties = [];
                    this.locations = [];
                    this.languages = [];
                    this.maxPrice = 5000000;
                },
            };
        }
    </script>
@endsection

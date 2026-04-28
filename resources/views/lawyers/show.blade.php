@extends('layouts.app', ['title' => $lawyer['name'] . ' · LegalEase'])

@php
    use Carbon\Carbon;

    $today = Carbon::today('Asia/Ho_Chi_Minh');
    $days = [];
    foreach ($lawyer['availability'] as $entry) {
        $date = $today->copy()->addDays($entry['day_offset']);
        $slotList = [];
        foreach ($entry['slots'] as $t) {
            $slotList[] = [
                'time'  => $t,
                'label' => Carbon::createFromFormat('H:i', $t)->format('g:i A'),
            ];
        }
        $days[] = [
            'abbrev'  => strtoupper($date->format('D')),
            'dayNum'  => $date->day,
            'dateStr' => $date->toDateString(),
            'slots'   => $slotList,
        ];
    }
@endphp

@section('content')
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <nav class="text-[14px] text-muted">
            <a href="/" class="transition-colors hover:text-accent">Home</a>
            <span class="px-1">/</span>
            <a href="/lawyers" class="transition-colors hover:text-accent">Lawyers</a>
            <span class="px-1">/</span>
            <span class="text-text">{{ $lawyer['name'] }}</span>
        </nav>

        <div class="mt-10 grid gap-16 md:grid-cols-3">
            {{-- Left: profile --}}
            <div class="md:col-span-2">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $lawyer['portrait_url'] }}"
                         alt="{{ $lawyer['name'] }}"
                         class="aspect-[4/5] max-h-[560px] w-full object-cover object-top grayscale">
                </div>

                <div class="mt-10 flex items-center gap-3">
                    <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
                        {{ $lawyer['name'] }}
                    </h1>
                    @if (($lawyer['verification_status'] ?? null) === 'VERIFIED')
                        <span title="Verified" class="inline-flex h-7 w-7 flex-none items-center justify-center rounded-full bg-white/10 text-text">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                    @endif
                </div>
                <p class="mt-2 text-[15px] text-muted">
                    Attorney at Law
                    @if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }} @endif
                    · {{ $lawyer['years_of_experience'] }} years experience
                </p>

                <div class="mt-3">
                    <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" />
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($lawyer['specialty_tags'] as $tag)
                        <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[12px] font-medium text-muted">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>

                {{-- About --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">About</h2>
                    <div class="mt-4 space-y-4 text-[16px] leading-relaxed text-secondary">
                        @foreach ($lawyer['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Education --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Education</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach ($lawyer['education'] as $edu)
                            <li class="flex items-baseline justify-between gap-6 border-b border-white/10 pb-3">
                                <div>
                                    <p class="text-[15px] text-text">{{ $edu['degree'] }}</p>
                                    <p class="text-[14px] text-muted">{{ $edu['institution'] }}</p>
                                </div>
                                <span class="text-[14px] text-muted">{{ $edu['year'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Languages --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Languages</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['languages'] as $lang)
                            <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[13px] text-text">
                                {{ $lang }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Practice areas --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Practice areas</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['specialty_tags'] as $tag)
                            <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[13px] text-text">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Reviews --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Client reviews</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($lawyer['reviews'] as $review)
                            @php
                                $initial = mb_strtoupper(mb_substr($review['author'], 0, 1));
                                $reviewDate = Carbon::parse($review['date'])->format('M j, Y');
                            @endphp
                            <article class="rounded-2xl border border-white/10 bg-surface p-6">
                                <header class="flex items-start gap-4">
                                    <div class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-accent font-display text-[18px] font-medium text-bg">
                                        {{ $initial }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-baseline justify-between gap-4">
                                            <p class="text-[15px] font-medium text-text">{{ $review['author'] }}</p>
                                            <p class="text-[13px] text-muted">{{ $reviewDate }}</p>
                                        </div>
                                        <div class="mt-1">
                                            <x-rating-stars :rating="$review['stars']" size="sm" />
                                        </div>
                                    </div>
                                </header>
                                <p class="mt-4 text-[15px] leading-relaxed text-text/90">{{ $review['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right: booking panel --}}
            <aside class="md:col-span-1">
                <div class="md:sticky md:top-[88px]"
                     x-data='{
                        selected: 0,
                        days: @json($days),
                        pickSlot(dateStr, time, label) {
                            const params = new URLSearchParams({
                                lawyer: "{{ $lawyer['slug'] }}",
                                date: dateStr,
                                time: time,
                            });
                            window.location.href = "{{ route('login') }}?" + params.toString();
                        }
                    }'>
                    <div class="rounded-2xl border border-white/10 bg-surface p-8">
                        <h3 class="font-display text-[24px] font-medium tracking-tight">Book a consultation</h3>

                        <div class="mt-4">
                            <p class="font-display text-[32px] font-medium leading-none tracking-tight text-accent">
                                {{ number_format($lawyer['price_per_hour']) }} VND
                            </p>
                            <p class="mt-2 text-[13px] text-muted">per consultation</p>
                        </div>

                        @if (!empty($lawyer['address']['street_address']))
                            <div class="mt-5 flex items-start gap-2 text-[13px]">
                                <svg class="mt-[2px] h-4 w-4 flex-none text-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="text-secondary">
                                    {{ $lawyer['address']['street_address'] }},
                                    <span class="text-muted">{{ $lawyer['address']['province'] }}</span>
                                </span>
                            </div>
                        @endif

                        <div class="my-6 h-px bg-white/10"></div>

                        {{-- Date pills --}}
                        <div class="flex gap-2 overflow-x-auto pb-1">
                            @foreach ($days as $i => $day)
                                <button type="button"
                                        @click="selected = {{ $i }}"
                                        :class="selected === {{ $i }} ? 'bg-text text-bg border-text' : 'border-muted/60 text-text hover:border-accent'"
                                        class="flex min-w-[56px] flex-col items-center rounded-xl border px-2 py-2 transition-colors">
                                    <span class="text-[11px] font-medium uppercase tracking-[0.08em]"
                                          :class="selected === {{ $i }} ? 'text-bg/60' : 'text-muted'">
                                        {{ $day['abbrev'] }}
                                    </span>
                                    <span class="mt-0.5 font-display text-[20px] font-medium leading-none">
                                        {{ $day['dayNum'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <h4 class="text-[13px] font-medium uppercase tracking-[0.08em] text-muted">Available times</h4>
                        </div>

                        @foreach ($days as $i => $day)
                            <div x-show="selected === {{ $i }}" x-cloak class="mt-4 grid grid-cols-2 gap-3">
                                @foreach ($day['slots'] as $slot)
                                    <button type="button"
                                            @click="pickSlot('{{ $day['dateStr'] }}', '{{ $slot['time'] }}', '{{ $slot['label'] }}')"
                                            class="rounded-xl border border-muted/60 px-3 py-3 text-center text-[13px] text-text transition-colors hover:border-accent hover:bg-accent/10">
                                        {{ $slot['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        @endforeach

                        <p class="mt-6 text-[13px] leading-relaxed text-muted">
                            You'll confirm details after choosing a time.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

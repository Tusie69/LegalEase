@extends('layouts.app', ['title' => 'Hồ sơ luật sư · LegalEase'])

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
            'abbrev'  => ['CN','T2','T3','T4','T5','T6','T7'][$date->dayOfWeek],
            'dayNum'  => $date->day,
            'dateStr' => $date->toDateString(),
            'slots'   => $slotList,
        ];
    }

    $reviews3       = array_slice($lawyer['reviews'] ?? [], 0, 3);
    $focusAreas     = array_slice($lawyer['specialty_tags'] ?? [], 0, 4);
    $relatedLawyers = collect(\App\Data\Lawyers::all())
        ->filter(fn ($l) => $l['slug'] !== $lawyer['slug']
            && ($l['primary_specialty'] ?? null) === ($lawyer['primary_specialty'] ?? null))
        ->take(3)
        ->values()
        ->all();

    $verified  = ($lawyer['verification_status'] ?? null) === 'VERIFIED';
    $tagline   = !empty($lawyer['bar_association'])
        ? 'Thành viên ' . $lawyer['bar_association'] . '.'
        : 'Luật sư chuyên về ' . ($lawyer['primary_specialty'] ?? 'pháp lý') . '.';
@endphp

@section('content')
    <section class="container-page pt-12 pb-24">
        {{-- Breadcrumb --}}
        <nav class="text-eyebrow flex items-center gap-2 text-text/55">
            <a href="/lawyers" class="transition-colors hover:text-text">Luật sư</a>
            <span class="text-text/35">/</span>
            <span class="text-text">{{ $lawyer['name'] }}</span>
        </nav>

        {{-- HERO --}}
        <header class="mt-10 grid items-end gap-8 border-b border-text/15 pb-14 lg:grid-cols-[1fr_1.4fr] lg:gap-14">
            <div class="relative overflow-hidden rounded-2xl bg-text/5">
                <x-responsive-img :src="$lawyer['portrait_url']"
                                  :alt="$lawyer['name']"
                                  loading="eager"
                                  sizes="(min-width: 1024px) 480px, 100vw"
                                  :widths="[480, 720, 960]"
                                  class="aspect-[3/4] w-full object-cover object-top" />
                @if ($verified)
                    <span class="text-form-hint absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full border border-bg/20 bg-accent px-3 py-1.5 font-semibold uppercase tracking-wider text-bg">
                        <x-icon name="check" :size="12" class="stroke-[3]" />
                        Đã xác minh
                    </span>
                @endif
            </div>

            <div class="pb-2">
                <p class="text-eyebrow inline-flex items-center gap-3 text-text/60">
                    <span>{{ $lawyer['primary_specialty'] }}</span>
                    @if (!empty($lawyer['address']['province']))
                        <span aria-hidden="true" class="inline-block h-1 w-1 rounded-full bg-accent"></span>
                        <span>{{ $lawyer['address']['province'] }}</span>
                    @endif
                </p>

                <h1 class="font-display mt-5 text-5xl font-semibold leading-[0.95] tracking-tight text-text md:text-6xl lg:text-7xl">
                    {{ $lawyer['name'] }}
                </h1>

                <span aria-hidden="true" class="my-6 block h-0.5 w-12 bg-accent"></span>

                <p class="font-display text-2xl italic font-medium leading-snug text-text/75">
                    {{ $tagline }}
                </p>

                <div class="text-body-dense mt-6 flex flex-wrap items-center gap-x-3 gap-y-2 text-text/70">
                    <span class="inline-flex items-center gap-1.5 text-text">
                        <svg class="h-3.5 w-3.5 fill-gold-bright text-gold-bright" viewBox="0 0 24 24">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        <span class="font-medium">{{ number_format($lawyer['rating'], 1) }}</span>
                        <span class="text-text/60">· {{ $lawyer['review_count'] }} đánh giá</span>
                    </span>
                    <span class="text-text/30">·</span>
                    <span>{{ $lawyer['years_of_experience'] }} năm kinh nghiệm</span>
                    <span class="text-text/30">·</span>
                    <span>{{ implode(', ', $lawyer['languages']) }}</span>
                </div>
            </div>
        </header>

        {{-- STAT TILES --}}
        <div class="grid grid-cols-2 divide-x divide-text/15 border-b border-text/15 md:grid-cols-4">
            <div class="px-6 py-8 first:pl-0 md:py-10">
                <p class="font-display text-5xl font-semibold leading-none tracking-tight text-text">
                    {{ $lawyer['years_of_experience'] }}<span class="ml-1.5 text-2xl font-medium text-text/55">năm</span>
                </p>
                <p class="text-eyebrow mt-4 text-text/60">Kinh nghiệm hành nghề</p>
            </div>
            <div class="px-6 py-8 md:py-10">
                <p class="font-display text-5xl font-semibold leading-none tracking-tight text-text">
                    {{ count($lawyer['notable_cases'] ?? []) ?: count($lawyer['reviews'] ?? []) }}
                </p>
                <p class="text-eyebrow mt-4 text-text/60">Vụ án tiêu biểu</p>
            </div>
            <div class="px-6 py-8 md:py-10">
                <p class="font-display text-5xl font-semibold leading-none tracking-tight text-text">
                    {{ number_format($lawyer['rating'], 1) }}<span class="ml-1.5 text-2xl font-medium text-text/55">/ 5</span>
                </p>
                <p class="text-eyebrow mt-4 text-text/60">Đánh giá khách hàng</p>
            </div>
            @php
                $startYear = (int) Carbon::now()->year - (int) $lawyer['years_of_experience'];
            @endphp
            <div class="px-6 py-8 last:pr-0 md:py-10">
                <p class="font-display text-5xl font-semibold leading-none tracking-tight text-text">
                    {{ $startYear }}
                </p>
                <p class="text-eyebrow mt-4 text-text/60">Bắt đầu hành nghề</p>
            </div>
        </div>

        {{-- BODY: 2-column with content + booking sidebar --}}
        <div class="mt-14 grid gap-14 {{ request('embed') ? '' : 'lg:grid-cols-[1.55fr_1fr] lg:gap-16' }}">
            <div class="min-w-0 space-y-16">

                {{-- Lĩnh vực chuyên môn --}}
                @if (!empty($focusAreas))
                    <section>
                        <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                            <h2 class="text-card-h3">Lĩnh vực chuyên môn</h2>
                        </div>
                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            @foreach ($focusAreas as $i => $tag)
                                <div class="flex items-center gap-4 rounded-2xl border border-text/15 bg-bg p-5 transition-colors hover:border-accent">
                                    <span class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-accent text-form-hint font-semibold text-bg">
                                        {{ sprintf('%02d', $i + 1) }}
                                    </span>
                                    <p class="text-card-h5">{{ $tag }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Giới thiệu --}}
                <section>
                    <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                        <h2 class="text-card-h3">Giới thiệu</h2>
                    </div>
                    <div class="text-body mt-6 space-y-4 text-text/85">
                        @foreach ($lawyer['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </section>

                {{-- Học vấn + Kinh nghiệm grid --}}
                <section class="grid gap-12 md:grid-cols-2 md:gap-10">
                    <div>
                        <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                            <h2 class="text-card-h3">Học vấn</h2>
                        </div>
                        <ul class="mt-6 space-y-6 border-l border-text/15 pl-6">
                            @foreach (collect($lawyer['education'])->sortByDesc('year') as $edu)
                                <li class="relative">
                                    <span aria-hidden="true" class="absolute -left-[29px] top-1.5 h-2 w-2 rounded-full bg-accent"></span>
                                    <p class="text-form-hint font-semibold uppercase tracking-wider text-text/60">{{ $edu['year'] }}</p>
                                    <p class="text-card-h5 mt-1">{{ $edu['degree'] }}</p>
                                    <p class="text-caption text-text/65">{{ $edu['institution'] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if (!empty($lawyer['work_experience']))
                        <div>
                            <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                                <h2 class="text-card-h3">Kinh nghiệm</h2>
                            </div>
                            <ul class="mt-6 space-y-6 border-l border-text/15 pl-6">
                                @foreach ($lawyer['work_experience'] as $job)
                                    <li class="relative">
                                        <span aria-hidden="true" class="absolute -left-[29px] top-1.5 h-2 w-2 rounded-full bg-accent"></span>
                                        <p class="text-form-hint font-semibold uppercase tracking-wider text-text/60">{{ $job['period'] }}</p>
                                        <p class="text-card-h5 mt-1">{{ $job['title'] }}</p>
                                        <p class="text-caption text-text/65">{{ $job['firm'] }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </section>

                {{-- Vụ án tiêu biểu --}}
                @if (!empty($lawyer['notable_cases']))
                    <section>
                        <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                            <h2 class="text-card-h3">Vụ án tiêu biểu</h2>
                        </div>
                        <div class="mt-6 flex flex-col gap-3">
                            @foreach ($lawyer['notable_cases'] as $case)
                                <article class="rounded-2xl border border-text/15 bg-bg p-6">
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-form-hint inline-block rounded-full bg-text/5 px-3 py-1 font-semibold uppercase tracking-wider text-text">
                                            {{ $lawyer['primary_specialty'] }}
                                        </span>
                                    </div>
                                    <h3 class="font-display mt-3 text-lg italic font-medium text-text">{{ $case['name'] }}</h3>
                                    <p class="text-body-dense mt-2 flex items-start gap-2 text-text/75">
                                        <span class="mt-0.5 inline-flex h-4 w-4 flex-none items-center justify-center rounded-full bg-accent/10 text-accent">
                                            <x-icon name="check" :size="10" class="stroke-[3]" />
                                        </span>
                                        <span>{{ $case['outcome'] }}</span>
                                    </p>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Đánh giá khách hàng --}}
                @if (!empty($reviews3))
                    <section>
                        <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                            <h2 class="text-card-h3">Đánh giá khách hàng</h2>
                            <span class="text-form-hint font-semibold uppercase tracking-wider text-text/60">
                                {{ $lawyer['review_count'] }} đánh giá
                            </span>
                        </div>
                        <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($reviews3 as $review)
                                @php
                                    $initial = mb_strtoupper(mb_substr($review['author'], 0, 1));
                                    $reviewDate = Carbon::parse($review['date'])->format('m/Y');
                                @endphp
                                <article class="flex flex-col rounded-2xl border border-text/15 bg-bg p-6">
                                    <div aria-hidden="true" class="font-display text-3xl leading-none text-accent/30">“</div>
                                    <p class="font-display text-body mt-1 flex-1 italic text-text/85">{{ $review['text'] }}</p>
                                    <div class="mt-5">
                                        <x-rating-stars :rating="$review['stars']" size="sm" />
                                    </div>
                                    <div class="mt-3 flex items-center gap-3">
                                        <div class="text-form-hint flex h-8 w-8 flex-none items-center justify-center rounded-full bg-text/10 font-semibold text-text">
                                            {{ $initial }}
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-caption font-semibold text-text">{{ $review['author'] }}</p>
                                            <p class="text-form-hint text-text/55">{{ $reviewDate }}</p>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Liên quan --}}
                @if (!empty($relatedLawyers) && !request('embed'))
                    <section>
                        <div class="flex items-baseline justify-between border-b border-text/15 pb-4">
                            <h2 class="text-card-h3">Luật sư cùng lĩnh vực</h2>
                        </div>
                        <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($relatedLawyers as $related)
                                <a href="/lawyers/{{ $related['slug'] }}"
                                   class="group relative block aspect-[3/4] overflow-hidden rounded-2xl bg-accent text-bg">
                                    <x-responsive-img :src="$related['portrait_url']"
                                                      :alt="$related['name']"
                                                      sizes="(min-width: 1024px) 240px, 45vw"
                                                      :widths="[300, 480, 600]"
                                                      class="absolute inset-0 h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.04]" />
                                    <span aria-hidden="true" class="pointer-events-none absolute inset-x-0 bottom-0 h-[44%] bg-accent opacity-55"></span>
                                    <div class="absolute inset-x-4 bottom-4">
                                        <p class="font-display text-xl font-medium leading-tight tracking-tight text-bg">
                                            {{ $related['name'] }}
                                        </p>
                                        <p class="text-form-hint mt-1 text-bg/80">
                                            @if (!empty($related['address']['province']))
                                                {{ $related['address']['province'] }} ·
                                            @endif
                                            {{ $related['years_of_experience'] }} năm kinh nghiệm
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>

            {{-- Booking sidebar: hidden in slide-over (embed=1) so users return to /match/results to act --}}
            @unless (request('embed'))
            <aside class="min-w-0">
                <div class="lg:sticky lg:top-22"
                     x-data='{
                        selected: 0,
                        selectedSlot: null,
                        days: @json($days),
                        chooseSlot(dateStr, time, label) {
                            this.selectedSlot = { date: dateStr, time: time, label: label };
                        },
                        confirmBooking() {
                            if (!this.selectedSlot) return;
                            const params = new URLSearchParams({
                                lawyer: "{{ $lawyer['slug'] }}",
                                date: this.selectedSlot.date,
                                time: this.selectedSlot.time,
                            });
                            window.location.href = "{{ route('book.start') }}?" + params.toString();
                        }
                    }'>
                    <div class="flex min-h-[560px] flex-col rounded-2xl bg-accent p-8">
                        <h3 class="text-card-h3 text-bg">Đặt lịch tư vấn</h3>

                        <div class="mt-4">
                            <p class="display-stat text-gold">
                                {{ number_format($lawyer['price_per_hour']) }} VND
                            </p>
                            <p class="text-caption mt-2 text-bg/80">cho mỗi buổi tư vấn</p>
                        </div>

                        @if (!empty($lawyer['address']['street_address']))
                            <div class="mt-5 flex items-start gap-2 text-caption text-bg/80">
                                <x-icon name="map-pin" :size="16" class="flex-none" />
                                <span>
                                    {{ $lawyer['address']['street_address'] }}, {{ $lawyer['address']['province'] }}
                                </span>
                            </div>
                        @endif

                        <div class="my-6 h-px bg-bg/20"></div>

                        {{-- Day picker --}}
                        <div class="flex gap-1.5 overflow-hidden pb-1">
                            @foreach ($days as $i => $day)
                                <button type="button"
                                        @click="selected = {{ $i }}"
                                        :class="selected === {{ $i }} ? 'bg-gold text-accent border-gold' : 'border-bg/30 text-bg hover:border-bg'"
                                        class="flex min-w-0 flex-1 flex-col items-center rounded-xl border px-1 py-2 transition-colors">
                                    <span class="text-eyebrow-tight"
                                          :class="selected === {{ $i }} ? 'text-accent/70' : 'text-bg/60'">
                                        {{ $day['abbrev'] }}
                                    </span>
                                    <span class="mt-0.5 text-card-h5 leading-none">
                                        {{ $day['dayNum'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        {{-- Time slots --}}
                        <div class="mt-6">
                            <h4 class="text-eyebrow text-gold">Khung giờ còn trống</h4>
                        </div>

                        @foreach ($days as $i => $day)
                            <div x-show="selected === {{ $i }}" x-cloak class="mt-4">
                                @if (count($day['slots']) === 0)
                                    <p class="text-caption text-bg/80">Không có thời gian trống vào ngày này.</p>
                                @else
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($day['slots'] as $slot)
                                            <button type="button"
                                                    @click="chooseSlot('{{ $day['dateStr'] }}', '{{ $slot['time'] }}', '{{ $slot['label'] }}')"
                                                    :class="selectedSlot && selectedSlot.date === '{{ $day['dateStr'] }}' && selectedSlot.time === '{{ $slot['time'] }}' ? 'border-gold bg-gold/15 text-gold' : 'border-bg/30 text-bg hover:border-gold hover:text-gold'"
                                                    class="rounded-xl border px-3 py-3 text-center text-caption transition-colors">
                                                {{ $slot['label'] }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="mt-auto pt-8">
                            <button type="button"
                                    @click="confirmBooking()"
                                    :disabled="!selectedSlot"
                                    :class="selectedSlot ? 'bg-gold text-accent hover:opacity-90 cursor-pointer' : 'bg-bg/10 text-bg/40 cursor-not-allowed'"
                                    class="w-full rounded-full px-6 py-3 text-caption font-semibold transition-opacity">
                                <span x-text="selectedSlot ? `Đặt lịch lúc ${selectedSlot.label}` : 'Đặt lịch ngay'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
            @endunless
        </div>
    </section>
@endsection

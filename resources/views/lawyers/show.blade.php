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
            'abbrev'  => strtoupper($date->format('D')),
            'dayNum'  => $date->day,
            'dateStr' => $date->toDateString(),
            'slots'   => $slotList,
        ];
    }
@endphp

@section('content')
    <section class="container-page py-20">
        {{-- Breadcrumb --}}
        <nav class="text-caption">
            <a href="/" class="transition-colors hover:text-text/60">Trang chủ</a>
            <span class="px-1">/</span>
            <a href="/lawyers" class="transition-colors hover:text-text/60">Luật sư</a>
            <span class="px-1">/</span>
            <span class="text-text">{{ $lawyer['name'] }}</span>
        </nav>

        <div class="mt-10 grid gap-16 lg:grid-cols-3">
            <div class="min-w-0 lg:col-span-2">
                {{-- Portrait --}}
                <div class="overflow-hidden rounded-2xl">
                    <x-responsive-img :src="$lawyer['portrait_url']"
                                      :alt="$lawyer['name']"
                                      loading="eager"
                                      sizes="(min-width: 1024px) 600px, 100vw"
                                      :widths="[600, 900, 1200]"
                                      class="aspect-[4/5] max-h-[560px] w-full object-cover object-top" />
                </div>

                {{-- Identity --}}
                <h1 class="text-cta-h2 mt-10">
                    {{ $lawyer['name'] }}
                </h1>

                <p class="text-body mt-2">
                    Luật sư
                    @if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }} @endif
                    · {{ $lawyer['years_of_experience'] }} năm kinh nghiệm
                </p>

                <div class="mt-3">
                    <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" compact />
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($lawyer['specialty_tags'] as $tag)
                        <span class="text-status-pill inline-flex items-center rounded-full border border-text/30 px-3 py-1">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>

                {{-- Bio --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Giới thiệu</h2>
                    <div class="text-body mt-4 space-y-4">
                        @foreach ($lawyer['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Education --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Học vấn</h2>
                    <ul class="mt-6 space-y-6 border-l border-text/20 pl-6">
                        @foreach (collect($lawyer['education'])->sortByDesc('year') as $edu)
                            <li>
                                <p class="text-eyebrow text-text/70">{{ $edu['year'] }}</p>
                                <p class="mt-1 text-body font-medium">{{ $edu['degree'] }}</p>
                                <p class="text-caption text-text/70">{{ $edu['institution'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if (!empty($lawyer['work_experience']))
                    <div class="mt-12">
                        <h2 class="text-card-h3">Kinh nghiệm</h2>
                        <ul class="mt-6 space-y-6 border-l border-text/20 pl-6">
                            @foreach ($lawyer['work_experience'] as $job)
                                <li>
                                    <p class="text-eyebrow text-text/70">{{ $job['period'] }}</p>
                                    <p class="mt-1 text-body font-medium">{{ $job['title'] }}</p>
                                    <p class="text-caption text-text/70">{{ $job['firm'] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (!empty($lawyer['associations']))
                    <div class="mt-12">
                        <h2 class="text-card-h3">Hiệp hội nghề nghiệp</h2>
                        <ul class="mt-6 space-y-6 border-l border-text/20 pl-6">
                            @foreach ($lawyer['associations'] as $assoc)
                                <li>
                                    <p class="text-eyebrow text-text/70">{{ $assoc['period'] }}</p>
                                    <p class="mt-1 text-body font-medium">{{ $assoc['organization'] }}</p>
                                    <p class="text-caption text-text/70">{{ $assoc['role'] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (!empty($lawyer['notable_cases']))
                    <div class="mt-12">
                        <h2 class="text-card-h3">Vụ án tiêu biểu</h2>
                        <ul class="mt-6 space-y-4">
                            @foreach ($lawyer['notable_cases'] as $case)
                                <li>
                                    <p class="text-body font-medium italic">{{ $case['name'] }}</p>
                                    <p class="text-caption text-text/70">{{ $case['outcome'] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Reviews --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Đánh giá của khách hàng</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($lawyer['reviews'] as $review)
                            @php
                                $initial = mb_strtoupper(mb_substr($review['author'], 0, 1));
                                $reviewDate = Carbon::parse($review['date'])->format('d/m/Y');
                            @endphp
                            <article class="card-base">
                                <header class="flex items-start gap-4">
                                    <div class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-text/10 text-card-h5 text-text">
                                        {{ $initial }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-baseline justify-between gap-4">
                                            <p class="text-body font-medium text-text">{{ $review['author'] }}</p>
                                            <p class="text-caption">{{ $reviewDate }}</p>
                                        </div>
                                        <div class="mt-1">
                                            <x-rating-stars :rating="$review['stars']" size="sm" />
                                        </div>
                                    </div>
                                </header>
                                <p class="text-body mt-4 text-text/90">{{ $review['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- Languages --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Ngôn ngữ</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['languages'] as $lang)
                            <span class="inline-flex items-center rounded-full border border-text/30 px-3 py-1 text-caption text-text">
                                {{ $lang }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Booking sidebar --}}
            <aside class="min-w-0 lg:col-span-1">
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
                            <p class="text-caption mt-2 text-bg/80">mỗi lần tư vấn</p>
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
                            <h4 class="text-eyebrow text-gold">Thời gian có sẵn</h4>
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
                                <span x-text="selectedSlot ? `Đặt lịch lúc ${selectedSlot.label}` : 'Chọn thời gian để đặt lịch'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

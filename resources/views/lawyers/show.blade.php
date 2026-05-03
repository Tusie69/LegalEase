@extends('layouts.app', ['title' => 'Hồ sơ luật sư · LegalEase'])

@php
    use Carbon\Carbon;

    $profileOverrides = [
        'nguyen-minh-anh' => [
            'name' => 'Nguyễn Minh Anh',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '12 Lý Thường Kiệt, Hoàn Kiếm'],
            'specialty_tags' => ['Luật Hôn nhân & Gia đình', 'Tố tụng dân sự'],
            'bio' => [
                'Luật sư Nguyễn Minh Anh có hơn 12 năm kinh nghiệm trong lĩnh vực hôn nhân và gia đình, tập trung vào ly hôn, quyền nuôi con và tranh chấp tài sản.',
                'Phong cách làm việc của chị là rõ ràng, đồng cảm và thực tế, giúp khách hàng nắm rõ từng bước pháp lý để đưa ra quyết định đúng đắn.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Cử nhân Luật', 'year' => 2011],
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2014],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'tran-van-hung' => [
            'name' => 'Trần Văn Hùng',
            'bar_association' => 'Đoàn Luật sư TP.HCM',
            'address' => ['province' => 'TP.HCM', 'street_address' => '45 Nguyễn Huệ, Quận 1'],
            'specialty_tags' => ['Luật Doanh nghiệp', 'Tố tụng dân sự'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'le-thi-huong' => [
            'name' => 'Lê Thị Hương',
            'bar_association' => 'Đoàn Luật sư Đà Nẵng',
            'address' => ['province' => 'Đà Nẵng', 'street_address' => '88 Bạch Đằng, Hải Châu'],
            'specialty_tags' => ['Bất động sản', 'Luật Doanh nghiệp'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'pham-quoc-bao' => [
            'name' => 'Phạm Quốc Bảo',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '27 Trần Phú, Ba Đình'],
            'specialty_tags' => ['Bào chữa hình sự'],
            'languages' => ['Tiếng Việt'],
        ],
        'hoang-thu-trang' => [
            'name' => 'Hoàng Thu Trang',
            'bar_association' => 'Đoàn Luật sư TP.HCM',
            'address' => ['province' => 'TP.HCM', 'street_address' => '234 Pasteur, Quận 3'],
            'specialty_tags' => ['Luật Lao động'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'vu-duc-minh' => [
            'name' => 'Vũ Đức Minh',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '8 Phạm Văn Đồng, Cầu Giấy'],
            'specialty_tags' => ['Tố tụng dân sự', 'Luật Doanh nghiệp'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'dang-thi-mai' => [
            'name' => 'Đặng Thị Mai',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '56 Thái Hà, Đống Đa'],
            'specialty_tags' => ['Luật Hôn nhân & Gia đình'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'bui-thanh-tung' => [
            'name' => 'Bùi Thanh Tùng',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '203 Hai Bà Trưng, Hoàn Kiếm'],
            'specialty_tags' => ['Luật Doanh nghiệp', 'Tố tụng dân sự'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'ngo-hai-yen' => [
            'name' => 'Ngô Hải Yến',
            'bar_association' => 'Đoàn Luật sư TP.HCM',
            'address' => ['province' => 'TP.HCM', 'street_address' => '112 Nguyễn Đình Chiểu, Quận 1'],
            'specialty_tags' => ['Bất động sản'],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
    ];

    if (isset($profileOverrides[$lawyer['slug']])) {
        $lawyer = array_replace_recursive($lawyer, $profileOverrides[$lawyer['slug']]);
    }

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
            <a href="/" class="transition-colors hover:text-accent">Trang chủ</a>
            <span class="px-1">/</span>
            <a href="/lawyers" class="transition-colors hover:text-accent">Luật sư</a>
            <span class="px-1">/</span>
            <span class="text-text">{{ $lawyer['name'] }}</span>
        </nav>

        <div class="mt-10 grid gap-16 md:grid-cols-3">
            <div class="md:col-span-2">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $lawyer['portrait_url'] }}"
                         alt="{{ $lawyer['name'] }}"
                         class="aspect-[4/5] max-h-[560px] w-full object-cover object-top">
                </div>

                <div class="mt-10 flex items-center gap-3">
                    <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
                        {{ $lawyer['name'] }}
                    </h1>
                </div>

                <p class="mt-2 text-[15px] text-muted">
                    Luật sư
                    @if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }} @endif
                    · {{ $lawyer['years_of_experience'] }} năm kinh nghiệm
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

                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Giới thiệu</h2>
                    <div class="mt-4 space-y-4 text-[16px] leading-relaxed text-secondary">
                        @foreach ($lawyer['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Học vấn</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach ($lawyer['education'] as $edu)
                            <li class="flex items-baseline justify-between gap-6 border-b border-text/10 pb-3">
                                <div>
                                    <p class="text-[15px] text-text">{{ $edu['degree'] }}</p>
                                    <p class="text-[14px] text-muted">{{ $edu['institution'] }}</p>
                                </div>
                                <span class="text-[14px] text-muted">{{ $edu['year'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Ngôn ngữ</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['languages'] as $lang)
                            <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[13px] text-text">
                                {{ $lang }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Đánh giá của khách hàng</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($lawyer['reviews'] as $review)
                            @php
                                $initial = mb_strtoupper(mb_substr($review['author'], 0, 1));
                                $reviewDate = Carbon::parse($review['date'])->format('d/m/Y');
                            @endphp
                            <article class="rounded-2xl border border-text/10 bg-surface p-6">
                                <header class="flex items-start gap-4">
                                    <div class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-avatar font-display text-[18px] font-medium text-text">
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
                            window.location.href = "{{ route('book.start') }}?" + params.toString();
                        }
                    }'>
                    <div class="flex min-h-[560px] flex-col rounded-2xl border border-text/10 bg-surface p-8">
                        <h3 class="font-display text-[24px] font-medium tracking-tight">Đặt lịch tư vấn</h3>

                        <div class="mt-4">
                            <p class="font-display text-[32px] font-medium leading-none tracking-tight text-accent">
                                {{ number_format($lawyer['price_per_hour']) }} VND
                            </p>
                            <p class="mt-2 text-[13px] text-muted">mỗi lần tư vấn</p>
                        </div>

                        @if (!empty($lawyer['address']['street_address']))
                            <div class="mt-5 flex items-start gap-2 text-[13px]">
                                <svg class="mt-[2px] h-4 w-4 flex-none text-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="text-secondary">
                                    {{ $lawyer['address']['street_address'] }}, {{ $lawyer['address']['province'] }}
                                </span>
                            </div>
                        @endif

                        <div class="my-6 h-px bg-text/10"></div>

                        <div class="flex gap-1.5 overflow-hidden pb-1">
                            @foreach ($days as $i => $day)
                                <button type="button"
                                        @click="selected = {{ $i }}"
                                        :class="selected === {{ $i }} ? 'bg-text text-bg border-text' : 'border-muted/60 text-text hover:border-accent'"
                                        class="flex min-w-0 flex-1 flex-col items-center rounded-xl border px-1 py-2 transition-colors">
                                    <span class="text-[10px] font-medium uppercase tracking-[0.04em]"
                                          :class="selected === {{ $i }} ? 'text-bg/60' : 'text-muted'">
                                        {{ $day['abbrev'] }}
                                    </span>
                                    <span class="mt-0.5 font-display text-[18px] font-medium leading-none">
                                        {{ $day['dayNum'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <h4 class="text-[13px] font-medium uppercase tracking-[0.1em] text-muted">Thời gian có sẵn</h4>
                        </div>

                        @foreach ($days as $i => $day)
                            <div x-show="selected === {{ $i }}" x-cloak class="mt-4">
                                @if (count($day['slots']) === 0)
                                    <p class="text-[13px] text-muted">Không có thời gian trống vào ngày này.</p>
                                @else
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($day['slots'] as $slot)
                                            <button type="button"
                                                    @click="pickSlot('{{ $day['dateStr'] }}', '{{ $slot['time'] }}', '{{ $slot['label'] }}')"
                                                    class="rounded-xl border border-muted/60 px-3 py-3 text-center text-[13px] text-text transition-colors hover:border-accent hover:bg-accent/10">
                                                {{ $slot['label'] }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

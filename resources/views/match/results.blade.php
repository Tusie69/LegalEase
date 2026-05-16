@extends('layouts.app', ['title' => 'Luật sư phù hợp cho bạn · LegalEase'])

@php
    $intake = session('match', []);
    $specialty = $intake['specialty'] ?? null;
    $location  = $intake['location']  ?? '__any__';
    $language  = $intake['language']  ?? [];
    $priority  = $intake['priority']  ?? 'rating';

    $hcmAliases = ['TP. Hồ Chí Minh', 'TP.HCM'];

    $matchesSpecialty = function ($l) use ($specialty) {
        if (!$specialty) return true;
        return ($l['primary_specialty'] ?? null) === $specialty
            || in_array($specialty, $l['specialty_tags'] ?? [], true);
    };
    $matchesLocation = function ($l) use ($location, $hcmAliases) {
        if (!$location || $location === '__any__') return true;
        $prov = $l['address']['province'] ?? '';
        $wanted = in_array($location, $hcmAliases, true) ? $hcmAliases : [$location];
        return in_array($prov, $wanted, true);
    };
    $matchesLanguage = function ($l) use ($language) {
        if (empty($language)) return true;
        $spoken = $l['languages'] ?? [];
        foreach ($language as $lang) {
            if (in_array($lang, $spoken, true)) return true;
        }
        return false;
    };

    $pool = collect(\App\Data\Lawyers::all())->filter($matchesSpecialty);
    $strict = $pool->filter($matchesLocation)->filter($matchesLanguage);
    $relaxed = $strict->isEmpty();
    $matches = $relaxed ? $pool : $strict;

    $availabilityScore = function ($l) {
        $sum = 0;
        foreach ($l['availability'] ?? [] as $d) {
            $sum += count($d['slots'] ?? []);
        }
        return $sum;
    };
    if ($priority === 'experience') {
        $matches = $matches->sortByDesc('years_of_experience');
    } elseif ($priority === 'price') {
        $matches = $matches->sortBy('price_per_hour');
    } elseif ($priority === 'availability') {
        $matches = $matches->sortByDesc($availabilityScore);
    } else {
        $matches = $matches->sortByDesc('rating');
    }
    $matches = $matches->values();

    $priorityLabels = [
        'experience'   => 'Kinh nghiệm dày dạn',
        'rating'       => 'Đánh giá cao',
        'price'        => 'Giá hợp lý',
        'availability' => 'Sẵn sàng tư vấn sớm',
    ];

    // Build display objects with match% + "why" reasons for the spotlight + side rail
    $ranked = $matches->map(function ($l, $i) use ($specialty, $location, $language, $hcmAliases, $matchesSpecialty, $matchesLocation, $matchesLanguage, $priority, $priorityLabels) {
        $specOk = $matchesSpecialty($l);
        $locOk  = $matchesLocation($l);
        $langOk = $matchesLanguage($l);

        $why = [];
        if ($specOk && $specialty) {
            $why[] = [
                'title'  => 'Chuyên ngành đúng nhu cầu',
                'detail' => ($l['primary_specialty'] ?? '') . ' · ' . ($l['years_of_experience'] ?? 0) . ' năm hành nghề',
            ];
        }
        if ($locOk && $location && $location !== '__any__') {
            $why[] = [
                'title'  => 'Hành nghề tại ' . ($l['address']['province'] ?? ''),
                'detail' => 'Có thể gặp trực tiếp tại địa phương bạn chọn',
            ];
        }
        if ($langOk && !empty($language)) {
            $matched = array_values(array_intersect($language, $l['languages'] ?? []));
            $why[] = [
                'title'  => 'Tư vấn được bằng ' . implode(', ', $matched),
                'detail' => 'Phù hợp ngôn ngữ bạn chọn',
            ];
        }
        if (empty($why)) {
            $why[] = [
                'title'  => 'Đánh giá cao từ khách hàng',
                'detail' => ($l['rating'] ?? 0) . ' / 5 · ' . ($l['review_count'] ?? 0) . ' đánh giá',
            ];
        }

        // Deterministic match% based on position: 95, 91, 87, ... floor 60.
        $pct = max(60, 95 - $i * 4);

        return [
            'slug'              => $l['slug'],
            'name'              => $l['name'],
            'photo'             => $l['portrait_url'],
            'primary_specialty' => $l['primary_specialty'] ?? '',
            'province'          => $l['address']['province'] ?? '',
            'years'             => ($l['years_of_experience'] ?? 0) . ' năm',
            'rating'            => $l['rating'] ?? 0,
            'review_count'      => $l['review_count'] ?? 0,
            'price_per_hour'    => $l['price_per_hour'] ?? 0,
            'pct'               => $pct,
            'why'               => $why,
        ];
    })->values()->all();

    // Persist the count so /lawyers/<slug> can show "X luật sư đã chọn lọc theo nhu cầu của bạn"
    session(['match.count' => count($ranked)]);
@endphp

@section('content')
<section class="container-page pt-24 pb-12 md:pt-32">
    <a href="{{ route('match.specialty') }}"
       class="text-link-action inline-flex items-center gap-2 text-text/60 transition-colors hover:text-text">
        <span aria-hidden="true">←</span>
        <span>Đổi câu trả lời</span>
    </a>

    <div class="mt-12 max-w-[760px]">
        <p class="text-eyebrow text-accent">Kết quả tìm kiếm</p>
        <h1 class="text-page-h1 mt-4">
            @if ($matches->isEmpty())
                Chưa tìm được luật sư phù hợp.
            @else
                Luật sư phù hợp nhất với bạn.
            @endif
        </h1>
        @if ($matches->isNotEmpty())
            <p class="text-body-prose mt-6 text-text/70">
                Chúng tôi đã chọn dựa trên ưu tiên của bạn. Xem các lựa chọn khác bên phải, hoặc bấm "Hiển thị luật sư khác".
            </p>
        @endif

        <div class="mt-8 flex flex-wrap gap-2">
            @if ($specialty)
                <span class="text-form-hint inline-flex items-center gap-2 rounded-full border border-text/20 px-4 py-2 text-text/70">
                    <span class="text-text/50">Lĩnh vực:</span>
                    <span class="font-medium text-text">{{ $specialty }}</span>
                </span>
            @endif
            @if ($location && $location !== '__any__')
                <span class="text-form-hint inline-flex items-center gap-2 rounded-full border border-text/20 px-4 py-2 text-text/70">
                    <span class="text-text/50">Địa điểm:</span>
                    <span class="font-medium text-text">{{ $location }}</span>
                </span>
            @endif
            @if (!empty($language))
                <span class="text-form-hint inline-flex items-center gap-2 rounded-full border border-text/20 px-4 py-2 text-text/70">
                    <span class="text-text/50">Ngôn ngữ:</span>
                    <span class="font-medium text-text">{{ implode(', ', $language) }}</span>
                </span>
            @endif
            <span class="text-form-hint inline-flex items-center gap-2 rounded-full border border-text/20 px-4 py-2 text-text/70">
                <span class="text-text/50">Ưu tiên:</span>
                <span class="font-medium text-text">{{ $priorityLabels[$priority] ?? '' }}</span>
            </span>
        </div>
    </div>
</section>

@if ($matches->isEmpty())
    <section class="container-page pb-24 md:pb-32">
        <div class="card-base-lg mx-auto mt-12 max-w-[560px] text-center">
            <h2 class="text-card-h3">Không tìm thấy kết quả khớp.</h2>
            <p class="text-body-prose mt-4 text-text/70">
                Hãy thử thay đổi câu trả lời hoặc tìm toàn bộ danh sách.
            </p>
            <div class="mt-8 flex flex-col items-center gap-3 sm:flex-row sm:justify-center">
                <x-button variant="primary" :href="route('lawyers.index')">Tìm tất cả luật sư →</x-button>
                <x-button variant="ghost" :href="route('match.specialty')">Bắt đầu lại</x-button>
            </div>
        </div>
    </section>
@else
    <section x-data="matchResults({{ json_encode($ranked) }})"
             class="container-page pb-24 md:pb-32">
        <div class="grid gap-8 lg:grid-cols-[1.4fr_1fr] lg:items-start lg:gap-10">
            {{-- LEFT: Spotlight card --}}
            <article class="overflow-hidden rounded-2xl border border-text/15 bg-bg">
                <div class="relative aspect-[4/3] overflow-hidden bg-text/5">
                    <img :src="current.photo" :alt="current.name"
                         class="absolute inset-0 h-full w-full object-cover object-top">

                    {{-- Top-left: name + verified --}}
                    <div class="absolute left-5 top-5 inline-flex items-center gap-2 rounded-2xl border border-text/10 bg-bg/95 px-4 py-2 backdrop-blur">
                        <p class="text-card-h5 text-text" x-text="current.name"></p>
                        <span class="text-form-hint inline-flex items-center gap-1 rounded-full bg-accent/10 px-2 py-0.5 font-medium text-accent">
                            <x-icon name="check" :size="12" class="stroke-[3]" />
                            Xác minh
                        </span>
                    </div>

                    {{-- Top-right: match % --}}
                    <div class="absolute right-5 top-5 rounded-2xl bg-accent px-4 py-2 text-right text-bg">
                        <p class="text-card-h4 tabular-nums text-bg"><span x-text="current.pct"></span>%</p>
                        <p class="text-form-hint mt-0.5 uppercase tracking-wider text-bg/75">Phù hợp</p>
                    </div>

                    {{-- Bottom: criterion-match chips --}}
                    <div class="absolute bottom-5 left-5 right-5 flex flex-wrap gap-2">
                        <span class="text-form-hint inline-flex items-center gap-1.5 rounded-full border border-text/10 bg-bg/95 px-3 py-1 font-medium text-text backdrop-blur">
                            <x-icon name="check" :size="12" class="stroke-[3] text-accent" />
                            <span x-text="current.primary_specialty"></span>
                        </span>
                        <span class="text-form-hint inline-flex items-center gap-1.5 rounded-full border border-text/10 bg-bg/95 px-3 py-1 font-medium text-text backdrop-blur">
                            <x-icon name="check" :size="12" class="stroke-[3] text-accent" />
                            <span x-text="current.province"></span>
                        </span>
                        <span class="text-form-hint inline-flex items-center gap-1.5 rounded-full border border-text/10 bg-bg/95 px-3 py-1 font-medium text-text backdrop-blur">
                            <svg class="h-3 w-3 fill-gold-bright text-gold-bright" viewBox="0 0 24 24">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            <span x-text="current.rating"></span>
                        </span>
                    </div>
                </div>

                <div class="p-6 lg:p-8">
                    {{-- Stat tiles --}}
                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-xl bg-text/5 px-4 py-3">
                            <p class="text-card-h4 tabular-nums text-accent" x-text="current.years"></p>
                            <p class="text-form-hint mt-1 text-text/60">Kinh nghiệm hành nghề</p>
                        </div>
                        <div class="rounded-xl bg-text/5 px-4 py-3">
                            <p class="text-card-h4 tabular-nums inline-flex items-center gap-1 text-accent">
                                <span x-text="current.rating"></span>
                                <svg class="h-4 w-4 fill-gold-bright text-gold-bright" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            </p>
                            <p class="text-form-hint mt-1 text-text/60"><span x-text="current.review_count"></span> đánh giá</p>
                        </div>
                        <div class="rounded-xl bg-text/5 px-4 py-3">
                            <p class="text-card-h4 tabular-nums text-accent">
                                <span x-text="formatFullPrice(current.price_per_hour)"></span>
                                <span class="text-form-hint font-medium">VND</span>
                            </p>
                            <p class="text-form-hint mt-1 text-text/60">/ giờ tư vấn</p>
                        </div>
                    </div>

                    {{-- Why this lawyer --}}
                    <div class="mt-6 border-t border-text/15 pt-6">
                        <h3 class="text-card-h4">Vì sao luật sư này phù hợp với bạn</h3>
                        <ul class="mt-4 space-y-3">
                            <template x-for="reason in current.why" :key="reason.title">
                                <li class="flex items-start gap-3">
                                    <span class="inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-accent/10 text-accent">
                                        <x-icon name="check" :size="12" class="stroke-[3]" />
                                    </span>
                                    <p class="text-body">
                                        <span class="font-medium text-text" x-text="reason.title"></span>
                                        <span class="text-text/60" x-text="' · ' + reason.detail"></span>
                                    </p>
                                </li>
                            </template>
                        </ul>

                        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                            <a :href="`/lawyers/${current.slug}`"
                               class="inline-flex flex-1 items-center justify-center rounded-full bg-accent px-6 py-3 text-caption font-semibold text-bg transition-opacity hover:opacity-90">
                                Đặt lịch tư vấn →
                            </a>
                            <a :href="`/lawyers/${current.slug}`"
                               class="inline-flex items-center justify-center rounded-full border border-text/20 bg-bg px-6 py-3 text-caption font-medium text-text transition-colors hover:border-accent">
                                Xem hồ sơ
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            {{-- RIGHT: side rail --}}
            <aside class="flex flex-col gap-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-text/15 bg-bg p-5">
                    <p class="text-eyebrow text-text/60">Lựa chọn khác cho bạn</p>
                    <div class="mt-4 divide-y divide-text/15" x-show="alternatives.length > 0">
                        <template x-for="alt in alternatives" :key="alt.slug">
                            <button type="button"
                                    @click="currentIdx = lawyers.findIndex(l => l.slug === alt.slug)"
                                    class="group flex w-full items-center gap-3 py-3 text-left transition-opacity first:pt-0 last:pb-0 hover:opacity-70">
                                <div class="h-10 w-10 flex-none overflow-hidden rounded-full border border-text/15 bg-text/5">
                                    <img :src="alt.photo" :alt="alt.name" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-caption truncate font-medium text-text" x-text="alt.name"></p>
                                    <p class="text-form-hint truncate text-text/60" x-text="alt.primary_specialty + ' · ' + alt.province"></p>
                                    <div class="mt-1.5 h-1 overflow-hidden rounded-full bg-text/10">
                                        <div class="h-full rounded-full bg-accent transition-all duration-300" :style="`width: ${alt.pct}%`"></div>
                                    </div>
                                </div>
                                <p class="text-caption tabular-nums font-medium text-accent"><span x-text="alt.pct"></span>%</p>
                            </button>
                        </template>
                    </div>
                    <p x-show="alternatives.length === 0" x-cloak
                       class="text-body-dense mt-3 text-text/60">
                        Đây là luật sư phù hợp duy nhất với tiêu chí của bạn.
                    </p>
                </div>

                <div class="rounded-2xl bg-text/5 p-5">
                    <p class="text-eyebrow text-text/60">Mẹo nhỏ</p>
                    <p class="text-body-dense mt-2 text-text/70">
                        Bấm vào một luật sư bên trên để xem chi tiết. Mọi luật sư đều đã được xác minh hồ sơ hành nghề.
                    </p>
                </div>
            </aside>
        </div>

        {{-- Pagination --}}
        @if (count($ranked) > 1)
            <div class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-text/15 pt-8">
                <div class="flex gap-2" aria-hidden="true">
                    <template x-for="(_, i) in lawyers" :key="i">
                        <span :class="i === currentIdx ? 'w-10 bg-accent' : 'w-5 bg-text/15'"
                              class="h-1 rounded-full transition-all duration-300"></span>
                    </template>
                </div>
                <p class="text-caption text-text/60">
                    <span class="font-medium text-text tabular-nums" x-text="currentIdx + 1"></span>
                    <span> / </span>
                    <span class="tabular-nums" x-text="lawyers.length"></span>
                    <span> luật sư phù hợp</span>
                </p>
                <button type="button"
                        @click="currentIdx = (currentIdx + 1) % lawyers.length"
                        class="text-link-action inline-flex items-center gap-2 text-caption font-medium text-text transition-colors hover:text-accent">
                    Hiển thị luật sư khác →
                </button>
            </div>
        @endif

        <script>
            function matchResults(initialLawyers) {
                return {
                    lawyers: initialLawyers,
                    currentIdx: 0,
                    get current() { return this.lawyers[this.currentIdx]; },
                    get alternatives() { return this.lawyers.filter((_, i) => i !== this.currentIdx); },
                    formatFullPrice(p) {
                        return Number(p).toLocaleString('en-US');
                    },
                };
            }
        </script>
    </section>

    {{-- Slide-over: lawyer profile iframe with breadcrumb + open-full-page + close --}}
    <div x-data="profileSlideover()" x-init="init()"
         @keydown.escape.window="close()">
        {{-- Backdrop --}}
        <div x-show="open" x-cloak
             x-transition.opacity.duration.250ms
             @click="close()"
             class="fixed inset-0 z-[9998] bg-accent/45"
             aria-hidden="true"></div>

        {{-- Panel --}}
        <aside x-show="open" x-cloak
               x-transition:enter="transition-transform duration-300 ease-out"
               x-transition:enter-start="translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition-transform duration-200 ease-in"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="translate-x-full"
               role="dialog" aria-modal="true" aria-label="Hồ sơ luật sư"
               class="fixed right-0 top-0 z-[9999] flex h-screen w-[min(960px,92vw)] flex-col border-l border-text/10 bg-bg">
            {{-- Top bar --}}
            <div class="flex flex-shrink-0 items-center justify-between gap-4 border-b border-text/10 bg-bg px-5 py-3">
                <div class="text-caption flex items-center gap-2 font-medium text-text">
                    <span aria-hidden="true" class="inline-block h-1.5 w-1.5 rounded-full bg-accent"></span>
                    <span>Kết quả phù hợp</span>
                    <span class="text-text/40">›</span>
                    <span x-text="currentName">Hồ sơ</span>
                </div>
                <div class="flex items-center gap-2">
                    <a :href="currentHref" target="_blank" rel="noopener"
                       class="text-form-hint inline-flex items-center gap-2 rounded-full border border-text/15 bg-bg px-3 py-2 font-medium text-text transition-colors hover:bg-text/5">
                        Mở trang đầy đủ ↗
                    </a>
                    <button type="button" @click="close()" aria-label="Đóng"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-text/15 bg-bg text-text transition-colors hover:bg-text/5">
                        <x-icon name="x" :size="16" />
                    </button>
                </div>
            </div>
            {{-- Body --}}
            <div class="relative flex-1 overflow-hidden bg-text/5">
                <p x-show="loading" x-cloak class="text-caption absolute inset-0 flex items-center justify-center text-text/70">
                    Đang tải hồ sơ…
                </p>
                <iframe :src="iframeSrc" @load="loading = false"
                        title="Hồ sơ luật sư"
                        class="h-full w-full border-0 bg-bg"></iframe>
            </div>
        </aside>
    </div>

    <script>
        function profileSlideover() {
            return {
                open: false,
                loading: true,
                currentName: 'Hồ sơ',
                currentHref: '#',
                iframeSrc: '',
                returnUrl: window.location.pathname + window.location.search.replace(/[?&]lawyer=[^&]*/, ''),

                init() {
                    // Intercept clicks on any /lawyers/<slug> link in the results page
                    document.addEventListener('click', e => {
                        const a = e.target.closest('a[href^="/lawyers/"]');
                        if (!a) return;
                        if (a.getAttribute('href') === '/lawyers' || a.getAttribute('href') === '/lawyers/') return;
                        if (e.metaKey || e.ctrlKey || e.shiftKey || e.button === 1) return;
                        if (a.target === '_blank') return;
                        e.preventDefault();
                        const href = a.getAttribute('href');
                        const card = a.closest('article, aside, [data-lawyer-card]');
                        const name = card?.querySelector('h1, h2, h3, [class*="text-card-h"], [class*="text-page-h"]')?.textContent.trim()
                                  || a.textContent.trim()
                                  || 'Hồ sơ';
                        this.openSlideover(href, name);
                    });

                    // Browser back: close slide-over instead of leaving the page
                    window.addEventListener('popstate', e => {
                        if (!e.state || !e.state.slideover) {
                            if (this.open) this.closeSilently();
                        }
                    });

                    // Auto-open if landing URL has ?lawyer=<slug>
                    const slug = new URLSearchParams(window.location.search).get('lawyer');
                    if (slug) this.openSlideover('/lawyers/' + slug, '');
                },

                openSlideover(href, name) {
                    this.currentHref = href;
                    this.currentName = name || 'Hồ sơ';
                    this.iframeSrc = href + (href.includes('?') ? '&' : '?') + 'embed=1';
                    this.loading = true;
                    this.open = true;
                    document.body.style.overflow = 'hidden';
                    const slug = href.split('/lawyers/')[1].split('?')[0];
                    window.history.pushState({ slideover: true, slug }, '', window.location.pathname + '?lawyer=' + slug);
                },

                close() {
                    this.closeSilently();
                    if (window.location.search.includes('lawyer=')) {
                        window.history.pushState({}, '', this.returnUrl);
                    }
                },

                closeSilently() {
                    this.open = false;
                    document.body.style.overflow = '';
                    setTimeout(() => {
                        this.iframeSrc = '';
                        this.currentName = 'Hồ sơ';
                        this.currentHref = '#';
                    }, 250);
                },
            };
        }
    </script>
@endif
@endsection

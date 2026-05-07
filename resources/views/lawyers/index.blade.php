@extends('layouts.app', ['title' => 'Luật sư · LegalEase'])

@php
    $allLawyers = \App\Data\Lawyers::all();

    $specialties = ['Luật Hôn nhân & Gia đình', 'Luật Doanh nghiệp', 'Bất động sản', 'Bào chữa hình sự', 'Luật Lao động', 'Tố tụng dân sự'];
    $locations = ['Hà Nội', 'TP.HCM', 'Đà Nẵng'];
    $languages = ['Tiếng Việt', 'Tiếng Anh'];

    $lawyersForFilter = array_map(fn ($l) => [
        'specialty_tags' => array_map(function($tag) {
            return match($tag) {
                'Family Law' => 'Luật Hôn nhân & Gia đình',
                'Business Law' => 'Luật Doanh nghiệp',
                'Real Estate' => 'Bất động sản',
                'Criminal Defense' => 'Bào chữa hình sự',
                'Labor Law' => 'Luật Lao động',
                'Civil Litigation' => 'Tố tụng dân sự',
                default => $tag,
            };
        }, $l['specialty_tags']),
        'price_per_hour' => $l['price_per_hour'],
        'languages' => array_map(function($lang) {
            return match($lang) {
                'Vietnamese' => 'Tiếng Việt',
                'English' => 'Tiếng Anh',
                default => $lang,
            };
        }, $l['languages']),
        'province' => match ($l['address']['province'] ?? null) {
            'Hanoi' => 'Hà Nội',
            'Ho Chi Minh City' => 'TP.HCM',
            'Da Nang' => 'Đà Nẵng',
            default => $l['address']['province'] ?? null,
        },
    ], $allLawyers);
@endphp

@section('content')
    <section class="container-page pb-24 pt-24"
             x-data="lawyerFilters({{ json_encode($lawyersForFilter) }})">
        {{-- Breadcrumb --}}
        <nav class="text-[14px]">
            <a href="/" class="transition-colors hover:text-accent">Trang chủ</a>
            <span class="px-1">/</span>
            <span class="text-text">Luật sư</span>
        </nav>

        <h1 class="mt-6 font-display text-[48px] font-medium leading-snug tracking-tight md:text-[56px]">Tìm luật sư của bạn</h1>
        <p class="text-body-prose mt-3">Duyệt qua hơn 500 luật sư đã được xác minh trên khắp Việt Nam.</p>

        <div class="mt-10 grid grid-cols-1 gap-12 lg:grid-cols-[240px_1fr]">
            {{-- Filter sidebar --}}
            <aside class="self-start lg:sticky lg:top-22">
                {{-- Mobile collapse toggle (below lg) --}}
                <button type="button"
                        @click="filterOpen = !filterOpen"
                        :aria-expanded="filterOpen"
                        class="flex w-full items-center justify-between rounded-2xl border border-text/20 px-6 py-5 text-text transition-colors hover:border-text/30 lg:hidden">
                    <span class="flex items-center gap-3">
                        <x-icon name="sliders" :size="20" />
                        <span class="font-display text-[20px] font-medium tracking-tight"
                              x-text="activeFilterCount > 0 ? `Bộ lọc (${activeFilterCount} đã chọn)` : 'Bộ lọc'"></span>
                    </span>
                    <svg class="h-5 w-5 flex-none transition-transform duration-200"
                         :class="filterOpen ? 'rotate-180' : ''"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>

                <div x-show="filterOpen" x-cloak class="card-base mt-4 lg:!mt-0 lg:!block">
                    {{-- h3 only visible at lg+ (below lg, the toggle button serves this role) --}}
                    <h3 class="hidden font-display text-[20px] font-medium tracking-tight lg:block">Bộ lọc</h3>

                    <div class="lg:mt-6">
                        <h4 class="text-eyebrow">Chuyên môn</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($specialties as $spec)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $spec }}" x-model="specialties" class="h-4 w-4 rounded border border-text/30 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $spec }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow">Địa điểm</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($locations as $loc)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $loc }}" x-model="locations" class="h-4 w-4 rounded border border-text/30 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $loc }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow">Khoảng giá</h4>
                        <input type="range"
                               min="500000" max="5000000" step="100000"
                               x-model.number="maxPrice"
                               :style="`--value: ${((maxPrice - 500000) / 4500000) * 100}%`"
                               class="price-slider mt-4 w-full cursor-pointer">
                        <p class="mt-2 text-[14px]">
                            500.000 đến <span x-text="Number(maxPrice).toLocaleString('vi-VN')"></span> VND
                        </p>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow">Ngôn ngữ</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($languages as $lang)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $lang }}" x-model="languages" class="h-4 w-4 rounded border border-text/30 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 border-t border-text/20 pt-4" x-show="hasActiveFilters" x-cloak>
                        <button type="button" @click="reset()" class="text-[14px] transition-colors hover:text-accent hover:underline underline-offset-4">
                            Xóa bộ lọc
                        </button>
                    </div>
                </div>
            </aside>

            {{-- Results --}}
            <div>
                {{-- Empty state --}}
                <div x-show="visibleCount === 0" x-cloak class="flex flex-col items-center justify-center rounded-2xl border border-text/20 px-8 py-20 text-center">
                    <h3 class="text-chapter-h2">Không có luật sư nào khớp với bộ lọc của bạn.</h3>
                    <p class="text-body mt-3 max-w-md">Thử điều chỉnh hoặc xóa một vài bộ lọc để xem thêm lựa chọn.</p>
                    <button type="button" @click="reset()" class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-text/70">
                        Xóa bộ lọc
                        <span aria-hidden="true">→</span>
                    </button>
                </div>

                <div x-show="visibleCount > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($allLawyers as $i => $lawyer)
                        <div x-show="matches(lawyersForFilter[{{ $i }}])" x-cloak>
                            <x-lawyer-card :lawyer="$lawyer" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        .price-slider {
            -webkit-appearance: none;
            appearance: none;
            height: 6px;
            border-radius: 9999px;
            background: linear-gradient(
                to right,
                var(--color-accent) 0%,
                var(--color-accent) var(--value, 100%),
                color-mix(in srgb, var(--color-text) 12%, transparent) var(--value, 100%),
                color-mix(in srgb, var(--color-text) 12%, transparent) 100%
            );
        }

        .price-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            background: var(--color-accent);
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
            transition: transform 0.15s ease;
        }

        .price-slider::-webkit-slider-thumb:hover {
            transform: scale(1.1);
        }

        .price-slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            background: var(--color-accent);
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
            transition: transform 0.15s ease;
        }

        .price-slider::-moz-range-thumb:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        function lawyerFilters(allLawyers) {
            return {
                lawyersForFilter: allLawyers,
                specialties: [],
                locations: [],
                languages: [],
                maxPrice: 5000000,
                filterOpen: false,

                get hasActiveFilters() {
                    return this.specialties.length > 0
                        || this.locations.length > 0
                        || this.languages.length > 0
                        || this.maxPrice < 5000000;
                },

                get activeFilterCount() {
                    return this.specialties.length
                        + this.locations.length
                        + this.languages.length
                        + (this.maxPrice < 5000000 ? 1 : 0);
                },

                get visibleCount() {
                    return this.lawyersForFilter.filter(lawyer => this.matches(lawyer)).length;
                },

                matches(lawyer) {
                    if (this.specialties.length > 0 && !lawyer.specialty_tags.some(s => this.specialties.includes(s))) return false;
                    if (this.locations.length > 0 && !this.locations.includes(lawyer.province)) return false;
                    if (this.languages.length > 0 && !lawyer.languages.some(l => this.languages.includes(l))) return false;
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

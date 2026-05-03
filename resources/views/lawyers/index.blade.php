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
    <section class="mx-auto max-w-[1280px] px-8 pb-24 pt-24"
             x-data="lawyerFilters({{ json_encode($lawyersForFilter) }})">
        <nav class="text-[14px] text-muted">
            <a href="/" class="transition-colors hover:text-accent">Trang chủ</a>
            <span class="px-1">/</span>
            <span class="text-text">Luật sư</span>
        </nav>

        <h1 class="mt-6 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">Tìm luật sư của bạn</h1>
        <p class="mt-3 text-[17px] text-secondary">Duyệt qua hơn 500 luật sư đã được xác minh trên khắp Việt Nam.</p>

        <div class="mt-10 grid grid-cols-1 gap-12 md:grid-cols-[240px_1fr]">
            <aside class="self-start md:sticky md:top-[88px]">
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[20px] font-medium tracking-tight">Bộ lọc</h3>

                    <div class="mt-6">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Chuyên môn</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($specialties as $spec)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $spec }}" x-model="specialties" class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $spec }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Địa điểm</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($locations as $loc)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $loc }}" x-model="locations" class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $loc }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Khoảng giá</h4>
                        <input type="range" min="500000" max="5000000" step="100000" x-model.number="maxPrice" class="mt-4 w-full h-2 rounded-lg appearance-none cursor-pointer bg-gray-200 accent-accent hover:bg-gray-300 transition-colors">
                        <p class="mt-2 text-[13px] text-muted">
                            500.000 đến <span x-text="Number(maxPrice).toLocaleString('vi-VN')"></span> VND
                        </p>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Ngôn ngữ</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($languages as $lang)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $lang }}" x-model="languages" class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 border-t border-text/10 pt-4" x-show="hasActiveFilters" x-cloak>
                        <button type="button" @click="reset()" class="text-[14px] text-muted transition-colors hover:text-accent hover:underline underline-offset-4">
                            Xóa bộ lọc
                        </button>
                    </div>
                </div>
            </aside>

            <div>
                <div x-show="visibleCount === 0" x-cloak class="flex flex-col items-center justify-center rounded-2xl border border-text/10 bg-surface px-8 py-20 text-center">
                    <h3 class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">Không có luật sư nào khớp với bộ lọc của bạn.</h3>
                    <p class="mt-3 max-w-md text-[15px] leading-relaxed text-secondary">Thử điều chỉnh hoặc xóa một vài bộ lọc để xem thêm lựa chọn.</p>
                    <button type="button" @click="reset()" class="mt-8 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                        Xóa bộ lọc
                        <span aria-hidden="true">→</span>
                    </button>
                </div>

                <div x-show="visibleCount > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
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
        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 20px;
            height: 20px;
            background: #3b82f6;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: all 0.2s ease;
        }
        
        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #3b82f6;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: all 0.2s ease;
        }
        
        input[type="range"]::-moz-range-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        input[type="range"] {
            background: linear-gradient(to right, #3b82f6 0%, #3b82f6 var(--value), #e5e7eb var(--value), #e5e7eb 100%);
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

                get hasActiveFilters() {
                    return this.specialties.length > 0
                        || this.locations.length > 0
                        || this.languages.length > 0
                        || this.maxPrice < 5000000;
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

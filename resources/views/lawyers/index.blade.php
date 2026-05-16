@extends('layouts.app', ['title' => 'Luật sư · LegalEase', 'navOverlay' => true])

@php
    use Carbon\Carbon;

    $allLawyers = \App\Data\Lawyers::all();

    $specialties = ['Luật Hôn nhân & Gia đình', 'Luật Doanh nghiệp', 'Bất động sản', 'Bào chữa hình sự', 'Luật Lao động', 'Tố tụng dân sự'];
    $locations = ['Hà Nội', 'TP.HCM', 'Đà Nẵng'];
    $languages = ['Tiếng Việt', 'Tiếng Anh'];

    $today = Carbon::today('Asia/Ho_Chi_Minh');

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
        'rating' => $l['rating'] ?? 0,
        'years_of_experience' => $l['years_of_experience'] ?? 0,
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
        'availability' => $l['availability'] ?? [],
    ], $allLawyers);
@endphp

@section('content')
    <section x-data="lawyerFilters({{ json_encode($lawyersForFilter) }}, {{ json_encode($specialties) }}, {{ json_encode($locations) }}, {{ json_encode($languages) }}, {{ $today->year }}, {{ $today->month - 1 }}, {{ $today->day }})">
    {{-- Navy hero band: full-bleed, bleeds under transparent nav. Contains breadcrumb + h1 + subtitle + filter pills. --}}
    <div class="-mt-18 bg-accent text-bg">
        <div class="container-page pt-32 pb-12">
        {{-- Breadcrumb --}}
        <nav class="text-caption">
            <a href="/" class="text-bg/70 transition-colors hover:text-bg">Trang chủ</a>
            <span class="px-1 text-bg/50">/</span>
            <span class="text-bg">Luật sư</span>
        </nav>

        <h1 class="text-page-h1 mt-6 text-bg">Tìm luật sư của riêng bạn</h1>
        <p class="text-body-prose mt-3 text-bg/80">Hơn 500 luật sư đã xác minh, sẵn sàng trên khắp Việt Nam.</p>

        {{-- Mobile filter trigger (<md) --}}
        <div class="mt-10 flex items-center justify-between md:hidden">
            <button type="button"
                    @click="openSheet()"
                    :class="hasActiveFilters ? 'border-bg bg-bg text-accent' : 'border-bg/40 text-bg'"
                    class="filter-pill">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="6" x2="20" y2="6"/><line x1="6" y1="12" x2="18" y2="12"/><line x1="9" y1="18" x2="15" y2="18"/>
                </svg>
                <span>Bộ lọc</span>
                <span x-show="activeFilterCount" x-cloak class="filter-pill-count" x-text="activeFilterCount"></span>
            </button>
            <button type="button"
                    @click="reset()"
                    x-show="hasActiveFilters"
                    x-cloak
                    class="text-caption text-bg/70 transition-colors hover:text-bg">
                Xóa bộ lọc
            </button>
        </div>

        {{-- Filter strip (md+): horizontal icon-stack tabs --}}
        <div class="mt-10 hidden items-stretch border-y border-bg/15 md:flex">
            {{-- Specialty --}}
            <div class="relative" @click.outside="if (openFilter === 'specialty') openFilter = null">
                <button type="button"
                        @click="toggleFilter('specialty')"
                        :aria-expanded="openFilter === 'specialty'"
                        :class="specialties.length || openFilter === 'specialty' ? 'opacity-100' : 'opacity-55 hover:opacity-100'"
                        class="relative flex h-full flex-col items-center gap-1.5 px-6 py-4 text-bg transition-opacity">
                    <x-icon name="scale" :size="22" />
                    <span class="text-caption font-medium">Chuyên môn</span>
                    <span class="text-form-hint text-bg/70" x-text="specialtyLabel"></span>
                    <span x-show="specialties.length || openFilter === 'specialty'" x-cloak
                          aria-hidden="true"
                          class="absolute inset-x-5 -bottom-px h-0.5 bg-bg"></span>
                </button>
                <div x-show="openFilter === 'specialty'" x-cloak class="filter-popover">
                    <input type="search"
                           x-model="specialtySearch"
                           placeholder="Tìm chuyên môn..."
                           aria-label="Tìm chuyên môn"
                           class="filter-search">
                    <div class="filter-list mt-3">
                        <template x-for="spec in filteredSpecialties" :key="spec">
                            <label class="flex items-center gap-3 text-caption text-text">
                                <input type="checkbox" :value="spec" x-model="specialties" class="custom-check">
                                <span x-text="spec"></span>
                            </label>
                        </template>
                        <p x-show="filteredSpecialties.length === 0" x-cloak class="text-caption text-text/60">
                            Không có kết quả phù hợp.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Location --}}
            <div class="relative" @click.outside="if (openFilter === 'location') openFilter = null">
                <button type="button"
                        @click="toggleFilter('location')"
                        :aria-expanded="openFilter === 'location'"
                        :class="locations.length || openFilter === 'location' ? 'opacity-100' : 'opacity-55 hover:opacity-100'"
                        class="relative flex h-full flex-col items-center gap-1.5 px-6 py-4 text-bg transition-opacity">
                    <x-icon name="map-pin" :size="22" />
                    <span class="text-caption font-medium">Địa điểm</span>
                    <span class="text-form-hint text-bg/70" x-text="locationLabel"></span>
                    <span x-show="locations.length || openFilter === 'location'" x-cloak
                          aria-hidden="true"
                          class="absolute inset-x-5 -bottom-px h-0.5 bg-bg"></span>
                </button>
                <div x-show="openFilter === 'location'" x-cloak class="filter-popover">
                    <input type="search"
                           x-model="locationSearch"
                           placeholder="Tìm địa điểm..."
                           aria-label="Tìm địa điểm"
                           class="filter-search">
                    <div class="filter-list mt-3">
                        <template x-for="loc in filteredLocations" :key="loc">
                            <label class="flex items-center gap-3 text-caption text-text">
                                <input type="checkbox" :value="loc" x-model="locations" class="custom-check">
                                <span x-text="loc"></span>
                            </label>
                        </template>
                        <p x-show="filteredLocations.length === 0" x-cloak class="text-caption text-text/60">
                            Không có kết quả phù hợp.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Time --}}
            <div class="relative" @click.outside="if (openFilter === 'time') openFilter = null">
                <button type="button"
                        @click="toggleFilter('time')"
                        :aria-expanded="openFilter === 'time'"
                        :class="timeFilterCount || openFilter === 'time' ? 'opacity-100' : 'opacity-55 hover:opacity-100'"
                        class="relative flex h-full flex-col items-center gap-1.5 px-6 py-4 text-bg transition-opacity">
                    <x-icon name="calendar" :size="22" />
                    <span class="text-caption font-medium">Thời gian</span>
                    <span class="text-form-hint text-bg/70" x-text="timeLabel"></span>
                    <span x-show="timeFilterCount || openFilter === 'time'" x-cloak
                          aria-hidden="true"
                          class="absolute inset-x-5 -bottom-px h-0.5 bg-bg"></span>
                </button>
                <div x-show="openFilter === 'time'" x-cloak class="filter-popover w-[320px]">
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <select x-model.number="viewMonth"
                                    class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                <template x-for="m in availableMonthsInView" :key="m">
                                    <option :value="m" x-text="monthNames[m]"></option>
                                </template>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                <x-icon name="chevron-down" :size="14" />
                            </span>
                        </div>
                        <div class="relative flex-1">
                            <select x-model.number="viewYear" @change="syncMonthToYear()"
                                    class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                <template x-for="y in availableYears" :key="y">
                                    <option :value="y" x-text="y"></option>
                                </template>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                <x-icon name="chevron-down" :size="14" />
                            </span>
                        </div>
                    </div>

                    <div class="mt-3 grid grid-cols-7 gap-0.5">
                        <template x-for="d in ['T2','T3','T4','T5','T6','T7','CN']" :key="d">
                            <span class="text-form-hint text-center font-medium uppercase tracking-wide text-text/50" x-text="d"></span>
                        </template>
                    </div>

                    <div class="mt-1 grid grid-cols-7 gap-0.5">
                        <template x-for="(cell, i) in calendarCells" :key="i">
                            <button type="button"
                                    :disabled="cell.day === null || cell.offset === null"
                                    @click="selectDay(cell.offset)"
                                    :class="
                                        cell.day === null ? 'invisible' :
                                        cell.offset === null ? 'text-text/25 cursor-not-allowed' :
                                        selectedDay === cell.offset ? 'bg-accent text-bg font-semibold' :
                                        cell.isToday ? 'text-accent ring-1 ring-accent/40 hover:bg-text/5' :
                                        'text-text hover:bg-text/5'
                                    "
                                    class="aspect-square rounded-md text-status-pill transition-colors"
                                    x-text="cell.day"></button>
                        </template>
                    </div>

                    <div x-show="selectedDay !== null" x-cloak class="mt-5">
                        <p class="text-eyebrow text-text/60">Giờ</p>
                        <template x-if="availableTimesForDay.length === 0">
                            <p class="mt-2 text-caption text-text/70">Không có luật sư nào trống vào ngày này.</p>
                        </template>
                        <div class="filter-list mt-2 grid grid-cols-3 gap-2">
                            <template x-for="slot in availableTimesForDay" :key="slot">
                                <button type="button"
                                        @click="selectedTime = (selectedTime === slot ? null : slot)"
                                        :class="selectedTime === slot ? 'border-accent bg-accent text-bg' : 'border-text/20 text-text hover:border-accent'"
                                        class="rounded-xl border px-2 py-1.5 text-center text-caption transition-colors"
                                        x-text="slot"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Price --}}
            <div class="relative" @click.outside="if (openFilter === 'price') openFilter = null">
                <button type="button"
                        @click="toggleFilter('price')"
                        :aria-expanded="openFilter === 'price'"
                        :class="maxPrice < 5000000 || openFilter === 'price' ? 'opacity-100' : 'opacity-55 hover:opacity-100'"
                        class="relative flex h-full flex-col items-center gap-1.5 px-6 py-4 text-bg transition-opacity">
                    <x-icon name="wallet" :size="22" />
                    <span class="text-caption font-medium">Khoảng giá</span>
                    <span class="text-form-hint text-bg/70" x-text="priceLabel"></span>
                    <span x-show="maxPrice < 5000000 || openFilter === 'price'" x-cloak
                          aria-hidden="true"
                          class="absolute inset-x-5 -bottom-px h-0.5 bg-bg"></span>
                </button>
                <div x-show="openFilter === 'price'" x-cloak class="filter-popover w-[280px]">
                    <p class="text-eyebrow text-text/60">Tối đa</p>
                    <input type="range"
                           min="500000" max="5000000" step="100000"
                           x-model.number="maxPrice"
                           :style="`--value: ${((maxPrice - 500000) / 4500000) * 100}%`"
                           class="price-slider mt-4 w-full cursor-pointer">
                    <p class="mt-3 text-caption text-text">
                        500.000 đến <span x-text="Number(maxPrice).toLocaleString('vi-VN')"></span> VND
                    </p>
                </div>
            </div>

            {{-- Language --}}
            <div class="relative" @click.outside="if (openFilter === 'language') openFilter = null">
                <button type="button"
                        @click="toggleFilter('language')"
                        :aria-expanded="openFilter === 'language'"
                        :class="languages.length || openFilter === 'language' ? 'opacity-100' : 'opacity-55 hover:opacity-100'"
                        class="relative flex h-full flex-col items-center gap-1.5 px-6 py-4 text-bg transition-opacity">
                    <x-icon name="globe" :size="22" />
                    <span class="text-caption font-medium">Ngôn ngữ</span>
                    <span class="text-form-hint text-bg/70" x-text="languageLabel"></span>
                    <span x-show="languages.length || openFilter === 'language'" x-cloak
                          aria-hidden="true"
                          class="absolute inset-x-5 -bottom-px h-0.5 bg-bg"></span>
                </button>
                <div x-show="openFilter === 'language'" x-cloak class="filter-popover">
                    <div class="space-y-2">
                        <template x-for="lang in languagesAll" :key="lang">
                            <label class="flex items-center gap-3 text-caption text-text">
                                <input type="checkbox" :value="lang" x-model="languages" class="custom-check">
                                <span x-text="lang"></span>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

        </div>
        </div>{{-- /container-page --}}
        {{-- Gold hairline divider at band's bottom for editorial finish --}}
        <div aria-hidden="true" class="h-px bg-gold/30"></div>
    </div>{{-- /navy band --}}

        {{-- Mobile filter sheet --}}
        <div x-show="sheetOpen"
             x-cloak
             x-transition:enter="transition-opacity duration-200 ease-out"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-150 ease-in"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="sheetOpen = false"
             class="fixed inset-0 z-50 flex flex-col bg-bg md:hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-text/15 px-6 py-4">
                <h2 class="text-card-h3">Bộ lọc</h2>
                <button type="button" @click="sheetOpen = false" aria-label="Đóng" class="rounded p-2 text-text transition-colors hover:bg-text/5">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            {{-- Body (scrollable) --}}
            <div class="flex-1 overflow-y-auto px-6 py-6">
                {{-- Specialty --}}
                <div>
                    <h3 class="text-eyebrow text-text/60">
                        Chuyên môn<span x-show="specialties.length" x-cloak x-text="' (' + specialties.length + ')'"></span>
                    </h3>
                    <input type="search"
                           x-model="specialtySearch"
                           placeholder="Tìm chuyên môn..."
                           aria-label="Tìm chuyên môn"
                           class="filter-search mt-3">
                    <div class="mt-3 flex max-h-[280px] flex-col gap-2 overflow-y-auto pr-1">
                        <template x-for="spec in filteredSpecialties" :key="spec">
                            <label class="flex items-center gap-3 text-body text-text">
                                <input type="checkbox" :value="spec" x-model="specialties" class="custom-check">
                                <span x-text="spec"></span>
                            </label>
                        </template>
                        <p x-show="filteredSpecialties.length === 0" x-cloak class="text-caption text-text/60">
                            Không có kết quả phù hợp.
                        </p>
                    </div>
                </div>

                {{-- Location --}}
                <div class="mt-8 border-t border-text/15 pt-8">
                    <h3 class="text-eyebrow text-text/60">
                        Địa điểm<span x-show="locations.length" x-cloak x-text="' (' + locations.length + ')'"></span>
                    </h3>
                    <input type="search"
                           x-model="locationSearch"
                           placeholder="Tìm địa điểm..."
                           aria-label="Tìm địa điểm"
                           class="filter-search mt-3">
                    <div class="mt-3 flex max-h-[280px] flex-col gap-2 overflow-y-auto pr-1">
                        <template x-for="loc in filteredLocations" :key="loc">
                            <label class="flex items-center gap-3 text-body text-text">
                                <input type="checkbox" :value="loc" x-model="locations" class="custom-check">
                                <span x-text="loc"></span>
                            </label>
                        </template>
                        <p x-show="filteredLocations.length === 0" x-cloak class="text-caption text-text/60">
                            Không có kết quả phù hợp.
                        </p>
                    </div>
                </div>

                {{-- Time --}}
                <div class="mt-8 border-t border-text/15 pt-8">
                    <h3 class="text-eyebrow text-text/60">
                        Thời gian<span x-show="timeFilterCount" x-cloak x-text="' (' + timeFilterCount + ')'"></span>
                    </h3>

                    <div class="mt-4 flex gap-2">
                        <div class="relative flex-1">
                            <select x-model.number="viewMonth"
                                    class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                <template x-for="m in availableMonthsInView" :key="m">
                                    <option :value="m" x-text="monthNames[m]"></option>
                                </template>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                <x-icon name="chevron-down" :size="14" />
                            </span>
                        </div>
                        <div class="relative flex-1">
                            <select x-model.number="viewYear" @change="syncMonthToYear()"
                                    class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                <template x-for="y in availableYears" :key="y">
                                    <option :value="y" x-text="y"></option>
                                </template>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                <x-icon name="chevron-down" :size="14" />
                            </span>
                        </div>
                    </div>

                    <div class="mt-3 grid grid-cols-7 gap-0.5">
                        <template x-for="d in ['T2','T3','T4','T5','T6','T7','CN']" :key="d">
                            <span class="text-form-hint text-center font-medium uppercase tracking-wide text-text/50" x-text="d"></span>
                        </template>
                    </div>

                    <div class="mt-1 grid grid-cols-7 gap-0.5">
                        <template x-for="(cell, i) in calendarCells" :key="i">
                            <button type="button"
                                    :disabled="cell.day === null || cell.offset === null"
                                    @click="selectDay(cell.offset)"
                                    :class="
                                        cell.day === null ? 'invisible' :
                                        cell.offset === null ? 'text-text/25 cursor-not-allowed' :
                                        selectedDay === cell.offset ? 'bg-accent text-bg font-semibold' :
                                        cell.isToday ? 'text-accent ring-1 ring-accent/40 hover:bg-text/5' :
                                        'text-text hover:bg-text/5'
                                    "
                                    class="aspect-square rounded-md text-status-pill transition-colors"
                                    x-text="cell.day"></button>
                        </template>
                    </div>

                    <div x-show="selectedDay !== null" x-cloak class="mt-5">
                        <p class="text-eyebrow text-text/60">Giờ</p>
                        <template x-if="availableTimesForDay.length === 0">
                            <p class="mt-2 text-caption text-text/70">Không có luật sư nào trống vào ngày này.</p>
                        </template>
                        <div class="mt-2 grid grid-cols-3 gap-2">
                            <template x-for="slot in availableTimesForDay" :key="slot">
                                <button type="button"
                                        @click="selectedTime = (selectedTime === slot ? null : slot)"
                                        :class="selectedTime === slot ? 'border-accent bg-accent text-bg' : 'border-text/20 text-text hover:border-accent'"
                                        class="rounded-xl border px-2 py-1.5 text-center text-caption transition-colors"
                                        x-text="slot"></button>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Price --}}
                <div class="mt-8 border-t border-text/15 pt-8">
                    <h3 class="text-eyebrow text-text/60">
                        Khoảng giá<span x-show="maxPrice < 5000000" x-cloak x-text="' (≤ ' + Number(maxPrice).toLocaleString('vi-VN') + ')'"></span>
                    </h3>
                    <input type="range"
                           min="500000" max="5000000" step="100000"
                           x-model.number="maxPrice"
                           :style="`--value: ${((maxPrice - 500000) / 4500000) * 100}%`"
                           class="price-slider mt-5 w-full cursor-pointer">
                    <p class="mt-3 text-caption text-text">
                        500.000 đến <span x-text="Number(maxPrice).toLocaleString('vi-VN')"></span> VND
                    </p>
                </div>

                {{-- Language --}}
                <div class="mt-8 border-t border-text/15 pt-8">
                    <h3 class="text-eyebrow text-text/60">
                        Ngôn ngữ<span x-show="languages.length" x-cloak x-text="' (' + languages.length + ')'"></span>
                    </h3>
                    <div class="mt-3 space-y-2">
                        <template x-for="lang in languagesAll" :key="lang">
                            <label class="flex items-center gap-3 text-body text-text">
                                <input type="checkbox" :value="lang" x-model="languages" class="custom-check">
                                <span x-text="lang"></span>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between gap-4 border-t border-text/15 bg-bg px-6 py-4">
                <button type="button"
                        @click="reset()"
                        x-show="hasActiveFilters"
                        x-cloak
                        class="text-caption text-text/70 transition-colors hover:text-text">
                    Xóa bộ lọc
                </button>
                <button type="button"
                        @click="sheetOpen = false"
                        class="ml-auto rounded-full bg-accent px-8 py-3 text-form-label text-bg transition-opacity hover:opacity-90">
                    <span>Xem</span>
                    <span x-text="visibleCount"></span>
                    <span>luật sư</span>
                </button>
            </div>
        </div>

        {{-- Results: switches to light bg-bg below the navy band --}}
        <div class="container-page pt-12 pb-24">
                {{-- Results bar: count + sort + clear-all --}}
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <p class="text-body text-text">
                        <span class="font-medium" x-text="visibleCount.toLocaleString('vi-VN')"></span>
                        <span class="text-text/70">luật sư phù hợp</span>
                    </p>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 text-caption text-text/70">
                            <span>Sắp xếp:</span>
                            <div class="relative">
                                <select x-model="sortBy"
                                        class="appearance-none border-0 border-b border-text/30 bg-transparent py-1 pr-6 text-caption font-medium text-text focus:border-accent focus:outline-none">
                                    <option value="rating">Đánh giá cao nhất</option>
                                    <option value="experience">Nhiều năm kinh nghiệm nhất</option>
                                    <option value="price-asc">Giá thấp đến cao</option>
                                    <option value="price-desc">Giá cao đến thấp</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center text-text/60">
                                    <x-icon name="chevron-down" :size="14" />
                                </span>
                            </div>
                        </label>
                        <button type="button"
                                @click="reset()"
                                x-show="hasActiveFilters"
                                x-cloak
                                class="text-link-action inline-flex items-center gap-1 text-caption text-text/70 transition-colors hover:text-text">
                            Xóa tất cả
                        </button>
                    </div>
                </div>

                {{-- Active filter chips: each removes its own selection --}}
                <div x-show="hasActiveFilters" x-cloak class="mt-6 flex flex-wrap gap-2">
                    <template x-for="s in specialties" :key="'spec-' + s">
                        <button type="button"
                                @click="specialties = specialties.filter(v => v !== s)"
                                class="active-chip">
                            <span x-text="s"></span>
                            <span aria-hidden="true">×</span>
                        </button>
                    </template>
                    <template x-for="l in locations" :key="'loc-' + l">
                        <button type="button"
                                @click="locations = locations.filter(v => v !== l)"
                                class="active-chip">
                            <span x-text="l"></span>
                            <span aria-hidden="true">×</span>
                        </button>
                    </template>
                    <template x-for="l in languages" :key="'lang-' + l">
                        <button type="button"
                                @click="languages = languages.filter(v => v !== l)"
                                class="active-chip">
                            <span x-text="l"></span>
                            <span aria-hidden="true">×</span>
                        </button>
                    </template>
                    <template x-if="selectedDay !== null">
                        <button type="button"
                                @click="selectedDay = null; selectedTime = null"
                                class="active-chip">
                            <span x-text="selectedDayLabel"></span>
                            <span aria-hidden="true">×</span>
                        </button>
                    </template>
                    <template x-if="selectedTime !== null">
                        <button type="button"
                                @click="selectedTime = null"
                                class="active-chip">
                            <span x-text="selectedTime"></span>
                            <span aria-hidden="true">×</span>
                        </button>
                    </template>
                    <template x-if="maxPrice < 5000000">
                        <button type="button"
                                @click="maxPrice = 5000000"
                                class="active-chip">
                            <span>≤ <span x-text="Number(maxPrice).toLocaleString('vi-VN')"></span> VND</span>
                            <span aria-hidden="true">×</span>
                        </button>
                    </template>
                </div>

                <div class="mt-8">

                {{-- Empty state --}}
                <div x-show="visibleCount === 0" x-cloak class="flex flex-col items-center justify-center rounded-2xl border border-text/20 px-8 py-20 text-center">
                    <h3 class="text-chapter-h2">Không có luật sư nào khớp với bộ lọc của bạn.</h3>
                    <p class="text-body mt-3 max-w-md">Thử điều chỉnh hoặc xóa một vài bộ lọc để xem thêm lựa chọn.</p>
                    <button type="button" @click="reset()" class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                        Xóa bộ lọc
                        <span aria-hidden="true">→</span>
                    </button>
                </div>

            <div x-show="visibleCount > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($allLawyers as $i => $lawyer)
                    <div :class="{ 'hidden': !visibleMap[{{ $i }}] }"
                         :style="`order: ${orderMap[{{ $i }}] ?? 0}`"
                         class="hidden"
                         x-cloak>
                        <x-lawyer-card :lawyer="$lawyer" />
                    </div>
                @endforeach
            </div>

            {{-- Pagination: only renders when there's more than one page of filtered results --}}
            <div x-show="visibleCount > 0 && totalPages > 1" x-cloak class="mt-12 flex flex-wrap items-center justify-center gap-2">
                <button type="button"
                        @click="if (page > 1) { page--; window.scrollTo({ top: 0, behavior: 'smooth' }); }"
                        :disabled="page === 1"
                        :class="page === 1 ? 'text-text/30 cursor-not-allowed' : 'text-text hover:text-text/60'"
                        class="px-3 py-2 text-caption transition-colors">
                    ← Trước
                </button>
                <template x-for="p in totalPages" :key="p">
                    <button type="button"
                            @click="page = p; window.scrollTo({ top: 0, behavior: 'smooth' });"
                            :class="page === p ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                            class="flex h-10 w-10 items-center justify-center rounded-full border text-form-label transition-colors"
                            x-text="p"></button>
                </template>
                <button type="button"
                        @click="if (page < totalPages) { page++; window.scrollTo({ top: 0, behavior: 'smooth' }); }"
                        :disabled="page === totalPages"
                        :class="page === totalPages ? 'text-text/30 cursor-not-allowed' : 'text-text hover:text-text/60'"
                        class="px-3 py-2 text-caption transition-colors">
                    Sau →
                </button>
            </div>
            </div>
        </div>
    </section>

    <style>
        .filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 9999px;
            border: 1px solid;
            font-size: 14px;
            font-weight: 500;
            transition: border-color 0.15s ease, background-color 0.15s ease, color 0.15s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .filter-pill-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 9999px;
            background: color-mix(in srgb, var(--color-bg) 25%, transparent);
            color: var(--color-bg);
            font-size: 12px;
            font-weight: 600;
            line-height: 1;
        }

        .filter-popover {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            z-index: 40;
            width: 280px;
            border-radius: 16px;
            border: 1px solid color-mix(in srgb, var(--color-text) 15%, transparent);
            background: var(--color-bg);
            padding: 20px;
            box-shadow: 0 8px 32px -8px rgba(2, 21, 38, 0.15);
        }

        @media (max-width: 640px) {
            .filter-popover {
                width: calc(100vw - 32px);
                max-width: 320px;
            }
        }

        .filter-search {
            display: block;
            width: 100%;
            border: 1px solid color-mix(in srgb, var(--color-text) 20%, transparent);
            background: transparent;
            color: var(--color-text);
            border-radius: 12px;
            padding: 8px 12px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.15s ease;
        }

        .filter-search::placeholder {
            color: color-mix(in srgb, var(--color-text) 50%, transparent);
        }

        .filter-search:focus {
            border-color: var(--color-accent);
        }

        .filter-list {
            max-height: 240px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-right: 4px;
        }

        .filter-list::-webkit-scrollbar {
            width: 6px;
        }

        .filter-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .filter-list::-webkit-scrollbar-thumb {
            background: color-mix(in srgb, var(--color-text) 20%, transparent);
            border-radius: 3px;
        }

        .filter-list::-webkit-scrollbar-thumb:hover {
            background: color-mix(in srgb, var(--color-text) 35%, transparent);
        }

        .custom-check {
            appearance: none;
            -webkit-appearance: none;
            background-color: transparent;
            border: 2px solid color-mix(in srgb, var(--color-text) 30%, transparent);
            border-radius: 4px;
            width: 16px;
            height: 16px;
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
            transition: background-color 0.15s ease, border-color 0.15s ease;
        }

        .custom-check:hover {
            border-color: var(--color-text);
        }

        .custom-check:checked {
            background-color: var(--color-accent);
            border-color: var(--color-accent);
        }

        .custom-check:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 0;
            width: 4px;
            height: 9px;
            border: solid var(--color-bg);
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-check:focus-visible {
            outline: 2px solid var(--color-accent);
            outline-offset: 2px;
        }

        .active-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 9999px;
            background: color-mix(in srgb, var(--color-accent) 10%, transparent);
            color: var(--color-accent);
            font-size: 13px;
            font-weight: 500;
            line-height: 1.2;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        .active-chip:hover {
            background: color-mix(in srgb, var(--color-accent) 18%, transparent);
        }

        .active-chip > span[aria-hidden] {
            font-size: 16px;
            line-height: 1;
            opacity: 0.6;
        }

        .price-slider {
            -webkit-appearance: none;
            appearance: none;
            height: 6px;
            border-radius: 9999px;
            background: linear-gradient(
                to right,
                var(--color-accent) 0%,
                var(--color-accent) var(--value, 100%),
                color-mix(in srgb, var(--color-text) 15%, transparent) var(--value, 100%),
                color-mix(in srgb, var(--color-text) 15%, transparent) 100%
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
            border: 2px solid var(--color-bg);
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
            border: 2px solid var(--color-bg);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
            transition: transform 0.15s ease;
        }

        .price-slider::-moz-range-thumb:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        function lawyerFilters(allLawyers, specialtyList, locationList, languageList, todayYear, todayMonth, todayDay) {
            return {
                lawyersForFilter: allLawyers,
                specialtiesAll: specialtyList,
                locationsAll: locationList,
                languagesAll: languageList,
                specialties: [],
                locations: [],
                languages: [],
                specialtySearch: '',
                locationSearch: '',
                selectedDay: null,
                selectedTime: null,
                maxPrice: 5000000,
                openFilter: null,
                sheetOpen: false,
                page: 1,
                perPage: 9,
                sortBy: 'rating',
                filteredIndices: [],
                visibleMap: {},
                orderMap: {},

                toggleFilter(name) {
                    this.openFilter = this.openFilter === name ? null : name;
                },

                openSheet() {
                    this.sheetOpen = true;
                },

                init() {
                    this.$watch('sheetOpen', value => {
                        document.body.style.overflow = value ? 'hidden' : '';
                    });
                    ['specialties', 'locations', 'selectedDay', 'selectedTime', 'languages', 'maxPrice', 'sortBy'].forEach(key => {
                        this.$watch(key, () => {
                            this.page = 1;
                            this.recomputeFiltered();
                        });
                    });
                    this.$watch('page', () => this.recomputeMaps());
                    this.recomputeFiltered();
                },

                recomputeFiltered() {
                    const indices = [];
                    this.lawyersForFilter.forEach((lawyer, i) => {
                        if (this.matches(lawyer)) indices.push(i);
                    });
                    const key = this.sortBy;
                    const lf = this.lawyersForFilter;
                    indices.sort((a, b) => {
                        if (key === 'experience') return (lf[b].years_of_experience || 0) - (lf[a].years_of_experience || 0);
                        if (key === 'price-asc') return lf[a].price_per_hour - lf[b].price_per_hour;
                        if (key === 'price-desc') return lf[b].price_per_hour - lf[a].price_per_hour;
                        return (lf[b].rating || 0) - (lf[a].rating || 0);
                    });
                    this.filteredIndices = indices;
                    this.recomputeMaps();
                },

                recomputeMaps() {
                    const vis = {};
                    const ord = {};
                    const start = (this.page - 1) * this.perPage;
                    const end = start + this.perPage;
                    this.filteredIndices.forEach((lawyerIdx, pos) => {
                        ord[lawyerIdx] = pos;
                        vis[lawyerIdx] = pos >= start && pos < end;
                    });
                    this.visibleMap = vis;
                    this.orderMap = ord;
                },

                todayYear,
                todayMonth,
                todayDay,
                viewYear: todayYear,
                viewMonth: todayMonth,

                monthNames: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],

                get availableYears() {
                    const years = new Set([this.todayYear]);
                    const lastOffset = this.availableOffsets.size ? Math.max(...this.availableOffsets) : 0;
                    for (let i = 0; i <= lastOffset; i++) {
                        const d = new Date(this.todayYear, this.todayMonth, this.todayDay + i);
                        years.add(d.getFullYear());
                    }
                    return [...years].sort((a, b) => a - b);
                },

                get availableMonthsInView() {
                    const months = new Set();
                    const lastOffset = this.availableOffsets.size ? Math.max(...this.availableOffsets) : 0;
                    for (let i = 0; i <= lastOffset; i++) {
                        const d = new Date(this.todayYear, this.todayMonth, this.todayDay + i);
                        if (d.getFullYear() === this.viewYear) months.add(d.getMonth());
                    }
                    if (months.size === 0) months.add(this.todayMonth);
                    return [...months].sort((a, b) => a - b);
                },

                syncMonthToYear() {
                    const available = this.availableMonthsInView;
                    if (!available.includes(this.viewMonth)) {
                        this.viewMonth = available[0];
                    }
                },

                get specialtyLabel() {
                    if (this.specialties.length === 0) return 'Tất cả lĩnh vực';
                    if (this.specialties.length === 1) return this.specialties[0];
                    return this.specialties.length + ' đã chọn';
                },
                get locationLabel() {
                    if (this.locations.length === 0) return 'Cả nước';
                    if (this.locations.length === 1) return this.locations[0];
                    return this.locations.length + ' đã chọn';
                },
                get timeLabel() {
                    if (this.selectedDay === null) return 'Bất kỳ';
                    const d = new Date(this.todayYear, this.todayMonth, this.todayDay + this.selectedDay);
                    const wd = ['CN','T2','T3','T4','T5','T6','T7'];
                    const date = `${wd[d.getDay()]}, ${d.getDate()}/${d.getMonth() + 1}`;
                    return this.selectedTime ? `${date} · ${this.selectedTime}` : date;
                },
                get priceLabel() {
                    if (this.maxPrice >= 5000000) return 'Bất kỳ';
                    return '≤ ' + Number(this.maxPrice).toLocaleString('vi-VN');
                },
                get languageLabel() {
                    if (this.languages.length === 0) return 'Tất cả';
                    if (this.languages.length === 1) return this.languages[0];
                    return this.languages.length + ' đã chọn';
                },

                get filteredSpecialties() {
                    const q = this.specialtySearch.trim().toLowerCase();
                    if (!q) return this.specialtiesAll;
                    return this.specialtiesAll.filter(s => s.toLowerCase().includes(q));
                },

                get filteredLocations() {
                    const q = this.locationSearch.trim().toLowerCase();
                    if (!q) return this.locationsAll;
                    return this.locationsAll.filter(s => s.toLowerCase().includes(q));
                },

                get timeFilterCount() {
                    return (this.selectedDay !== null ? 1 : 0) + (this.selectedTime !== null ? 1 : 0);
                },

                get availableOffsets() {
                    const set = new Set();
                    this.lawyersForFilter.forEach(lawyer => {
                        (lawyer.availability || []).forEach(a => set.add(a.day_offset));
                    });
                    return set;
                },

                get calendarCells() {
                    const firstOfMonth = new Date(this.viewYear, this.viewMonth, 1);
                    const firstWeekday = (firstOfMonth.getDay() + 6) % 7;
                    const daysInMonth = new Date(this.viewYear, this.viewMonth + 1, 0).getDate();
                    const todayMs = Date.UTC(this.todayYear, this.todayMonth, this.todayDay);

                    const cells = [];
                    for (let i = 0; i < firstWeekday; i++) cells.push({ day: null });
                    for (let d = 1; d <= daysInMonth; d++) {
                        const cellMs = Date.UTC(this.viewYear, this.viewMonth, d);
                        const offset = Math.round((cellMs - todayMs) / 86400000);
                        const inWindow = offset >= 0 && this.availableOffsets.has(offset);
                        cells.push({
                            day: d,
                            offset: inWindow ? offset : null,
                            isToday: offset === 0,
                        });
                    }
                    return cells;
                },

                get canGoPrevMonth() {
                    return this.viewYear > this.todayYear
                        || (this.viewYear === this.todayYear && this.viewMonth > this.todayMonth);
                },

                get canGoNextMonth() {
                    const lastOffset = Math.max(...this.availableOffsets);
                    if (!isFinite(lastOffset)) return false;
                    const lastDate = new Date(this.todayYear, this.todayMonth, this.todayDay + lastOffset);
                    return this.viewYear < lastDate.getFullYear()
                        || (this.viewYear === lastDate.getFullYear() && this.viewMonth < lastDate.getMonth());
                },

                prevMonth() {
                    if (!this.canGoPrevMonth) return;
                    if (this.viewMonth === 0) { this.viewMonth = 11; this.viewYear--; }
                    else { this.viewMonth--; }
                },

                nextMonth() {
                    if (!this.canGoNextMonth) return;
                    if (this.viewMonth === 11) { this.viewMonth = 0; this.viewYear++; }
                    else { this.viewMonth++; }
                },

                selectDay(offset) {
                    if (offset === null) return;
                    this.selectedDay = (this.selectedDay === offset ? null : offset);
                    if (this.selectedDay === null || !this.availableTimesForDay.includes(this.selectedTime)) {
                        this.selectedTime = null;
                    }
                },

                get hasActiveFilters() {
                    return this.specialties.length > 0
                        || this.locations.length > 0
                        || this.selectedDay !== null
                        || this.languages.length > 0
                        || this.maxPrice < 5000000;
                },

                get activeFilterCount() {
                    return this.specialties.length
                        + this.locations.length
                        + (this.selectedDay !== null ? 1 : 0)
                        + this.languages.length
                        + (this.maxPrice < 5000000 ? 1 : 0);
                },

                get selectedDayLabel() {
                    if (this.selectedDay === null) return '';
                    const d = new Date(this.todayYear, this.todayMonth, this.todayDay + this.selectedDay);
                    const weekdays = ['CN','T2','T3','T4','T5','T6','T7'];
                    return `${weekdays[d.getDay()]}, ${d.getDate()}/${d.getMonth() + 1}`;
                },

                get visibleCount() {
                    return this.filteredIndices.length;
                },

                get totalPages() {
                    return Math.max(1, Math.ceil(this.visibleCount / this.perPage));
                },

                get availableTimesForDay() {
                    if (this.selectedDay === null) return [];
                    const set = new Set();
                    this.lawyersForFilter.forEach(lawyer => {
                        const entry = (lawyer.availability || []).find(a => a.day_offset === this.selectedDay);
                        if (entry) entry.slots.forEach(s => set.add(s));
                    });
                    return Array.from(set).sort();
                },

                matches(lawyer) {
                    if (this.specialties.length > 0 && !lawyer.specialty_tags.some(s => this.specialties.includes(s))) return false;
                    if (this.locations.length > 0 && !this.locations.includes(lawyer.province)) return false;
                    if (this.selectedDay !== null) {
                        const dayEntry = (lawyer.availability || []).find(a => a.day_offset === this.selectedDay);
                        if (!dayEntry) return false;
                        if (this.selectedTime !== null && !dayEntry.slots.includes(this.selectedTime)) return false;
                    }
                    if (this.languages.length > 0 && !lawyer.languages.some(l => this.languages.includes(l))) return false;
                    if (lawyer.price_per_hour > this.maxPrice) return false;
                    return true;
                },

                reset() {
                    this.specialties = [];
                    this.locations = [];
                    this.selectedDay = null;
                    this.selectedTime = null;
                    this.languages = [];
                    this.maxPrice = 5000000;
                    this.specialtySearch = '';
                    this.locationSearch = '';
                    this.sortBy = 'rating';
                    this.page = 1;
                },
            };
        }
    </script>
@endsection

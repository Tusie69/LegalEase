@extends('layouts.app', ['title' => 'Luật sư · LegalEase'])

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
    <section class="container-page pb-24 pt-24"
             x-data="lawyerFilters({{ json_encode($lawyersForFilter) }}, {{ $today->year }}, {{ $today->month - 1 }}, {{ $today->day }})">
        <nav class="text-[14px]">
            <a href="/" class="transition-colors hover:text-accent">Trang chủ</a>
            <span class="px-1">/</span>
            <span class="text-text">Luật sư</span>
        </nav>

        <h1 class="mt-6 font-display text-[48px] font-medium leading-snug tracking-tight md:text-[56px]">Tìm luật sư của bạn</h1>
        <p class="text-body-prose mt-3">Duyệt qua hơn 500 luật sư đã được xác minh trên khắp Việt Nam.</p>

        <div class="mt-10 grid grid-cols-1 gap-12 lg:grid-cols-[240px_1fr]">
            <aside class="self-start lg:sticky lg:top-22">
                <button type="button"
                        @click="filterOpen = !filterOpen"
                        :aria-expanded="filterOpen"
                        class="flex w-full items-center justify-between rounded-2xl bg-accent px-6 py-5 text-bg transition-opacity hover:opacity-90 lg:hidden">
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

                <div x-show="filterOpen" x-cloak class="mt-4 rounded-2xl bg-accent p-8 lg:!mt-0 lg:!block">
                    <h3 class="text-card-h4 hidden text-bg lg:block">Bộ lọc</h3>

                    <div class="lg:mt-6">
                        <h4 class="text-eyebrow-hero text-gold">Chuyên môn</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($specialties as $spec)
                                <label class="flex items-center gap-3 text-[14px] text-bg">
                                    <input type="checkbox" value="{{ $spec }}" x-model="specialties" class="custom-check">
                                    <span>{{ $spec }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow-hero text-gold">Địa điểm</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($locations as $loc)
                                <label class="flex items-center gap-3 text-[14px] text-bg">
                                    <input type="checkbox" value="{{ $loc }}" x-model="locations" class="custom-check">
                                    <span>{{ $loc }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow-hero text-gold">Thời gian</h4>

                        <div class="mt-3 flex items-center justify-between">
                            <button type="button"
                                    @click="prevMonth()"
                                    :disabled="!canGoPrevMonth"
                                    :class="canGoPrevMonth ? 'text-bg hover:text-gold' : 'text-bg/25 cursor-not-allowed'"
                                    class="rounded p-1 transition-colors"
                                    aria-label="Tháng trước">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"/>
                                </svg>
                            </button>
                            <span class="text-[14px] font-medium text-bg" x-text="monthLabel"></span>
                            <button type="button"
                                    @click="nextMonth()"
                                    :disabled="!canGoNextMonth"
                                    :class="canGoNextMonth ? 'text-bg hover:text-gold' : 'text-bg/25 cursor-not-allowed'"
                                    class="rounded p-1 transition-colors"
                                    aria-label="Tháng sau">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"/>
                                </svg>
                            </button>
                        </div>

                        <div class="mt-3 grid grid-cols-7 gap-0.5">
                            <template x-for="d in ['T2','T3','T4','T5','T6','T7','CN']" :key="d">
                                <span class="text-center text-[10px] font-medium uppercase tracking-wide text-bg/60" x-text="d"></span>
                            </template>
                        </div>

                        <div class="mt-1 grid grid-cols-7 gap-0.5">
                            <template x-for="(cell, i) in calendarCells" :key="i">
                                <button type="button"
                                        :disabled="cell.day === null || cell.offset === null"
                                        @click="selectDay(cell.offset)"
                                        :class="
                                            cell.day === null ? 'invisible' :
                                            cell.offset === null ? 'text-bg/25 cursor-not-allowed' :
                                            selectedDay === cell.offset ? 'bg-gold text-accent font-semibold' :
                                            cell.isToday ? 'text-gold ring-1 ring-gold/40 hover:bg-bg/10' :
                                            'text-bg hover:bg-bg/10'
                                        "
                                        class="aspect-square rounded-md text-[12px] font-medium transition-colors"
                                        x-text="cell.day"></button>
                            </template>
                        </div>
                    </div>

                    <div x-show="selectedDay !== null" x-cloak class="mt-6">
                        <h4 class="text-eyebrow-hero text-gold">Giờ</h4>
                        <template x-if="availableTimesForDay.length === 0">
                            <p class="mt-3 text-[14px] text-bg/70">Không có luật sư nào trống vào ngày này.</p>
                        </template>
                        <div class="mt-3 grid grid-cols-2 gap-2">
                            <template x-for="slot in availableTimesForDay" :key="slot">
                                <button type="button"
                                        @click="selectedTime = (selectedTime === slot ? null : slot)"
                                        :class="selectedTime === slot ? 'border-gold bg-gold/15 text-gold' : 'border-bg/30 text-bg hover:border-gold hover:text-gold'"
                                        class="rounded-xl border px-2 py-2 text-center text-[14px] transition-colors"
                                        x-text="slot"></button>
                            </template>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow-hero text-gold">Khoảng giá</h4>
                        <input type="range"
                               min="500000" max="5000000" step="100000"
                               x-model.number="maxPrice"
                               :style="`--value: ${((maxPrice - 500000) / 4500000) * 100}%`"
                               class="price-slider mt-4 w-full cursor-pointer">
                        <p class="mt-2 text-[14px] text-bg">
                            500.000 đến <span x-text="Number(maxPrice).toLocaleString('vi-VN')"></span> VND
                        </p>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-eyebrow-hero text-gold">Ngôn ngữ</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($languages as $lang)
                                <label class="flex items-center gap-3 text-[14px] text-bg">
                                    <input type="checkbox" value="{{ $lang }}" x-model="languages" class="custom-check">
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gold/40 pt-4" x-show="hasActiveFilters" x-cloak>
                        <button type="button" @click="reset()" class="text-[14px] text-bg/80 transition-colors hover:text-gold hover:underline underline-offset-4">
                            Xóa bộ lọc
                        </button>
                    </div>
                </div>
            </aside>

            <div>
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
                        <div x-show="matches(lawyersForFilter[{{ $i }}])" x-cloak>
                            <x-lawyer-card :lawyer="$lawyer" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        .custom-check {
            appearance: none;
            -webkit-appearance: none;
            background-color: transparent;
            border: 2px solid color-mix(in srgb, var(--color-bg) 40%, transparent);
            border-radius: 4px;
            width: 16px;
            height: 16px;
            cursor: pointer;
            position: relative;
            transition: background-color 0.15s ease, border-color 0.15s ease;
        }

        .custom-check:hover {
            border-color: var(--color-bg);
        }

        .custom-check:checked {
            background-color: var(--color-gold);
            border-color: var(--color-gold);
        }

        .custom-check:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 0;
            width: 4px;
            height: 9px;
            border: solid var(--color-accent);
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-check:focus-visible {
            outline: 2px solid var(--color-bg);
            outline-offset: 2px;
        }

        .price-slider {
            -webkit-appearance: none;
            appearance: none;
            height: 6px;
            border-radius: 9999px;
            background: linear-gradient(
                to right,
                var(--color-gold) 0%,
                var(--color-gold) var(--value, 100%),
                color-mix(in srgb, var(--color-bg) 25%, transparent) var(--value, 100%),
                color-mix(in srgb, var(--color-bg) 25%, transparent) 100%
            );
        }

        .price-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            background: var(--color-gold);
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
            background: var(--color-gold);
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
        function lawyerFilters(allLawyers, todayYear, todayMonth, todayDay) {
            return {
                lawyersForFilter: allLawyers,
                specialties: [],
                locations: [],
                selectedDay: null,
                selectedTime: null,
                languages: [],
                maxPrice: 5000000,
                filterOpen: false,

                todayYear,
                todayMonth,
                todayDay,
                viewYear: todayYear,
                viewMonth: todayMonth,

                get monthLabel() {
                    return `Tháng ${this.viewMonth + 1}, ${this.viewYear}`;
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

                get visibleCount() {
                    return this.lawyersForFilter.filter(lawyer => this.matches(lawyer)).length;
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
                },
            };
        }
    </script>
@endsection

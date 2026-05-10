@extends('layouts.app', ['title' => 'Câu hỏi thường gặp · LegalEase'])

@php
    $items = \App\Data\FAQs::all();
    $categories = \App\Data\FAQs::categories();

    $chipLabels = [
        'Đặt chỗ và thanh toán' => 'Đặt chỗ',
        'Hủy và hoàn tiền' => 'Hủy & hoàn tiền',
        'Dành cho luật sư' => 'Luật sư',
        'Sự tin cậy và an toàn' => 'Tin cậy & an toàn',
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80"
        eyebrow="FAQ">
        Câu hỏi thường gặp.

        <x-slot:subtitle>
            Đặt chỗ, thanh toán, hủy, và sự tin cậy. Trả lời cho những câu hỏi phổ biến nhất.
        </x-slot:subtitle>
    </x-hero-bar>

    <section class="container-narrow pt-24 pb-24"
             x-data="faqFilters({{ json_encode(array_values($items)) }})">
        <div class="relative">
            <input type="search"
                   x-model="search"
                   placeholder="Tìm kiếm câu hỏi…"
                   aria-label="Tìm kiếm câu hỏi"
                   class="block w-full rounded-xl border border-text/20 bg-bg py-3 pl-11 pr-4 text-[16px] text-text placeholder:text-text/50 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-text/50">
                <x-icon name="search" :size="18" />
            </span>
            <button type="button"
                    x-show="search.length > 0"
                    @click="search = ''"
                    aria-label="Xóa tìm kiếm"
                    class="absolute inset-y-0 right-3 flex items-center text-text/60 transition-colors hover:text-accent">
                <x-icon name="x" :size="16" />
            </button>
        </div>

        <div class="mt-6 flex flex-wrap gap-2">
            <button type="button"
                    @click="selectedCategory = null"
                    :class="selectedCategory === null ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                    class="rounded-full border px-4 py-2 text-[14px] font-medium transition-colors">
                Tất cả
            </button>
            @foreach ($categories as $cat)
                <button type="button"
                        @click="selectedCategory = '{{ $cat }}'"
                        :class="selectedCategory === '{{ $cat }}' ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                        class="rounded-full border px-4 py-2 text-[14px] font-medium transition-colors">
                    {{ $chipLabels[$cat] ?? $cat }}
                </button>
            @endforeach
        </div>

        <div x-show="visibleCount === 0" x-cloak class="mt-12 flex flex-col items-center justify-center rounded-2xl border border-text/20 px-8 py-20 text-center">
            <h3 class="text-chapter-h2">Không tìm thấy kết quả</h3>
            <p class="text-body mt-3 max-w-md">Thử từ khóa khác hoặc chọn danh mục khác.</p>
            <button type="button"
                    @click="search = ''; selectedCategory = null"
                    class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                Xóa bộ lọc
                <span aria-hidden="true">→</span>
            </button>
        </div>

        <div x-show="visibleCount > 0" class="mt-12 border-t border-text/20">
            @foreach ($items as $i => $item)
                <div x-show="isVisible({{ $i }})" x-cloak
                     x-data="{ open: false }"
                     class="border-b border-text/20">
                    <button type="button" @click="open = !open"
                            :aria-expanded="open"
                            class="flex w-full items-baseline justify-between gap-6 py-6 text-left transition-colors hover:text-accent">
                        <span class="min-w-0 flex-1">
                            <span class="text-eyebrow text-text/60">{{ $item['category'] }}</span>
                            <span class="mt-2 block font-display text-[18px] font-medium leading-snug tracking-tight md:text-[20px]">{{ $item['q'] }}</span>
                        </span>
                        <svg x-show="!open" class="h-5 w-5 flex-none mt-1"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        <svg x-show="open" x-cloak class="h-5 w-5 flex-none mt-1"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="pb-6">
                        <p class="text-body max-w-[640px]">{{ $item['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div x-show="visibleCount > 0 && totalPages > 1" x-cloak class="mt-12 flex flex-wrap items-center justify-center gap-2">
            <button type="button"
                    @click="if (page > 1) page--"
                    :disabled="page === 1"
                    :class="page === 1 ? 'text-text/30 cursor-not-allowed' : 'text-text hover:text-accent'"
                    class="px-3 py-2 text-[14px] transition-colors">
                ← Trước
            </button>
            <template x-for="p in totalPages" :key="p">
                <button type="button"
                        @click="page = p"
                        :class="page === p ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                        class="flex h-10 w-10 items-center justify-center rounded-full border text-[14px] font-medium transition-colors"
                        x-text="p"></button>
            </template>
            <button type="button"
                    @click="if (page < totalPages) page++"
                    :disabled="page === totalPages"
                    :class="page === totalPages ? 'text-text/30 cursor-not-allowed' : 'text-text hover:text-accent'"
                    class="px-3 py-2 text-[14px] transition-colors">
                Sau →
            </button>
        </div>
    </section>

    <section class="bg-gold/5">
        <div class="container-page closing-cta">
            <h2 class="text-cta-h2">Bạn vẫn còn câu hỏi?</h2>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
            </div>
        </div>
    </section>

    <script>
        function faqFilters(items) {
            return {
                items,
                selectedCategory: null,
                search: '',
                page: 1,
                perPage: 6,

                init() {
                    this.$watch('selectedCategory', () => { this.page = 1; });
                    this.$watch('search', () => { this.page = 1; });
                },

                normalize(s) {
                    return (s || '')
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[̀-ͯ]/g, '')
                        .replace(/đ/g, 'd');
                },

                get filteredIndices() {
                    const needle = this.normalize(this.search.trim());
                    const indices = [];
                    this.items.forEach((it, i) => {
                        if (this.selectedCategory !== null && it.category !== this.selectedCategory) return;
                        if (needle) {
                            const haystack = this.normalize(it.q + ' ' + it.a + ' ' + it.category);
                            if (!haystack.includes(needle)) return;
                        }
                        indices.push(i);
                    });
                    return indices;
                },

                get visibleCount() {
                    return this.filteredIndices.length;
                },

                get totalPages() {
                    return Math.max(1, Math.ceil(this.visibleCount / this.perPage));
                },

                isVisible(index) {
                    const filtered = this.filteredIndices;
                    const pos = filtered.indexOf(index);
                    if (pos === -1) return false;
                    const start = (this.page - 1) * this.perPage;
                    return pos >= start && pos < start + this.perPage;
                },
            };
        }
    </script>
@endsection

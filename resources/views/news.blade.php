@extends('layouts.app', ['title' => 'Tin tức · LegalEase'])

@php
    use Carbon\Carbon;

    $featuredArticles = \App\Data\News::featured();
    $articles = \App\Data\News::others();
    $categories = \App\Data\News::categories();
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=2000&h=1200&fit=crop&q=80"
        eyebrow="Tin tức">
        Cập nhật pháp lý cho cuộc sống hằng ngày.

        <x-slot:subtitle>
            Phân tích, hướng dẫn và bài viết chuyên sâu từ các luật sư đã được xác minh.
        </x-slot:subtitle>
    </x-hero-bar>

    <div x-data="newsFilters({{ json_encode(array_values($articles)) }})">
    @if (count($featuredArticles) > 0)
        <section x-data="featuredCarousel({{ count($featuredArticles) }})"
                 @mouseenter="pause()"
                 @mouseleave="play()"
                 class="container-page pt-24">
            <h2 class="text-section-h2">Bài viết nổi bật</h2>

            <div class="mt-12 grid">
                @foreach ($featuredArticles as $i => $featured)
                    <div :class="currentSlide === {{ $i }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                         class="col-start-1 row-start-1 transition-opacity duration-500">
                        <a href="{{ route('news.show', $featured['slug']) }}" class="block group">
                            <article class="grid gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">
                                <div class="overflow-hidden rounded-2xl">
                                    <x-responsive-img :src="$featured['image_url']"
                                                      alt=""
                                                      sizes="(min-width: 1024px) 50vw, 100vw"
                                                      :widths="[600, 900, 1200, 1600]"
                                                      class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]" />
                                </div>
                                <div>
                                    <p class="text-eyebrow">{{ $featured['category'] }}</p>
                                    <h3 class="text-flow-h1 mt-4 transition-colors group-hover:text-accent">
                                        {{ $featured['title'] }}
                                    </h3>
                                    <p class="text-body mt-5 max-w-[520px]">
                                        {{ $featured['lead'] }}
                                    </p>
                                    <p class="text-link-action mt-6 inline-flex flex-wrap items-center gap-x-2 text-text">
                                        <span>{{ $featured['author_name'] }}</span>
                                        <span class="text-text/40">·</span>
                                        <span>{{ Carbon::parse($featured['date'])->translatedFormat('d/m/Y') }}</span>
                                        <span class="text-text/40">·</span>
                                        <span>{{ $featured['read_time'] }}</span>
                                        <span class="text-text/40">·</span>
                                        <span class="transition-colors group-hover:text-accent">Đọc →</span>
                                    </p>
                                </div>
                            </article>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center gap-2">
                @foreach ($featuredArticles as $i => $_)
                    <button type="button"
                            @click="goTo({{ $i }})"
                            aria-label="Bài viết {{ $i + 1 }}"
                            :class="currentSlide === {{ $i }} ? 'w-8 bg-accent' : 'w-2 bg-text/30 hover:bg-text/50'"
                            class="h-2 rounded-full transition-all"></button>
                @endforeach
            </div>
        </section>
    @endif

    <section class="container-page pt-24 pb-24">
        <h2 class="text-section-h2">Tất cả bài viết</h2>

        <div class="mt-8 flex flex-col-reverse gap-4 lg:flex-row lg:items-center lg:justify-between lg:gap-6">
            <div class="flex gap-2 overflow-x-auto scrollbar-none -mx-8 px-8 lg:mx-0 lg:flex-wrap lg:overflow-visible lg:px-0">
            <button type="button"
                    @click="selectedCategory = null; page = 1"
                    :class="selectedCategory === null ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                    class="shrink-0 rounded-full border px-4 py-2 text-form-label transition-colors">
                Tất cả
            </button>
            @foreach ($categories as $cat)
                <button type="button"
                        @click="selectedCategory = '{{ $cat }}'; page = 1"
                        :class="selectedCategory === '{{ $cat }}' ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                        class="shrink-0 rounded-full border px-4 py-2 text-form-label transition-colors">
                    {{ $cat }}
                </button>
            @endforeach
            </div>

            <div class="relative w-full lg:w-[300px] lg:flex-none">
                <input type="search"
                       x-model="search"
                       placeholder="Tìm kiếm bài viết…"
                       aria-label="Tìm kiếm bài viết"
                       class="block w-full rounded-xl border border-text/20 bg-bg py-3 pl-11 pr-4 text-body text-text placeholder:text-text/50 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-text/50">
                    <x-icon name="search" :size="18" />
                </span>
                <button type="button"
                        x-show="search.length > 0"
                        @click="search = ''"
                        aria-label="Xóa tìm kiếm"
                        class="absolute inset-y-0 right-3 flex items-center text-text/60 transition-colors hover:text-text">
                    <x-icon name="x" :size="16" />
                </button>
            </div>
        </div>

        <div x-show="visibleCount === 0" x-cloak class="mt-12 flex flex-col items-center justify-center rounded-2xl border border-text/20 px-8 py-20 text-center">
            <h3 class="text-chapter-h2">Không tìm thấy kết quả</h3>
            <p class="text-body mt-3 max-w-md">Thử từ khóa khác hoặc chọn danh mục khác để xem thêm bài viết.</p>
            <button type="button"
                    @click="search = ''; selectedCategory = null; page = 1"
                    class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                Xóa bộ lọc
                <span aria-hidden="true">→</span>
            </button>
        </div>

        <div x-show="visibleCount > 0" class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $i => $article)
                <a x-show="isVisible({{ $i }})" x-cloak
                   href="{{ route('news.show', $article['slug']) }}"
                   class="group flex flex-col">
                    <div class="overflow-hidden rounded-xl">
                        <x-responsive-img :src="$article['image_url']"
                                          alt=""
                                          sizes="(min-width: 1024px) 33vw, (min-width: 768px) 50vw, 100vw"
                                          :widths="[400, 600, 900]"
                                          class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]" />
                    </div>
                    <p class="text-eyebrow mt-5">{{ $article['category'] }}</p>
                    <h3 class="text-card-h3 mt-2 leading-snug transition-colors group-hover:text-accent">
                        {{ $article['title'] }}
                    </h3>
                    <p class="text-body-dense mt-2">
                        {{ $article['lead'] }}
                    </p>
                    <p class="text-caption mt-4">
                        {{ $article['author_name'] }}
                        <span class="mx-1 text-text/40">·</span>
                        {{ Carbon::parse($article['date'])->translatedFormat('d/m/Y') }}
                    </p>
                </a>
            @endforeach
        </div>

        <div x-show="visibleCount > 0 && totalPages > 1" x-cloak class="mt-12 flex flex-wrap items-center justify-center gap-2">
            <button type="button"
                    @click="if (page > 1) page--"
                    :disabled="page === 1"
                    :class="page === 1 ? 'text-text/30 cursor-not-allowed' : 'text-text hover:text-text/60'"
                    class="px-3 py-2 text-caption transition-colors">
                ← Trước
            </button>
            <template x-for="p in totalPages" :key="p">
                <button type="button"
                        @click="page = p"
                        :class="page === p ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                        class="flex h-10 w-10 items-center justify-center rounded-full border text-form-label transition-colors"
                        x-text="p"></button>
            </template>
            <button type="button"
                    @click="if (page < totalPages) page++"
                    :disabled="page === totalPages"
                    :class="page === totalPages ? 'text-text/30 cursor-not-allowed' : 'text-text hover:text-text/60'"
                    class="px-3 py-2 text-caption transition-colors">
                Sau →
            </button>
        </div>
    </section>
    </div>

    <section class="bg-gold/5 mt-24 md:mt-32">
        <div class="container-page closing-cta">
            <h2 class="text-cta-h2">Cần tư vấn cho trường hợp cụ thể?</h2>
            <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
                Đặt lịch tư vấn riêng với luật sư có chuyên môn phù hợp.
            </p>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="/lawyers">Tìm luật sư →</x-button>
            </div>
        </div>
    </section>

    <script>
        function featuredCarousel(count) {
            return {
                currentSlide: 0,
                count,
                interval: null,

                init() {
                    this.play();
                },

                play() {
                    this.pause();
                    if (this.count <= 1) return;
                    this.interval = setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.count;
                    }, 5000);
                },

                pause() {
                    if (this.interval) {
                        clearInterval(this.interval);
                        this.interval = null;
                    }
                },

                goTo(index) {
                    this.currentSlide = index;
                    this.play();
                },
            };
        }

        function newsFilters(articles) {
            return {
                articles,
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
                    this.articles.forEach((a, i) => {
                        if (this.selectedCategory !== null && a.category !== this.selectedCategory) return;
                        if (needle) {
                            const haystack = this.normalize(a.title + ' ' + a.lead + ' ' + a.category + ' ' + a.author_name);
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

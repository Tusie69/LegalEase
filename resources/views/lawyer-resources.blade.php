@extends('layouts.app', ['title' => 'Tài nguyên · LegalEase'])

@php
    $featured = [
        'category'  => 'Phát triển hành nghề của bạn',
        'title'     => 'Các luật sư hàng đầu trên LegalEase lấp đầy tuần của họ như thế nào',
        'lead'      => 'Hãy xem cách các luật sư được đặt nhiều nhất trên nền tảng sắp xếp lịch trống, đặt mức phí, và biến buổi tư vấn đầu tiên thành khách hàng lâu dài.',
        'read_time' => '8 phút đọc',
        'image_url' => 'https://images.unsplash.com/photo-1758519291932-6263fc870e01?q=80',
    ];

    $articles = [
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Thiết lập hồ sơ của bạn trong 30 phút',
            'desc'      => 'Hướng dẫn chi tiết về tiểu sử, hình ảnh, chuyên môn và địa điểm.',
            'read_time' => '5 phút đọc',
            'image_url' => 'https://images.pexels.com/photos/35136019/pexels-photo-35136019.jpeg',
        ],
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Chọn mức phí theo giờ đầu tiên của bạn',
            'desc'      => 'Kinh nghiệm, chuyên môn và vị trí sẽ định hình mức phí của bạn.',
            'read_time' => '4 phút đọc',
            'image_url' => 'https://images.pexels.com/photos/12865963/pexels-photo-12865963.jpeg',
        ],
        [
            'category'  => 'Phát triển hành nghề của bạn',
            'title'     => 'Ba cách để khách hàng quay lại tư vấn',
            'desc'      => 'Luật sư giàu kinh nghiệm làm gì trong buổi gặp đầu tiên để tạo dựng niềm tin.',
            'read_time' => '6 phút đọc',
            'image_url' => 'https://images.pexels.com/photos/8901680/pexels-photo-8901680.jpeg',
        ],
        [
            'category'  => 'Phát triển hành nghề của bạn',
            'title'     => 'Viết tiểu sử tạo dựng niềm tin',
            'desc'      => 'Chi tiết cụ thể, ngôn ngữ đơn giản và những gì cần bỏ qua.',
            'read_time' => '3 phút đọc',
            'image_url' => 'https://images.pexels.com/photos/11154571/pexels-photo-11154571.jpeg',
        ],
        [
            'category'  => 'Cập nhật nền tảng',
            'title'     => 'Quy trình xác minh đã thay đổi gì trong năm nay',
            'desc'      => 'Đánh giá nhanh hơn, kiểm tra tài liệu mới và những gì đội thẩm định tìm kiếm.',
            'read_time' => '4 phút đọc',
            'image_url' => 'https://images.pexels.com/photos/8428056/pexels-photo-8428056.jpeg',
        ],
        [
            'category'  => 'Thu nhập và thanh toán',
            'title'     => 'Cách giải ngân và thanh toán hoạt động',
            'desc'      => 'Nền tảng giữ phần nào, bạn nhận phần nào, và khi nào.',
            'read_time' => '5 phút đọc',
            'image_url' => 'https://images.pexels.com/photos/7952556/pexels-photo-7952556.jpeg',
        ],
    ];

    $categories = ['Bắt đầu', 'Phát triển hành nghề của bạn', 'Cập nhật nền tảng', 'Thu nhập và thanh toán'];

    $chipLabels = [
        'Phát triển hành nghề của bạn' => 'Phát triển hành nghề',
        'Cập nhật nền tảng' => 'Cập nhật',
        'Thu nhập và thanh toán' => 'Thu nhập',
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1755675672853-9108c92fbc14?q=80"
        eyebrow="Tài nguyên">
        Vận hành tốt hơn cho hành nghề của bạn.

        <x-slot:subtitle>
            Hướng dẫn để thiết lập, định giá và phát triển hành nghề của bạn trên LegalEase.
        </x-slot:subtitle>
    </x-hero-bar>

    <section class="container-page pt-24">
        <h2 class="text-section-h2">Nổi bật</h2>

        <a href="#" class="mt-12 block group">
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
                    <h3 class="mt-4 font-display text-[32px] font-medium leading-snug tracking-tight md:text-[40px] transition-colors group-hover:text-accent">
                        {{ $featured['title'] }}
                    </h3>
                    <p class="text-body mt-5 max-w-[520px]">
                        {{ $featured['lead'] }}
                    </p>
                    <p class="text-link-action mt-6 inline-flex items-center gap-2 text-text">
                        {{ $featured['read_time'] }}
                        <span class="mx-1 text-text/40">·</span>
                        <span class="transition-colors group-hover:text-accent">Đọc →</span>
                    </p>
                </div>
            </article>
        </a>
    </section>

    <section class="container-page pt-24 pb-24"
             x-data="resourcesFilters({{ json_encode($articles) }})">
        <h2 class="text-section-h2">Tất cả tài nguyên</h2>

        <div class="mt-8 flex gap-2 overflow-x-auto scrollbar-none -mx-8 px-8 lg:mx-0 lg:flex-wrap lg:overflow-visible lg:px-0">
            <button type="button"
                    @click="selectedCategory = null"
                    :class="selectedCategory === null ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                    class="shrink-0 rounded-full border px-4 py-2 text-[14px] font-medium transition-colors">
                Tất cả
            </button>
            @foreach ($categories as $cat)
                <button type="button"
                        @click="selectedCategory = '{{ $cat }}'"
                        :class="selectedCategory === '{{ $cat }}' ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                        class="shrink-0 rounded-full border px-4 py-2 text-[14px] font-medium transition-colors">
                    {{ $chipLabels[$cat] ?? $cat }}
                </button>
            @endforeach
        </div>

        <div x-show="visibleCount === 0" x-cloak class="mt-12 flex flex-col items-center justify-center rounded-2xl border border-text/20 px-8 py-20 text-center">
            <h3 class="text-chapter-h2">Không tìm thấy kết quả</h3>
            <p class="text-body mt-3 max-w-md">Thử chọn danh mục khác để xem thêm tài nguyên.</p>
            <button type="button"
                    @click="selectedCategory = null"
                    class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                Xem tất cả tài nguyên
                <span aria-hidden="true">→</span>
            </button>
        </div>

        <div x-show="visibleCount > 0" class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $i => $article)
                <a x-show="isVisible({{ $i }})" x-cloak href="#" class="group flex flex-col">
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
                        {{ $article['desc'] }}
                    </p>
                    <p class="text-caption mt-4">{{ $article['read_time'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-gold/5">
        <div class="container-page closing-cta">
            <h2 class="text-cta-h2">
                Không tìm thấy điều bạn cần?
            </h2>
            <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
                Đội ngũ hỗ trợ của chúng tôi phản hồi trong vòng một ngày làm việc.
            </p>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
            </div>
        </div>
    </section>

    <script>
        function resourcesFilters(articles) {
            return {
                articles,
                selectedCategory: null,

                get filteredIndices() {
                    const indices = [];
                    this.articles.forEach((a, i) => {
                        if (this.selectedCategory === null || a.category === this.selectedCategory) {
                            indices.push(i);
                        }
                    });
                    return indices;
                },

                get visibleCount() {
                    return this.filteredIndices.length;
                },

                isVisible(index) {
                    return this.filteredIndices.includes(index);
                },
            };
        }
    </script>
@endsection

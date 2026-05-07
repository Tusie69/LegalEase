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
            'image_url' => 'https://images.unsplash.com/photo-1515378960530-7c0da6231fb1?q=80',
        ],
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Chọn mức phí theo giờ đầu tiên của bạn',
            'desc'      => 'Kinh nghiệm, chuyên môn và vị trí sẽ định hình mức phí của bạn.',
            'read_time' => '4 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop&q=80',
        ],
        [
            'category'  => 'Phát triển hành nghề của bạn',
            'title'     => 'Ba cách để khách hàng quay lại tư vấn',
            'desc'      => 'Luật sư giàu kinh nghiệm làm gì trong buổi gặp đầu tiên để tạo dựng niềm tin.',
            'read_time' => '6 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80',
        ],
        [
            'category'  => 'Phát triển hành nghề của bạn',
            'title'     => 'Viết tiểu sử tạo dựng niềm tin',
            'desc'      => 'Chi tiết cụ thể, ngôn ngữ đơn giản và những gì cần bỏ qua.',
            'read_time' => '3 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1542435503-956c469947f6?q=80',
        ],
        [
            'category'  => 'Cập nhật nền tảng',
            'title'     => 'Quy trình xác minh đã thay đổi gì trong năm nay',
            'desc'      => 'Đánh giá nhanh hơn, kiểm tra tài liệu mới và những gì đội thẩm định tìm kiếm.',
            'read_time' => '4 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1624555130882-dcfa8ecb17ce?q=80',
        ],
        [
            'category'  => 'Thu nhập và thanh toán',
            'title'     => 'Cách giải ngân và thanh toán hoạt động',
            'desc'      => 'Nền tảng giữ phần nào, bạn nhận phần nào, và khi nào.',
            'read_time' => '5 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1633158829585-23ba8f7c8caf?q=80',
        ],
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

    {{-- Featured article --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Nổi bật</h2>

        <a href="#" class="mt-12 block group">
            <article class="grid gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $featured['image_url'] }}"
                         alt=""
                         loading="lazy"
                         class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]">
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

    {{-- All resources --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Tất cả tài nguyên</h2>

        <div class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
                <a href="#" class="group flex flex-col">
                    <div class="overflow-hidden rounded-xl">
                        <img src="{{ $article['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]">
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

    {{-- Closing CTA --}}
    <section class="container-page closing-cta">
        <h2 class="text-cta-h2">
            Không tìm thấy điều bạn cần?
        </h2>
        <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
            Đội ngũ hỗ trợ của chúng tôi phản hồi trong vòng một ngày làm việc.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
        </div>
    </section>
@endsection

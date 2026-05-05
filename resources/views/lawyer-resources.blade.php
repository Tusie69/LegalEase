@extends('layouts.app', ['title' => 'Tài nguyên · LegalEase'])

@php
    $featured = [
        'category'  => 'Kinh nghiệm phát triển nghề luật',
        'title'     => 'Các luật sư hàng đầu trên LegalEase lấp đầy lịch làm việc như thế nào',
        'lead'      => 'Khám phá cách các luật sư được đặt lịch nhiều nhất tối ưu lịch trống, thiết lập mức phí phù hợp và chuyển những buổi tư vấn đầu tiên thành khách hàng dài hạn.',
        'read_time' => '8 phút đọc',
        'image_url' => 'https://images.unsplash.com/photo-1758519291932-6263fc870e01?q=80',
    ];

    $articles = [
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Thiết lập hồ sơ chuyên nghiệp trong 30 phút',
            'desc'      => 'Hướng dẫn từng bước về tiểu sử, ảnh chân dung, chuyên môn và thiết lập khu vực hành nghề.',
            'read_time' => '5 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1515378960530-7c0da6231fb1?q=80',
        ],
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Định giá tư vấn theo giờ cho giai đoạn đầu',
            'desc'      => 'Kinh nghiệm, lĩnh vực chuyên môn và khu vực hành nghề ảnh hưởng đến mức phí ra sao.',
            'read_time' => '4 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop&q=80',
        ],
        [
            'category'  => 'Kinh nghiệm phát triển nghề luật',
            'title'     => 'Ba cách tăng tỷ lệ khách hàng quay lại tư vấn',
            'desc'      => 'Những việc luật sư giàu kinh nghiệm thực hiện trong buổi gặp đầu tiên để tạo niềm tin lâu dài.',
            'read_time' => '6 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80',
        ],
        [
            'category'  => 'Kinh nghiệm phát triển nghề luật',
            'title'     => 'Viết tiểu sử tạo dựng niềm tin ngay từ lần đọc đầu',
            'desc'      => 'Những chi tiết nên nhấn mạnh, ngôn từ nên dùng và các lỗi thường khiến hồ sơ kém thuyết phục.',
            'read_time' => '3 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1542435503-956c469947f6?q=80',
        ],
        [
            'category'  => 'Cập nhật nền tảng',
            'title'     => 'Những thay đổi mới trong quy trình xác minh năm nay',
            'desc'      => 'Đánh giá hồ sơ nhanh hơn, bổ sung kiểm tra tài liệu và tiêu chí cập nhật từ đội kiểm duyệt.',
            'read_time' => '4 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1624555130882-dcfa8ecb17ce?q=80',
        ],
        [
            'category'  => 'Thu nhập và thanh toán',
            'title'     => 'Quy trình đối soát và thanh toán cho luật sư',
            'desc'      => 'Nền tảng thu phần nào, bạn nhận phần nào và khi nào tiền được chuyển về tài khoản.',
            'read_time' => '5 phút đọc',
            'image_url' => 'https://images.unsplash.com/photo-1633158829585-23ba8f7c8caf?q=80',
        ],
    ];
@endphp

@section('content')
    <style>
        body > nav {
            background: #ffffff !important;
            backdrop-filter: none !important;
            border-bottom-color: rgba(15, 23, 42, 0.12) !important;
        }
    </style>

    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1755675672853-9108c92fbc14?q=80"
             alt="Thư viện luật"
             class="absolute inset-0 h-full w-full object-cover">

        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center text-white">
            <p class="text-[12px] font-semibold uppercase tracking-[0.12em] drop-shadow-xl">Tài nguyên</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[50px] font-medium leading-[1.05] tracking-[-0.02em] drop-shadow-xl md:text-[80px]">
                Nâng tầm sự nghiệp pháp lý.
            </h1>

            <div class="mt-10 flex justify-center">
                <a href="#bai-viet" class="inline-flex items-center rounded-full bg-[#0F2747] px-7 py-3 text-[15px] font-semibold text-white shadow-lg transition-colors hover:bg-[#12315a]">
                    Khám phá tài nguyên
                </a>
            </div>
        </div>
    </section>

    {{-- Featured article --}}
    <section id="bai-viet" class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Bài viết nổi bật</h2>

        <a href="#" class="group mt-12 block">
            <article class="grid gap-8 md:grid-cols-2 md:items-center md:gap-12">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $featured['image_url'] }}"
                         alt=""
                         loading="lazy"
                         class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]">
                </div>
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $featured['category'] }}</p>
                    <h2 class="mt-4 font-display text-[32px] font-medium leading-[1.1] tracking-[-0.02em] md:text-[40px] group-hover:text-accent">
                        {{ $featured['title'] }}
                    </h2>
                    <p class="mt-5 max-w-[520px] text-[16px] leading-relaxed text-secondary">
                        {{ $featured['lead'] }}
                    </p>
                    <p class="mt-6 inline-flex items-center gap-2 text-[14px] font-medium text-text">
                        {{ $featured['read_time'] }}
                        <span class="mx-1 text-muted/40">·</span>
                        <span class="transition-colors group-hover:text-accent">Đọc ngay →</span>
                    </p>
                </div>
            </article>
        </a>
    </section>

    {{-- All resources --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Tất cả tài nguyên</h2>

        <div class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
                <a href="#" class="group flex flex-col">
                    <div class="overflow-hidden rounded-xl">
                        <img src="{{ $article['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]">
                    </div>
                    <p class="mt-5 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $article['category'] }}</p>
                    <h3 class="mt-2 font-display text-[24px] font-medium leading-tight tracking-tight transition-colors group-hover:text-accent">
                        {{ $article['title'] }}
                    </h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                        {{ $article['desc'] }}
                    </p>
                    <p class="mt-4 text-[13px] text-muted">{{ $article['read_time'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pb-24 pt-32 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Chưa thấy nội dung bạn cần?
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            Đội ngũ hỗ trợ của chúng tôi phản hồi trong vòng một ngày làm việc.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
        </div>
    </section>
@endsection

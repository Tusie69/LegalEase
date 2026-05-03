@extends('layouts.app', ['title' => 'Tài nguyên · LegalEase'])

@php
    $featured = [
        'category'  => 'Phát triển thực hành của bạn',
        'title'     => 'Các luật sư hàng đầu trên LegalEase lấp đầy tuần của họ như thế nào',
        'lead'      => 'Hãy xem cách các luật sư được đặt nhiều nhất trên nền tảng sắp xếp tính khả dụng của họ, đặt ra mức giá và biến những cuộc tư vấn đầu tiên thành khách hàng lâu dài.',
        'read_time' => 'Đọc trong 8 phút',
        'image_url' => 'https://images.unsplash.com/photo-1758519291932-6263fc870e01?q=80',
    ];

    $articles = [
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Thiết lập hồ sơ của bạn trong 30 phút',
            'desc'      => 'Hướng dẫn chi tiết về tiểu sử, hình ảnh, chuyên môn và cấu hình vị trí.',
            'read_time' => 'Đọc trong 5 phút',
            'image_url' => 'https://images.unsplash.com/photo-1515378960530-7c0da6231fb1?q=80',
        ],
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Chọn mức lương theo giờ đầu tiên của bạn',
            'desc'      => 'Kinh nghiệm, chuyên môn và vị trí sẽ định hình mức phí bạn tính như thế nào.',
            'read_time' => 'Đọc trong 4 phút',
            'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop&q=80',
        ],
        [
            'category'  => 'Phát triển thực hành của bạn',
            'title'     => 'Ba cách để khuyến khích tham vấn lặp lại',
            'desc'      => 'Luật sư giàu kinh nghiệm làm gì trong buổi gặp đầu tiên để tạo dựng niềm tin',
            'read_time' => 'Đọc trong 6 phút',
            'image_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80',
        ],
        [
            'category'  => 'Phát triển thực hành của bạn',
            'title'     => 'Viết tiểu sử tạo dựng niềm tin',
            'desc'      => 'Chi tiết cụ thể, ngôn ngữ đơn giản và những gì cần bỏ qua.',
            'read_time' => 'Đọc trong 3 phút',
            'image_url' => 'https://images.unsplash.com/photo-1542435503-956c469947f6?q=80',
        ],
        [
            'category'  => 'Cập nhật nền tảng',
            'title'     => 'Điều gì đã thay đổi trong quy trình xác minh của chúng tôi trong năm nay',
            'desc'      => 'Đánh giá nhanh hơn, kiểm tra tài liệu mới và những gì người đánh giá tìm kiếm.',
            'read_time' => 'Đọc trong 4 phút',
            'image_url' => 'https://images.unsplash.com/photo-1624555130882-dcfa8ecb17ce?q=80',
        ],
        [
            'category'  => 'Thu nhập và thanh toán',
            'title'     => 'Cách thức gửi tiền và thanh toán',
            'desc'      => 'Nền tảng chứa đựng những gì, những gì sẽ đến với bạn và khi nào.',
            'read_time' => 'Đọc trong 5 phút',
            'image_url' => 'https://images.unsplash.com/photo-1633158829585-23ba8f7c8caf?q=80',
        ],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1755675672853-9108c92fbc14?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Tài nguyên</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Vận hành hoạt động hành nghề hiệu quả hơn.
            </h1>
        </div>
    </section>

    {{-- Featured article --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Nổi bật</h2>

        <a href="#" class="mt-12 block group">
            <article class="grid gap-8 md:grid-cols-2 md:items-center md:gap-12">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $featured['image_url'] }}"
                         alt=""
                         loading="lazy"
                         class="aspect-[4/3] w-full object-cover grayscale transition-transform duration-500 group-hover:scale-[1.02]">
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
                        <span class="transition-colors group-hover:text-accent">Đọc →</span>
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
                             class="aspect-[4/3] w-full object-cover grayscale transition-transform duration-500 group-hover:scale-[1.02]">
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
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Chưa tìm thấy nội dung bạn cần?
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            Đội ngũ hỗ trợ của chúng tôi phản hồi trong vòng một ngày làm việc.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
        </div>
    </section>
@endsection

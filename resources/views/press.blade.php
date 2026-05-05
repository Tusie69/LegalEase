@extends('layouts.app', ['title' => 'Báo chí · LegalEase'])

@php
    $coverage = [
        [
            'publication' => 'Forbes Việt Nam',
            'date'        => 'Ngày 28 tháng 3 năm 2026',
            'headline'    => 'Ba luật sư bước vào trong tâm trạng thất vọng. Họ đã xây dựng một khu chợ.',
            'url'         => '#',
        ],
        [
            'publication' => 'VnExpress',
            'date'        => 'Ngày 12 tháng 3 năm 2026',
            'headline'    => 'LegalEase đặt cược vào tư vấn luật minh bạch tại Việt Nam',
            'url'         => '#',
        ],
        [
            'publication' => 'Vietcetera',
            'date'        => 'Ngày 14 tháng 2 năm 2026',
            'headline'    => 'LegalEase đang tách rời hoạt động pháp lý của Việt Nam như thế nào',
            'url'         => '#',
        ],
        [
            'publication' => 'Tuổi Trẻ',
            'date'        => 'Ngày 5 tháng 2 năm 2026',
            'headline'    => 'Hà Nội startup mở cửa cho hơn 500 luật sư',
            'url'         => '#',
        ],
        [
            'publication' => 'Công nghệ ở Châu Á',
            'date'        => 'Ngày 22 tháng 1 năm 2026',
            'headline'    => "Vietnam's legal-tech wave finds its first consumer brand",
            'url'         => '#',
        ],
        [
            'publication' => 'Thời báo Sài Gòn',
            'date'        => 'Ngày 18 tháng 12 năm 2025',
            'headline'    => "Booking a lawyer used to mean asking around. Now there's an app.",
            'url'         => '#',
        ],
        [
            'publication' => 'e27',
            'date'        => 'Ngày 30 tháng 11 năm 2025',
            'headline'    => "Inside LegalEase's seed round and the team behind it",
            'url'         => '#',
        ],
        [
            'publication' => 'Tin tức CNTT',
            'date'        => 'Ngày 14 tháng 10 năm 2025',
            'headline'    => 'Khởi nghiệp công nghệ pháp lý: LegalEase đi đường dài',
            'url'         => '#',
        ],
    ];

    $contact = [
        'name'  => 'Đỗ Thị Lan',
        'role'  => 'Đồng sáng lập, CEO',
        'email' => 'press@legalease.vn',
    ];
@endphp

@section('content')
    {{-- Hero: photo top, navy bar bottom --}}
    <section class="relative -mt-[72px] flex min-h-screen flex-col overflow-hidden">
        <div class="relative flex-1 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=2000&h=1200&fit=crop&q=80"
                 alt=""
                 class="absolute inset-0 h-full w-full object-cover">
        </div>

        <div class="bg-accent">
            <div class="mx-auto w-full max-w-[1280px] px-8 py-14 text-center md:py-20">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-white/65">Báo chí</p>
                <h1 class="mx-auto mt-5 max-w-[920px] font-display text-[44px] font-medium leading-[1.1] tracking-[-0.02em] text-white md:text-[64px]">
                    Mọi người đang nói gì.
                </h1>
                <p class="mx-auto mt-5 max-w-[560px] text-[17px] leading-relaxed text-white/80">
                    Báo chí, podcast và phỏng vấn về cách chúng tôi xây dựng tầng pháp lý cho Việt Nam.
                </p>
            </div>
        </div>
    </section>

    {{-- 01 / In the news --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Trong tin tức</h2>
        </div>

        <div class="mt-12">
            @foreach ($coverage as $i => $item)
                <article class="grid grid-cols-1 gap-4 border-b border-text/10 py-16 first:pt-0 last:border-b-0 md:grid-cols-[1fr_auto] md:items-center md:gap-12">
                    <div>
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                            {{ $item['publication'] }}
                        </p>
                        <h3 class="mt-3 max-w-[760px] font-display text-[24px] font-medium leading-tight tracking-[-0.01em] md:text-[28px]">
                            {{ $item['headline'] }}
                        </h3>
                        <p class="mt-3 text-[13px] text-muted">{{ $item['date'] }}</p>
                    </div>
                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary md:justify-self-end">
                        Đọc
                        <span aria-hidden="true">→</span>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 02 / For journalists --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Dành cho nhà báo</h2>
        </div>

        <div class="mt-12 grid gap-12 md:grid-cols-2 md:gap-20">
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thông tin liên hệ</p>
                <p class="mt-5 font-display text-[26px] font-medium tracking-tight md:text-[28px]">
                    {{ $contact['name'] }}
                </p>
                <p class="mt-1 text-[14px] text-muted">{{ $contact['role'] }}</p>
                <a href="mailto:{{ $contact['email'] }}"
                   class="mt-5 inline-flex items-center gap-2 text-[15px] text-text transition-colors hover:text-secondary">
                    {{ $contact['email'] }}
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Giới thiệu</p>
                <div class="mt-5 space-y-4 text-[15px] leading-relaxed text-secondary">
                    <p>
                        LegalEase là nền tảng đã được xác minh cho các tư vấn pháp lý tại Việt Nam. Được thành lập tại Hà Nội vào năm 2024, chúng tôi kết nối cá nhân và doanh nghiệp với hơn 500 luật sư đã được kiểm duyệt tại 12 thành phố.
                    </p>
                    <p>
                    Mọi thông tin xác thực của luật sư đều được xem xét trước khi đăng ký. Mức giá theo giờ được công khai. Không phí giới thiệu, không xếp hạng trả phí.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

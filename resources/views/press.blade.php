@extends('layouts.app', ['title' => 'Tin tức · LegalEase'])

@php
    $coverage = [
        [
            'publication' => 'Forbes Vietnam',
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
            'publication' => 'Tech in Asia',
            'date'        => 'Ngày 22 tháng 1 năm 2026',
            'headline'    => 'Làn sóng công nghệ pháp lý Việt Nam tìm thấy thương hiệu tiêu dùng đầu tiên',
            'url'         => '#',
        ],
        [
            'publication' => 'Saigon Times',
            'date'        => 'Ngày 18 tháng 12 năm 2025',
            'headline'    => 'Đặt lịch luật sư từng phải hỏi quanh người quen. Giờ đã có một ứng dụng.',
            'url'         => '#',
        ],
        [
            'publication' => 'e27',
            'date'        => 'Ngày 30 tháng 11 năm 2025',
            'headline'    => 'Bên trong vòng gọi vốn hạt giống của LegalEase và đội ngũ đứng sau',
            'url'         => '#',
        ],
        [
            'publication' => 'ICTNews',
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
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=2000&h=1200&fit=crop&q=80"
        eyebrow="Tin tức">
        Mọi người đang nói gì.

        <x-slot:subtitle>
            Báo chí, podcast và phỏng vấn về cách chúng tôi xây dựng tầng pháp lý cho Việt Nam.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- 01 / In the news --}}
    <section class="container-page pt-24">
        <div class="flex items-baseline gap-5">
            <p class="text-chapter-marker">01</p>
            <h2 class="text-chapter-h2">Tin tức mới</h2>
        </div>

        <div class="mt-12">
            @foreach ($coverage as $item)
                <article class="grid grid-cols-1 gap-4 border-b border-text/20 py-10 first:pt-0 last:border-b-0 last:pb-0 md:grid-cols-[1fr_auto] md:items-center md:gap-12 md:py-16">
                    <div>
                        <p class="text-eyebrow">{{ $item['publication'] }}</p>
                        <h3 class="text-role-h3 mt-3 max-w-[760px] leading-snug">
                            {{ $item['headline'] }}
                        </h3>
                        <p class="text-caption mt-3">{{ $item['date'] }}</p>
                    </div>
                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                       class="text-link-action inline-flex items-center gap-2 text-text transition-colors hover:text-text/70 md:justify-self-end">
                        Đọc
                        <span aria-hidden="true">→</span>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 02 / For journalists --}}
    <section class="container-page pt-24 pb-24">
        <div class="flex items-baseline gap-5">
            <p class="text-chapter-marker">02</p>
            <h2 class="text-chapter-h2">Dành cho nhà báo</h2>
        </div>

        <div class="mt-12 grid gap-12 md:grid-cols-2 md:gap-20">
            <div>
                <p class="text-eyebrow">Thông tin liên hệ</p>
                <p class="text-role-h3 mt-5">{{ $contact['name'] }}</p>
                <p class="mt-1 text-[14px]">{{ $contact['role'] }}</p>
                <a href="mailto:{{ $contact['email'] }}"
                   class="text-body mt-5 inline-flex items-center gap-2 text-text transition-colors hover:text-text/70">
                    {{ $contact['email'] }}
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div>
                <p class="text-eyebrow">Giới thiệu</p>
                <div class="mt-5 space-y-4">
                    <p class="text-body">
                        LegalEase là nền tảng đã được xác minh cho các tư vấn pháp lý tại Việt Nam. Được thành lập tại Hà Nội vào năm 2024, chúng tôi kết nối cá nhân và doanh nghiệp với hơn 500 luật sư đã được kiểm duyệt tại 12 thành phố.
                    </p>
                    <p class="text-body">
                        Mọi thông tin xác thực của luật sư đều được xem xét trước khi đăng ký. Mức giá theo giờ được công khai. Không phí giới thiệu, không xếp hạng trả phí.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

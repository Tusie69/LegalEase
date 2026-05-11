@extends('layouts.app')

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $featuredLawyers = \App\Data\Lawyers::featured(3);
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative -mt-18 flex min-h-screen flex-col overflow-hidden bg-text">
        <x-responsive-img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab"
                          alt=""
                          loading="eager"
                          sizes="100vw"
                          :widths="[600, 900, 1200, 1600]"
                          class="absolute inset-0 h-full w-full object-cover" />

        <div aria-hidden="true"
             class="absolute inset-0 bg-gradient-to-r from-text/85 via-text/65 to-text/35"></div>

        <div class="container-page relative flex flex-1 items-center pt-32 pb-24">
            <div class="max-w-[760px]">
                <p class="text-eyebrow-hero text-gold">
                    Tư vấn pháp lý uy tín
                </p>

                <h1 class="text-hero mt-6 text-bg">
                    Tìm đúng luật sư, cho thời điểm quan trọng nhất.
                </h1>

                <p class="text-body-intro mt-6 max-w-xl text-bg/80">
                    Chi phí minh bạch. Chứng chỉ đã xác minh. Lịch trống theo thời gian thực. Kết nối với những chuyên gia pháp lý uy tín tại Việt Nam theo cách của bạn.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-button variant="gold" href="/lawyers">Duyệt luật sư →</x-button>
                    <x-button variant="on-dark-ghost" href="#how-it-works">Cách hoạt động</x-button>
                </div>
            </div>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="bg-accent">
        <div class="container-page flex items-center justify-center md:h-24">
            <div class="grid w-full grid-cols-1 divide-y divide-gold/40 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat text-gold">500+</p>
                    <p class="text-body mt-2 text-bg/80">Luật sư đã được xác minh</p>
                </div>
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat text-gold">4.8</p>
                    <p class="text-body mt-2 text-bg/80">Đánh giá trung bình</p>
                </div>
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat text-gold">10,000+</p>
                    <p class="text-body mt-2 text-bg/80">Buổi tư vấn đã hoàn tất</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Practice areas --}}
    <section class="container-page pt-24">
        <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between lg:gap-8">
            <h2 class="text-section-h2">Các lĩnh vực chúng tôi đảm nhiệm</h2>
            <x-button variant="ghost" href="/legal-services">Xem tất cả lĩnh vực →</x-button>
        </div>

        <div class="mt-12 grid gap-x-6 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                <div>
                    <div class="overflow-hidden rounded-2xl">
                        <x-responsive-img :src="$area['image_url']"
                                          alt=""
                                          sizes="(min-width: 1024px) 33vw, (min-width: 768px) 50vw, 100vw"
                                          :widths="[400, 600, 900, 1200]"
                                          class="aspect-[4/3] w-full object-cover" />
                    </div>
                    <h3 class="text-card-h3 mt-6">{{ $area['name'] }}</h3>
                    <p class="text-body-dense mt-2">{{ $area['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Featured lawyers --}}
    <section class="container-page pt-24">
        <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between lg:gap-8">
            <h2 class="text-section-h2">Luật sư tiêu biểu</h2>
            <x-button variant="ghost" href="/lawyers">Xem tất cả luật sư →</x-button>
        </div>

        <div class="mt-12 flex flex-wrap gap-6">
            @foreach ($featuredLawyers as $lawyer)
                <div class="w-full lg:w-[calc(33.333%-1rem)]">
                    <x-lawyer-card :lawyer="$lawyer" class="h-full" />
                </div>
            @endforeach
        </div>
    </section>

    {{-- How it works --}}
    <section id="how-it-works" class="container-page pt-24">
        <h2 class="text-section-h2">Cách hoạt động</h2>

        @php
            $steps = [
                ['n' => '01', 'title' => 'Tìm kiếm', 'text' => 'Cho chúng tôi biết lĩnh vực pháp lý và thời gian bạn mong muốn.'],
                ['n' => '02', 'title' => 'Lựa chọn', 'text' => 'Xem hồ sơ, đánh giá và lịch trống theo thời gian thực.'],
                ['n' => '03', 'title' => 'Tư vấn', 'text' => 'Xác nhận buổi tư vấn 60 phút của bạn.'],
            ];
        @endphp

        <div class="relative mt-12 grid divide-y divide-text/15 md:grid-cols-3 md:gap-12 md:divide-y-0">
            {{-- Ground line --}}
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 hidden h-px bg-text/15 md:block md:top-20 lg:top-24"></div>

            @foreach ($steps as $step)
                <div class="py-10 first:pt-0 last:pb-0 md:py-0">
                    <p class="display-stat-feature text-accent">{{ $step['n'] }}</p>
                    <h3 class="text-card-h3 mt-8">{{ $step['title'] }}</h3>
                    <p class="text-body mt-4 max-w-sm">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    @php
        $faqPreview = [
            [
                'q' => 'Khoản đặt cọc là gì?',
                'a' => 'Khi bạn xác nhận đặt chỗ, chúng tôi giữ 20% phí tư vấn làm khoản đặt cọc. 80% còn lại được thanh toán trực tiếp cho luật sư tại buổi tư vấn.',
            ],
            [
                'q' => 'Luật sư được xác minh như thế nào?',
                'a' => 'Mọi luật sư trên nền tảng đều được đội ngũ của chúng tôi kiểm tra tư cách thành viên đoàn luật sư và chứng chỉ trước khi được đăng. Chúng tôi xác minh lại theo định kỳ.',
            ],
        ];
    @endphp

    <section class="container-page pt-24 pb-20 md:pt-32 md:pb-24">
        <div class="grid items-start gap-12 lg:grid-cols-[5fr_7fr] lg:gap-16">
            <div>
                <h2 class="text-section-h2">Câu hỏi thường gặp</h2>
                <p class="text-body-prose mt-6 max-w-[420px]">
                    Trước khi đặt chỗ, đây là những câu hỏi phổ biến nhất từ người dùng.
                </p>
                <a href="{{ route('faq') }}"
                   class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                    Xem tất cả câu hỏi
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div>
                @foreach ($faqPreview as $item)
                    <div class="border-t border-text/15 py-8 last:pb-0">
                        <h3 class="text-card-h4">{{ $item['q'] }}</h3>
                        <p class="text-body mt-4 max-w-[640px]">{{ $item['a'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

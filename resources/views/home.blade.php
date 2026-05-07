@extends('layouts.app')

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $featuredLawyers = \App\Data\Lawyers::featured(3);
@endphp

@section('content')
    {{-- Hero --}}
    <section class="container-page relative py-24 lg:py-32">
        <div class="grid w-full items-center gap-12 lg:grid-cols-5">
            <div class="lg:col-span-3">
                <p class="text-eyebrow">
                    Tư vấn pháp lý uy tín
                </p>

                <h1 class="text-hero mt-6">
                    Tìm đúng luật sư, cho thời điểm quan trọng nhất.
                </h1>

                <p class="text-body-intro mt-6 max-w-xl">
                    Chi phí minh bạch. Chứng chỉ đã xác minh. Lịch trống theo thời gian thực. Kết nối với những chuyên gia pháp lý uy tín tại Việt Nam theo cách của bạn.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-button variant="primary" href="/lawyers">Duyệt luật sư →</x-button>
                    <x-button variant="ghost" href="#how-it-works">Cách hoạt động</x-button>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="relative">
                    <div aria-hidden="true"
                         class="pointer-events-none absolute -inset-10 rounded-full bg-gradient-to-br from-text to-accent opacity-10 blur-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1758518727600-2c5f48419eac?q=80"
                         alt=""
                         class="relative aspect-[4/3] w-full rounded-2xl object-cover lg:aspect-[3/4]">
                </div>
            </div>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="border-y border-text/20">
        <div class="container-page flex items-center justify-center md:h-24">
            <div class="grid w-full grid-cols-1 divide-y divide-text/20 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat">500+</p>
                    <p class="text-body mt-2">Luật sư đã được xác minh</p>
                </div>
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat">4.8</p>
                    <p class="text-body mt-2">Đánh giá trung bình</p>
                </div>
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat">10,000+</p>
                    <p class="text-body mt-2">Buổi tư vấn đã hoàn tất</p>
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

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                <div class="card-base-lg">
                    <x-icon :name="$area['icon']" :size="32" class="text-accent" />
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
    <section id="how-it-works" class="container-page py-24">
        <h2 class="text-section-h2">Cách hoạt động</h2>

        @php
            $steps = [
                ['n' => '01', 'title' => 'Tìm kiếm', 'text' => 'Cho chúng tôi biết lĩnh vực pháp lý và thời gian bạn mong muốn.'],
                ['n' => '02', 'title' => 'Lựa chọn', 'text' => 'Xem hồ sơ, đánh giá và lịch trống theo thời gian thực.'],
                ['n' => '03', 'title' => 'Tư vấn', 'text' => 'Xác nhận buổi tư vấn 60 phút của bạn.'],
            ];
        @endphp

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($steps as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="text-card-h3 mt-6">{{ $step['title'] }}</h3>
                    <p class="text-body mt-2 max-w-sm">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@extends('layouts.app')

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $featuredLawyers = \App\Data\Lawyers::featured(3);
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative mx-auto flex min-h-[85vh] max-w-[1280px] items-center px-8 py-20">
        <div class="grid w-full items-center gap-12 md:grid-cols-5">
            <div class="md:col-span-3">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                    Tư vấn pháp lý uy tín
                </p>

                <h1 class="mt-6 font-display text-[64px] font-medium leading-[1.02] tracking-[-0.03em] md:text-[80px]">
                    Tìm đúng luật sư, cho thời điểm quan trọng nhất.
                </h1>

                <p class="mt-6 max-w-xl text-[18px] leading-relaxed text-secondary">
                    Chi phí minh bạch. Chứng chỉ đã xác minh. Lịch trống theo thời gian thực. Kết nối với những chuyên gia pháp lý uy tín tại Việt Nam theo cách của bạn.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-button variant="primary" href="/lawyers">Đặt lịch →</x-button>
                    <x-button variant="ghost" href="#how-it-works">Hướng dẫn đặt lịch</x-button>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="relative">
                    <div aria-hidden="true"
                         class="pointer-events-none absolute -inset-10 rounded-full bg-gradient-to-br from-muted to-accent opacity-15 blur-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1758518727600-2c5f48419eac?q=80"
                         alt=""
                         class="relative aspect-[3/4] w-full rounded-2xl object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="bg-surface">
        <div class="mx-auto flex h-24 max-w-[1280px] items-center justify-center px-8">
            <div class="grid w-full grid-cols-1 divide-y divide-text/10 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">500+</p>
                    <p class="mt-2 text-[15px] text-secondary">Luật sư đã được xác minh</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">4.8</p>
                    <p class="mt-2 text-[15px] text-secondary">Đánh giá trung bình</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">10,000+</p>
                    <p class="mt-2 text-[15px] text-secondary">Buổi tư vấn đã hoàn tất</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Practice areas --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Các lĩnh vực chúng tôi đảm nhiệm</h2>
            <x-button variant="ghost" href="/legal-services">Xem tất cả lĩnh vực →</x-button>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                @php
                    $areaIcon = $area['icon'] ?? ($area['scenarios'][0]['icon'] ?? 'scale');
                @endphp
                <div class="rounded-2xl border border-text/10 bg-surface p-8">
                    <x-icon :name="$areaIcon" :size="32" class="text-accent" />
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $area['name'] }}</h3>
                    <p class="mt-2 text-[14px] text-muted">{{ $area['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Featured lawyers --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Luật sư tiêu biểu</h2>
            <x-button variant="ghost" href="/lawyers">Xem tất cả luật sư →</x-button>
        </div>

        <div class="mt-12 flex flex-wrap gap-6">
            @foreach ($featuredLawyers as $lawyer)
                <div class="w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]">
                    <x-lawyer-card :lawyer="$lawyer" class="h-full" />
                </div>
            @endforeach
        </div>
    </section>

    {{-- How it works --}}
    <section id="how-it-works" class="mx-auto max-w-[1280px] px-8 py-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Cách hoạt động</h2>

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
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Nghề nghiệp · LegalEase'])

@php
    $values = [
        ['title' => 'Định hướng theo sứ mệnh',  'desc' => 'Công việc đến tay người dùng trong tuần này.'],
        ['title' => 'Trụ sở tại Hà Nội', 'desc' => 'Ba ngày tại văn phòng, hai ngày làm việc từ xa.'],
        ['title' => 'Tác động thực sự',     'desc' => 'Đội ngũ nhỏ. Công việc của bạn được ra mắt nhanh.'],
        ['title' => 'Ngân sách học tập', 'desc' => 'Ngân sách hằng năm cho những gì giúp bạn nâng cao kỹ năng.'],
    ];

    $roles = [
        [
            'title'     => 'Kỹ sư phụ trợ cao cấp',
            'meta'      => 'Kỹ thuật · Hà Nội · Toàn thời gian',
            'desc'      => 'Laravel và MySQL. Mở rộng nền tảng đang vận hành hơn 500 hồ sơ luật sư.',
            'salary'    => '50-80M',
            'image_url' => 'https://images.unsplash.com/photo-1631624222568-6619ce21a683?q=80',
        ],
        [
            'title'     => 'Nhà thiết kế sản phẩm',
            'meta'      => 'Sản phẩm · Hà Nội · Toàn thời gian',
            'desc'      => 'Dẫn dắt hành trình của khách hàng từ tìm kiếm đến tư vấn.',
            'salary'    => '40-65M',
            'image_url' => 'https://images.unsplash.com/photo-1600697394936-59934aa5951f?q=80',
        ],
        [
            'title'     => 'Chuyên gia xác minh luật sư',
            'meta'      => 'Hoạt động · Hà Nội · Toàn thời gian',
            'desc'      => 'Thẩm định mọi luật sư trước khi đưa hồ sơ lên nền tảng. Ưu tiên ứng viên có nền tảng pháp lý.',
            'salary'    => '25-40M',
            'image_url' => 'https://images.unsplash.com/photo-1688828792704-4218151b5d97?q=80',
        ],
        [
            'title'     => 'Trưởng nhóm vận hành khách hàng',
            'meta'      => 'Hoạt động · Hà Nội hoặc Thành phố Hồ Chí Minh · Toàn thời gian',
            'desc'      => 'Người tiếp nhận đầu tiên cho khách hàng. Xây dựng quy trình hỗ trợ có khả năng mở rộng.',
            'salary'    => '30-45M',
            'image_url' => 'https://images.unsplash.com/photo-1554774853-719586f82d77?q=80',
        ],
        [
            'title'     => 'Giám đốc tiếp thị',
            'meta'      => 'Tiếp thị · Hà Nội · Toàn thời gian',
            'desc'      => 'Thương hiệu, nội dung và tăng trưởng trên toàn Việt Nam.',
            'salary'    => '35-55M',
            'image_url' => 'https://images.unsplash.com/photo-1758873268131-a2636b120d81?q=80',
        ],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Ứng tuyển',           'desc' => 'Không cần thư xin việc.'],
        ['n' => '02', 'title' => 'Hai vòng phỏng vấn',  'desc' => 'Quản lý tuyển dụng, sau đó là đội ngũ.'],
        ['n' => '03', 'title' => 'Quyết định',          'desc' => 'Trong vòng mười ngày.'],
    ];
@endphp

@section('content')
    {{-- Hero: photo top, navy bar bottom --}}
    <section class="relative -mt-[72px] flex min-h-screen flex-col overflow-hidden">
        <div class="relative flex-1 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80"
                 alt=""
                 class="absolute inset-0 h-full w-full object-cover">
        </div>

        <div class="bg-accent">
            <div class="mx-auto w-full max-w-[1280px] px-8 py-14 text-center md:py-20">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-white/65">Chúng tôi đang tuyển dụng</p>
                <h1 class="mx-auto mt-5 max-w-[920px] font-display text-[44px] font-medium leading-[1.1] tracking-[-0.02em] text-white md:text-[64px]">
                    Xây dựng nền tảng pháp lý cho Việt Nam.
                </h1>
                <p class="mx-auto mt-5 max-w-[560px] text-[17px] leading-relaxed text-white/80">
                    Một đội ngũ nhỏ ở Hà Nội đang xây dựng tầng pháp lý cho người dân Việt Nam.
                </p>
            </div>
        </div>
    </section>

    {{-- 01 / What it's like --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Nó như thế nào</h2>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[24px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 02 / Open positions --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Open positions</h2>
        </div>

        <div class="mt-12">
            @foreach ($roles as $i => $role)
                <article class="{{ $i > 0 ? 'pt-20' : '' }} grid grid-cols-1 gap-6 md:grid-cols-[100px_1fr_auto] md:gap-10">
                    {{-- Role image --}}
                    <div class="aspect-square w-[100px] overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $role['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="h-full w-full object-cover object-top">
                    </div>

                    {{-- Title, meta, description --}}
                    <div>
                        <h3 class="font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[30px]">
                            {{ $role['title'] }}
                        </h3>
                        <p class="mt-2 text-[12px] uppercase tracking-[0.1em] text-muted">
                            {{ $role['meta'] }}
                        </p>
                        <p class="mt-4 max-w-[560px] text-[15px] leading-relaxed text-secondary">
                            {{ $role['desc'] }}
                        </p>
                    </div>

                    {{-- Salary --}}
                    <div class="md:text-right">
                        <p class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                            {{ $role['salary'] }}
                        </p>
                        <p class="mt-1 text-[12px] uppercase tracking-[0.1em] text-muted">
                            VND / tháng
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 03 / How we hire --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">03</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Chúng tôi tuyển dụng như thế nào</h2>
        </div>

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($hiring as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Sẵn sàng ứng tuyển?
        </h2>
        <div class="mt-8 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Liên hệ →</x-button>
        </div>
    </section>
@endsection

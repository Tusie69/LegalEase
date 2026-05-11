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
        ],
        [
            'title'     => 'Nhà thiết kế sản phẩm',
            'meta'      => 'Sản phẩm · Hà Nội · Toàn thời gian',
            'desc'      => 'Dẫn dắt hành trình của khách hàng từ tìm kiếm đến tư vấn.',
            'salary'    => '40-65M',
        ],
        [
            'title'     => 'Chuyên gia xác minh luật sư',
            'meta'      => 'Hoạt động · Hà Nội · Toàn thời gian',
            'desc'      => 'Thẩm định mọi luật sư trước khi đưa hồ sơ lên nền tảng. Ưu tiên ứng viên có nền tảng pháp lý.',
            'salary'    => '25-40M',
        ],
        [
            'title'     => 'Trưởng nhóm vận hành khách hàng',
            'meta'      => 'Hoạt động · Hà Nội hoặc Thành phố Hồ Chí Minh · Toàn thời gian',
            'desc'      => 'Người tiếp nhận đầu tiên cho khách hàng. Xây dựng quy trình hỗ trợ có khả năng mở rộng.',
            'salary'    => '30-45M',
        ],
        [
            'title'     => 'Giám đốc tiếp thị',
            'meta'      => 'Tiếp thị · Hà Nội · Toàn thời gian',
            'desc'      => 'Thương hiệu, nội dung và tăng trưởng trên toàn Việt Nam.',
            'salary'    => '35-55M',
        ],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Ứng tuyển',           'desc' => 'Không cần thư xin việc.'],
        ['n' => '02', 'title' => 'Hai vòng phỏng vấn',  'desc' => 'Quản lý tuyển dụng, sau đó là đội ngũ.'],
        ['n' => '03', 'title' => 'Quyết định',          'desc' => 'Trong vòng mười ngày.'],
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80"
        eyebrow="Chúng tôi đang tuyển dụng">
        Xây dựng nền tảng pháp lý cho Việt Nam.

        <x-slot:subtitle>
            Một đội ngũ nhỏ ở Hà Nội đang xây dựng tầng pháp lý cho người dân Việt Nam.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- What it's like --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Thông tin bạn cần biết</h2>

        <div class="mt-12 grid gap-x-16 gap-y-12 md:grid-cols-2">
            @foreach ($values as $v)
                <div class="border-t border-text/15 pt-6">
                    <h3 class="text-card-h3">{{ $v['title'] }}</h3>
                    <p class="text-body-dense mt-3">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Open positions --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Vị trí tuyển dụng</h2>

        <div class="mt-12 divide-y divide-text/15">
            @foreach ($roles as $role)
                <article class="grid grid-cols-1 gap-6 py-10 first:pt-0 last:pb-0 md:grid-cols-[1fr_auto] md:gap-10">
                    {{-- Title, meta, description --}}
                    <div>
                        <h3 class="text-role-h3 leading-snug">
                            {{ $role['title'] }}
                        </h3>
                        <p class="text-eyebrow mt-2">
                            {{ $role['meta'] }}
                        </p>
                        <p class="text-body mt-4 max-w-[560px]">
                            {{ $role['desc'] }}
                        </p>
                    </div>

                    {{-- Salary --}}
                    <div class="md:text-right">
                        <p class="text-chapter-h2">
                            {{ $role['salary'] }}
                        </p>
                        <p class="text-eyebrow mt-1">
                            VND / tháng
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- How we hire --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Chúng tôi tuyển dụng như thế nào?</h2>

        <div class="relative mt-12 grid divide-y divide-text/15 md:grid-cols-3 md:gap-12 md:divide-y-0">
            {{-- Ground line --}}
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 hidden h-px bg-text/15 md:block md:top-20 lg:top-24"></div>

            @foreach ($hiring as $step)
                <div class="py-10 first:pt-0 last:pb-0 md:py-0">
                    <p class="display-stat-feature text-accent">{{ $step['n'] }}</p>
                    <h3 class="text-card-h3 mt-8">{{ $step['title'] }}</h3>
                    <p class="text-body mt-4 max-w-sm">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="bg-gold/5 mt-24 md:mt-32">
        <div class="container-page closing-cta">
            <h2 class="text-cta-h2">
                Sẵn sàng ứng tuyển?
            </h2>
            <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
                Không cần thư xin việc. Hai vòng phỏng vấn ngắn gọn, quyết định trong vòng mười ngày.
            </p>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="{{ route('contact') }}">Liên hệ →</x-button>
            </div>
        </div>
    </section>
@endsection

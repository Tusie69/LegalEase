@extends('layouts.app', ['title' => 'Dành cho luật sư · LegalEase'])

@php
    $valueProps = [
        [
            'title' => 'Chỉ khách hàng đã được xác minh',
            'desc'  => 'Mọi khách hàng đều được xem xét trước khi họ có thể đặt chỗ. Không có thư rác, không lãng phí thời gian.',
        ],
        [
            'title' => 'Tự đặt mức phí',
            'desc'  => 'Bạn tự đặt mức phí theo giờ. Chúng tôi không thu phần trăm từ phí tư vấn của bạn.',
        ],
        [
            'title' => 'Lịch trống theo thời gian thực',
            'desc'  => 'Quản lý lịch trống từ một nơi. Khách hàng chỉ thấy khung giờ bạn mở.',
        ],
        [
            'title' => 'Không ràng buộc độc quyền',
            'desc'  => 'Tham gia LegalEase song song với hoạt động hiện tại. Không yêu cầu số lượng tối thiểu.',
        ],
    ];

    $steps = [
        [
            'n'     => '01',
            'title' => 'Ứng tuyển',
            'desc'  => 'Gửi thông tin xác thực và thông tin cơ bản của bạn.',
        ],
        [
            'n'     => '02',
            'title' => 'Xác minh',
            'desc'  => 'Nhóm của chúng tôi xem xét và phê duyệt trong vòng vài ngày làm việc.',
        ],
        [
            'n'     => '03',
            'title' => 'Đăng ký và kiếm tiền',
            'desc'  => 'Mở khung giờ, đặt phí và bắt đầu nhận đặt chỗ.',
        ],
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1589994965851-a8f479c573a9?q=80"
        eyebrow="Dành cho luật sư">
        Phát triển hành nghề của bạn cùng LegalEase.

        <x-slot:subtitle>
            Chỉ khách hàng đã được xác minh. Bạn đặt mức phí và lịch trình của riêng mình.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- Trust strip --}}
    <section class="border-y border-text/20">
        <div class="container-page flex h-24 items-center justify-center">
            <div class="grid w-full grid-cols-1 divide-y divide-text/20 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="display-stat">500+</p>
                    <p class="text-body-dense mt-2">Luật sư trên nền tảng</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="display-stat">12</p>
                    <p class="text-body-dense mt-2">Thành phố trên khắp Việt Nam</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="display-stat">10,000+</p>
                    <p class="text-body-dense mt-2">Buổi tư vấn đã hoàn thành</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why list with us --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Tại sao đăng ký với chúng tôi</h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($valueProps as $v)
                <div class="card-base">
                    <h3 class="text-card-h3">{{ $v['title'] }}</h3>
                    <p class="text-body-dense mt-2">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Lawyer testimonial --}}
    <section class="container-page pt-24">
        <div class="border-y border-text/20 py-20 md:py-24">
            <blockquote class="text-pull-quote mx-auto max-w-[900px] text-center">
                <span>“</span>Sáu tháng sau, một nửa số khách hàng mới của tôi đến từ LegalEase. Việc xác minh đã cho tôi sự tin cậy mà tôi không thể mua được.<span>”</span>
            </blockquote>
            <p class="text-eyebrow mt-8 text-center">
                Lê Văn Thanh, Tố tụng dân sự, TP. Hồ Chí Minh
            </p>
        </div>
    </section>

    {{-- How it works --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Cách thức hoạt động</h2>

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($steps as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="text-card-h3 mt-6">{{ $step['title'] }}</h3>
                    <p class="text-body mt-2 max-w-sm">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="container-page closing-cta">
        <h2 class="text-cta-h2">
            Sẵn sàng phát triển hành nghề?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('lawyer.register') }}">Đăng ký tham gia →</x-button>
        </div>
    </section>
@endsection

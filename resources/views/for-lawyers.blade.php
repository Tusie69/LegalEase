@extends('layouts.app', ['title' => 'Dành cho Luật sư · LegalEase'])

@php
    $valueProps = [
        [
            'title' => 'Chỉ khách hàng đã được xác minh',
            'desc'  => 'Mọi khách hàng đều được xem xét trước khi họ có thể đặt chỗ. Không có thư rác, không lãng phí thời gian.',
        ],
        [
            'title' => 'Tự đặt mức phí của bạn',
            'desc'  => "Bạn tự chọn phí tư vấn theo giờ. Chúng tôi không thu phần trăm trên phí tư vấn của bạn.",
        ],
        [
            'title' => 'Tính khả dụng theo thời gian thực',
            'desc'  => 'Quản lý thời điểm của bạn từ một lịch. Khách hàng chỉ nhìn thấy những gì bạn xuất bản.',
        ],
        [
            'title' => 'Không có độc quyền',
            'desc'  => 'Liệt kê với LegalEase cùng với hoạt động hiện tại của bạn. Không có cam kết về số lượng.',
        ],
    ];

    $steps = [
        [
            'n'     => '01',
            'title' => 'Áp dụng',
            'desc'  => 'Gửi thông tin xác thực thanh và thông tin cơ bản của bạn.',
        ],
        [
            'n'     => '02',
            'title' => 'Xác minh',
            'desc'  => 'Nhóm của chúng tôi xem xét và phê duyệt trong vòng vài ngày làm việc.',
        ],
        [
            'n'     => '03',
            'title' => 'Liệt kê và kiếm tiền',
            'desc'  => 'Đặt phòng trống, phí và bắt đầu nhận đặt chỗ.',
        ],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1668239596261-62f94059533e?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Dành cho luật sư</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Phát triển hoạt động hành nghề của bạn trên LegalEase.
            </h1>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="bg-surface">
        <div class="mx-auto flex h-24 max-w-[1280px] items-center justify-center px-8">
            <div class="grid w-full grid-cols-1 divide-y divide-text/10 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">500+</p>
                    <p class="mt-2 text-[14px] text-muted">Luật sư trên nền tảng</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">12</p>
                    <p class="mt-2 text-[14px] text-muted">Các thành phố trên khắp Việt Nam</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">10,000+</p>
                    <p class="mt-2 text-[14px] text-muted">Buổi tư vấn đã hoàn tất</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why list with us --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Tại sao liệt kê với chúng tôi</h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($valueProps as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[24px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Lawyer testimonial --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="border-y border-text/10 py-20 md:py-24">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">“</span>Sáu tháng sau, một nửa số khách hàng mới của tôi đến từ LegalEase. Việc xác minh đã cho tôi sự tin cậy mà tôi không thể mua được.<span class="text-muted">”</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Lê Văn Thanh, Tố tụng dân sự, Thành phố Hồ Chí Minh
            </p>
        </div>
    </section>

    {{-- How it works --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Nó hoạt động như thế nào</h2>

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($steps as $step)
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
            Sẵn sàng phát triển hoạt động hành nghề?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('lawyer.register') }}">Đăng ký tham gia →</x-button>
        </div>
    </section>
@endsection

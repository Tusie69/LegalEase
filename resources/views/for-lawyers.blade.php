@extends('layouts.app', ['title' => 'Dành cho Luật sư · LegalEase'])

@php
    $valueProps = [
        [
            'title' => 'Chỉ khách hàng đã được xác minh',
            'desc'  => 'Mọi khách hàng đều được xem xét trước khi có thể đặt lịch. Không có thư rác, không lãng phí thời gian.',
        ],
        [
            'title' => 'Tự đặt mức phí của bạn',
            'desc'  => 'Bạn chủ động mức phí theo giờ. Chúng tôi không khấu trừ vào phí tư vấn của bạn.',
        ],
        [
            'title' => 'Lịch trống theo thời gian thực',
            'desc'  => 'Quản lý lịch làm việc từ một nơi. Khách hàng chỉ thấy những khung giờ bạn công khai.',
        ],
        [
            'title' => 'Không ràng buộc độc quyền',
            'desc'  => 'Bạn có thể tham gia LegalEase song song với hoạt động hiện tại. Không cam kết số lượng hồ sơ.',
        ],
    ];

    $steps = [
        [
            'n'     => '01',
            'title' => 'Nộp hồ sơ',
            'desc'  => 'Gửi thông tin xác thực hành nghề và hồ sơ cơ bản của bạn.',
        ],
        [
            'n'     => '02',
            'title' => 'Xác minh',
            'desc'  => 'Đội ngũ của chúng tôi xem xét và phản hồi trong vài ngày làm việc.',
        ],
        [
            'n'     => '03',
            'title' => 'Bắt đầu nhận lịch',
            'desc'  => 'Thiết lập lịch trống, mức phí và bắt đầu nhận lịch tư vấn.',
        ],
    ];
@endphp

@section('content')
    {{-- Hero: split layout for contrast/readability --}}
    <section class="relative -mt-[72px] overflow-hidden border-b border-text/10 bg-[#f6f7f9]">
        <div class="mx-auto grid min-h-screen max-w-[1280px] grid-cols-1 px-8 pt-24 md:grid-cols-2 md:gap-10 md:pt-28">
            <div class="flex items-center py-16 md:py-20">
                <div class="max-w-[560px]">
                    <p class="text-[12px] font-semibold uppercase tracking-[0.14em] text-slate-600">Dành cho luật sư</p>

                    <h1 class="mt-5 font-display text-[44px] font-medium leading-[1.06] tracking-[-0.02em] text-slate-900 md:text-[68px]">
                        Xây dựng thương hiệu hành nghề cùng LegalEase.
                    </h1>

                    <p class="mt-6 max-w-[520px] text-[17px] leading-relaxed text-slate-600">
                        Tiếp cận khách hàng phù hợp, quản lý lịch tư vấn tập trung và phát triển uy tín nghề nghiệp một cách bền vững.
                    </p>

                    <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                        <x-button variant="primary" href="{{ route('lawyer.register') }}">Đăng ký ngay</x-button>
                        <a href="#vi-sao" class="inline-flex items-center justify-center rounded-xl border border-text/15 px-6 py-3 text-[15px] font-medium text-text transition-colors hover:bg-slate-100 hover:border-text/25">
                            Tìm hiểu thêm
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative hidden min-h-[560px] md:block">
                <div class="absolute inset-0 overflow-hidden rounded-3xl">
                    <img src="https://images.unsplash.com/photo-1668239596261-62f94059533e?q=80&w=2671&auto=format&fit=crop"
                         alt="Tượng nữ thần công lý"
                         class="h-full w-full object-cover object-center">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/55 via-slate-900/20 to-slate-900/45"></div>
                    <div class="absolute inset-0 backdrop-blur-[1px]"></div>
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
                    <p class="mt-2 text-[14px] text-muted">Luật sư trên nền tảng</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">12</p>
                    <p class="mt-2 text-[14px] text-muted">Thành phố trên khắp Việt Nam</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">10,000+</p>
                    <p class="mt-2 text-[14px] text-muted">Lượt tư vấn đã hoàn tất</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why list with us --}}
    <section id="vi-sao" class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Vì sao nên tham gia cùng chúng tôi</h2>

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
                <span class="text-muted">“</span>Sáu tháng sau, một nửa số khách hàng mới của tôi đến từ LegalEase. Quy trình xác minh tạo ra độ tin cậy mà tôi không thể mua bằng quảng cáo.<span class="text-muted">”</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Lê Văn Thanh, Tố tụng dân sự, TP.HCM
            </p>
        </div>
    </section>

    {{-- How it works --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Quy trình tham gia</h2>

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
    <section class="mx-auto max-w-[1280px] px-8 pb-24 pt-32 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Sẵn sàng mở rộng hoạt động hành nghề?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('lawyer.register') }}">Đăng ký tham gia →</x-button>
        </div>
    </section>
@endsection

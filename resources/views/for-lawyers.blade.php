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

    $transparency = [
        [
            'q' => 'Tôi có thể tự đặt mức phí của mình không?',
            'a' => 'Có. Bạn tự đặt mức phí theo giờ khi đăng ký và có thể cập nhật bất kỳ lúc nào, các thay đổi không ảnh hưởng đến những lượt đặt chỗ đã có.',
        ],
        [
            'q' => 'Khi nào tôi được trả tiền?',
            'a' => 'Bạn nhận 100% phí tư vấn. Khách hàng có thể thanh toán trực tiếp tại buổi hẹn, hoặc thanh toán trước qua nền tảng và chúng tôi chuyển vào tài khoản của bạn.',
        ],
        [
            'q' => 'Quá trình xác minh mất bao lâu?',
            'a' => 'Thông thường 2 đến 3 ngày làm việc. Các trường hợp phức tạp có thể lâu hơn; chúng tôi sẽ thông báo nếu cần thêm thời gian.',
        ],
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.pexels.com/photos/18981853/pexels-photo-18981853.jpeg"
        eyebrow="Dành cho luật sư">
        Phát triển hành nghề của bạn cùng LegalEase.

        <x-slot:subtitle>
            Chỉ khách hàng đã được xác minh. Bạn đặt mức phí và lịch trình của riêng mình.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- Vertical-offset gallery --}}
    <section class="container-page pt-24">
        <div class="grid gap-12 lg:grid-cols-2 lg:items-center lg:gap-16">
            {{-- Text --}}
            <div>
                <p class="text-eyebrow">Tại sao đăng ký</p>
                <h2 class="text-section-h2 mt-4">
                    Phát triển trên một nền tảng được tuyển chọn.
                </h2>
                <div class="text-body-prose mt-6 space-y-4">
                    <p>
                        Khách hàng đã được xác minh trước khi đặt chỗ. Không có thư rác, không lãng phí thời gian.
                    </p>
                    <p>
                        Bạn tự đặt mức phí và mở khung giờ. Chúng tôi không thu phần trăm từ phí tư vấn của bạn, và không yêu cầu số lượng tối thiểu để tham gia.
                    </p>
                </div>
                <a href="#cach-thuc" class="text-link-action mt-6 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                    Xem cách thức hoạt động
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            {{-- Offset photo pair (hidden on mobile) --}}
            <div class="hidden items-start gap-4 md:grid md:grid-cols-2 lg:gap-6">
                <div class="overflow-hidden rounded-2xl">
                    <x-responsive-img src="https://images.pexels.com/photos/8085945/pexels-photo-8085945.jpeg"
                                      alt=""
                                      sizes="25vw"
                                      :widths="[400, 600, 800]"
                                      class="aspect-[3/4] w-full object-cover" />
                </div>
                <div class="overflow-hidden rounded-2xl lg:mt-20">
                    <x-responsive-img src="https://images.pexels.com/photos/8847209/pexels-photo-8847209.jpeg"
                                      alt=""
                                      sizes="25vw"
                                      :widths="[400, 600, 800]"
                                      class="aspect-[3/4] w-full object-cover" />
                </div>
            </div>
        </div>
    </section>

    {{-- Mixed-media block --}}
    <section class="container-page pt-24">
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-6">
            {{-- Navy emphasis card --}}
            <div class="flex flex-col justify-between rounded-2xl bg-accent p-10 text-bg lg:p-12">
                <div>
                    <p class="text-eyebrow text-gold">Cộng đồng</p>
                    <h2 class="text-section-h2 mt-6 text-bg">
                        Một mạng lưới được lựa chọn kỹ lưỡng.
                    </h2>
                    <p class="text-body-prose mt-6 text-bg/85">
                        Mỗi luật sư trên LegalEase đều đã được xác minh hồ sơ hành nghề. Khi bạn tham gia, bạn đứng cạnh những đồng nghiệp được khách hàng tin tưởng.
                    </p>
                </div>
            </div>

            {{-- Right stack: photo + metrics --}}
            <div class="flex flex-col gap-6">
                <div class="overflow-hidden rounded-2xl">
                    <x-responsive-img src="https://images.pexels.com/photos/4427430/pexels-photo-4427430.jpeg"
                                      alt=""
                                      sizes="(min-width: 1024px) 50vw, 100vw"
                                      :widths="[600, 900, 1200]"
                                      class="aspect-[16/9] w-full object-cover" />
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl border border-text/15 p-8">
                        <p class="display-stat-feature text-accent whitespace-nowrap">100%</p>
                        <p class="text-caption mt-4">Bạn nhận toàn bộ phí tư vấn.</p>
                    </div>
                    <div class="rounded-2xl border border-text/15 p-8">
                        <p class="display-stat-feature text-accent whitespace-nowrap">2-3</p>
                        <p class="text-caption mt-4">Ngày phê duyệt hồ sơ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Operational transparency --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Minh bạch vận hành</h2>

        <div class="mt-12 grid divide-y divide-text/15 md:grid-cols-3 md:divide-y-0 md:divide-x">
            @foreach ($transparency as $item)
                <div class="py-10 first:pt-0 last:pb-0 md:px-10 md:py-0 md:first:pl-0 md:last:pr-0">
                    <h3 class="text-card-h4">{{ $item['q'] }}</h3>
                    <p class="text-body mt-4">{{ $item['a'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- How it works --}}
    <section id="cach-thuc" class="container-page pt-24">
        <h2 class="text-section-h2">Cách thức hoạt động</h2>

        <div class="relative mt-12 grid divide-y divide-text/15 md:grid-cols-3 md:gap-12 md:divide-y-0">
            {{-- Ground line --}}
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 hidden h-px bg-text/15 md:block md:top-20 lg:top-24"></div>

            @foreach ($steps as $step)
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
                Sẵn sàng phát triển hành nghề?
            </h2>
            <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
                Đăng ký mất vài phút. Đội ngũ chúng tôi sẽ xem xét và phê duyệt trong vòng vài ngày làm việc.
            </p>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="{{ route('lawyer.register') }}">Đăng ký tham gia →</x-button>
            </div>
        </div>
    </section>
@endsection

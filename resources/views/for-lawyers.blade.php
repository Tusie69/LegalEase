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

    $profiles = [
        ['initials' => 'NH', 'name' => 'LS. Nguyễn Hoài',  'specialty' => 'Doanh nghiệp · Hợp đồng', 'rating' => '4.95'],
        ['initials' => 'TM', 'name' => 'LS. Trần Minh',    'specialty' => 'Sở hữu trí tuệ',         'rating' => '4.88'],
        ['initials' => 'LP', 'name' => 'LS. Lê Phương',    'specialty' => 'Lao động · Gia đình',    'rating' => '4.82'],
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.pexels.com/photos/18981853/pexels-photo-18981853.jpeg"
        eyebrow="Dành cho luật sư">
        Lấp đầy lịch tư vấn của bạn, với khách hàng đã sẵn sàng trả phí.

        <x-slot:subtitle>
            Khách hàng đã được sàng lọc. Bạn giữ 100% phí tư vấn. Bạn toàn quyền quyết định lịch.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- Why register: stat + animated profile-card rotator --}}
    <section x-data="whyRotator()" class="container-page pt-24">
        <div class="grid gap-12 lg:grid-cols-[1fr_1.05fr] lg:items-center lg:gap-16">
            {{-- Left: text + dots + stat --}}
            <div>
                <p class="text-eyebrow">Tại sao đăng ký</p>
                <h2 class="text-section-h2 mt-4">
                    Một nền tảng được tuyển chọn, không phải chợ luật sư.
                </h2>
                <p class="text-body-prose mt-6 max-w-[34rem]">
                    Khách hàng đã được xác minh trước khi đặt chỗ. Bạn tự đặt mức phí, mở khung giờ và giữ 100% phí tư vấn. Không hoa hồng, không số lượng tối thiểu.
                </p>

                {{-- Progress dots tied to the rotator --}}
                <div class="mt-8 flex gap-2" aria-hidden="true">
                    <template x-for="i in {{ count($profiles) }}" :key="i">
                        <span :class="(i - 1) === idx ? 'w-10 bg-accent' : 'w-5 bg-text/15'"
                              class="h-1 rounded-full transition-all duration-300"></span>
                    </template>
                </div>

                {{-- Big stat --}}
                <div class="mt-8 flex items-end gap-6 border-t border-text/15 pt-6">
                    <p class="display-stat-feature text-accent">100%</p>
                    <p class="text-body-dense max-w-[14rem] text-text/70">
                        Bạn giữ toàn bộ phí tư vấn. Không trừ hoa hồng nền tảng.
                    </p>
                </div>
            </div>

            {{-- Right: profile-card stage --}}
            <div class="relative min-h-[28rem] overflow-hidden rounded-2xl border border-text/15 bg-text/5 p-7">
                <p class="text-eyebrow text-text/60">Hồ sơ luật sư · đã xác minh</p>

                <div class="absolute left-1/2 top-1/2 w-[88%] -translate-x-1/2 -translate-y-1/2 space-y-3">
                    @foreach ($profiles as $i => $p)
                        <div :class="idx === {{ $i }} ? 'opacity-100 scale-100' : 'opacity-50 scale-[.97]'"
                             class="flex items-center gap-3 rounded-xl border border-text/15 bg-bg px-4 py-3 transition-all duration-300">
                            <div class="text-caption flex h-10 w-10 flex-none items-center justify-center rounded-full border border-text/15 bg-text/5 font-medium text-accent">
                                {{ $p['initials'] }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="text-card-h5 truncate">{{ $p['name'] }}</p>
                                    <span class="text-form-hint inline-flex items-center gap-1 rounded-full bg-accent/10 px-2 py-0.5 font-medium text-accent">
                                        <x-icon name="check" :size="12" class="stroke-[3]" />
                                        Xác minh
                                    </span>
                                </div>
                                <p class="text-form-hint mt-0.5 text-text/60">{{ $p['specialty'] }}</p>
                            </div>
                            <div class="text-caption flex flex-none items-center gap-1 text-text">
                                <svg class="h-3.5 w-3.5 fill-gold text-gold" viewBox="0 0 24 24">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                {{ $p['rating'] }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="text-caption absolute bottom-4 left-7 text-text/60">
                    <span class="font-medium text-text" x-text="String(idx + 1).padStart(2, '0')"></span>
                    <span> / {{ str_pad(count($profiles), 2, '0', STR_PAD_LEFT) }} · Hồ sơ đã xác minh</span>
                </p>
            </div>
        </div>

        <script>
            function whyRotator() {
                return {
                    idx: 0,
                    init() {
                        setInterval(() => {
                            this.idx = (this.idx + 1) % {{ count($profiles) }};
                        }, 2400);
                    },
                };
            }
        </script>
    </section>

    {{-- Mixed-media block --}}
    <section class="container-page pt-24">
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-6">
            {{-- Navy emphasis card --}}
            <div class="flex flex-col justify-between rounded-2xl bg-accent p-10 text-bg lg:p-12">
                <div>
                    <p class="text-eyebrow text-gold">Cộng đồng</p>
                    <h2 class="text-section-h2 mt-6 text-bg">
                        Một mạng lưới được tuyển chọn kỹ lưỡng.
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

    {{-- Operational transparency: dashboard mockup + interactive FAQ chips --}}
    <section class="container-page pt-24">
        <p class="text-eyebrow">Minh bạch vận hành</p>
        <h2 class="text-section-h2 mt-4">Bảng minh bạch, bạn thấy mọi thứ.</h2>

        <div class="mt-12 grid gap-8 lg:grid-cols-[1.05fr_1fr] lg:items-start lg:gap-12">
            {{-- Left: dashboard mockup --}}
            <div class="rounded-2xl border border-text/15 bg-bg p-6">
                {{-- Payout breakdown --}}
                <div class="flex items-baseline justify-between">
                    <p class="text-eyebrow">Bảng điều khiển</p>
                    <span class="text-form-hint text-accent">Xem tất cả →</span>
                </div>

                <dl class="mt-2 divide-y divide-dashed divide-text/15">
                    <div class="flex items-center justify-between py-3">
                        <dt class="text-caption text-text/70">Phí tư vấn buổi hẹn</dt>
                        <dd class="text-caption font-medium text-text">1.500.000₫</dd>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <dt class="text-caption text-text/70">Bạn nhận</dt>
                        <dd class="text-caption font-medium text-text">1.500.000₫ · 100%</dd>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <dt class="text-caption text-text/70">Hoa hồng nền tảng</dt>
                        <dd class="text-caption font-medium text-text">0₫</dd>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <dt class="text-caption text-text/70">Trạng thái</dt>
                        <dd class="text-caption inline-flex items-center gap-1.5 font-medium text-success">
                            <x-icon name="check" :size="14" class="stroke-[2.5]" />
                            Đã chuyển khoản · T+1
                        </dd>
                    </div>
                </dl>

                {{-- Bar chart --}}
                <div class="mt-6">
                    <p class="text-eyebrow">Lịch hẹn 6 tuần qua</p>
                    <div class="mt-3 flex h-20 items-end gap-2 border-b border-text/15 pb-1">
                        @foreach ([25, 45, 35, 70, 90, 60] as $h)
                            <div class="flex-1 rounded-t bg-accent/90" style="height: {{ $h }}%"></div>
                        @endforeach
                    </div>
                </div>

                {{-- Metric tiles --}}
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="rounded-xl bg-text/5 px-4 py-3">
                        <p class="display-stat-feature text-text">2-3</p>
                        <p class="text-form-hint mt-1 text-text/60">Ngày phê duyệt hồ sơ</p>
                    </div>
                    <div class="rounded-xl bg-text/5 px-4 py-3">
                        <p class="display-stat-feature text-text">0%</p>
                        <p class="text-form-hint mt-1 text-text/60">Hoa hồng nền tảng</p>
                    </div>
                </div>
            </div>

            {{-- Right: FAQ chips with visual proof --}}
            <div class="flex flex-col gap-3">
                {{-- Chip 1: fee slider --}}
                <div class="rounded-2xl border border-text/15 bg-bg p-5">
                    <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 flex-none items-center justify-center rounded-lg bg-text/5 text-accent">
                            <x-icon name="scale" :size="18" />
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-card-h5">Tôi có thể tự đặt mức phí của mình không?</p>
                            <p class="text-form-hint mt-1 text-text/60">Có. Bạn tự đặt khi đăng ký và cập nhật bất kỳ lúc nào.</p>
                            <div class="mt-4">
                                <div class="relative h-1.5 rounded-full bg-text/10">
                                    <div class="absolute inset-y-0 left-0 w-[55%] rounded-full bg-accent"></div>
                                    <div class="absolute left-[55%] top-1/2 h-4 w-4 -translate-x-1/2 -translate-y-1/2 rounded-full border-2 border-accent bg-bg"></div>
                                </div>
                                <div class="text-form-hint mt-2 flex justify-between text-text/60">
                                    <span>500.000₫</span>
                                    <span>Bạn nhận 100%</span>
                                    <span>5.000.000₫</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Chip 2: payout timeline --}}
                <div class="rounded-2xl border border-text/15 bg-bg p-5">
                    <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 flex-none items-center justify-center rounded-lg bg-text/5 text-accent">
                            <x-icon name="clock" :size="18" />
                        </span>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <p class="text-card-h5">Khi nào tôi được trả tiền?</p>
                                <span class="text-form-hint flex-none rounded-full bg-text/5 px-2.5 py-0.5 font-medium text-accent">T+1</span>
                            </div>
                            <p class="text-form-hint mt-1 text-text/60">Khách thanh toán tại buổi hẹn hoặc qua nền tảng, chuyển vào tài khoản của bạn.</p>
                            <div class="mt-4 flex items-center gap-2">
                                <div class="flex flex-1 flex-col items-center gap-1.5">
                                    <span class="h-3 w-3 rounded-full bg-accent"></span>
                                    <span class="text-form-hint text-text">Buổi hẹn</span>
                                </div>
                                <span class="h-px flex-1 bg-accent/25"></span>
                                <div class="flex flex-1 flex-col items-center gap-1.5">
                                    <span class="h-3 w-3 rounded-full bg-accent"></span>
                                    <span class="text-form-hint text-text">Thanh toán</span>
                                </div>
                                <span class="h-px flex-1 bg-accent/25"></span>
                                <div class="flex flex-1 flex-col items-center gap-1.5">
                                    <span class="h-3 w-3 rounded-full border-2 border-accent bg-bg"></span>
                                    <span class="text-form-hint text-text/60">Vào tài khoản</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Chip 3: verification time --}}
                <div class="rounded-2xl border border-text/15 bg-bg p-5">
                    <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 flex-none items-center justify-center rounded-lg bg-text/5 text-accent">
                            <x-icon name="check" :size="18" />
                        </span>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <p class="text-card-h5">Quá trình xác minh mất bao lâu?</p>
                                <span class="text-form-hint flex-none rounded-full bg-text/5 px-2.5 py-0.5 font-medium text-accent">2-3 ngày</span>
                            </div>
                            <p class="text-form-hint mt-1 text-text/60">Thẻ luật sư, đoàn luật sư xác nhận, phỏng vấn ngắn.</p>
                        </div>
                    </div>
                </div>
            </div>
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
    <x-closing-cta
        heading="Sẵn sàng phát triển sự nghiệp?"
        subtitle="Đăng ký mất vài phút. Đội ngũ chúng tôi sẽ xem xét và phê duyệt trong vòng vài ngày làm việc."
        button="Bắt đầu nhận khách hàng →"
        :href="route('lawyer.register')" />
@endsection

@extends('layouts.app', ['navOverlay' => true])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $featuredLawyers = \App\Data\Lawyers::featured(3);
    // Sarah Mitchell's record powers the "Lựa chọn người phù hợp" profile vignette below.
    // Pull live so the vignette stays in sync with her real lawyer profile (portrait, specialty, rating).
    $sarahVignette = \App\Data\Lawyers::findBySlug('sarah-mitchell') ?? $featuredLawyers->first();
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
             class="absolute inset-0 bg-gradient-to-r from-text/90 via-text/75 to-text/50"></div>

        <div class="container-page relative flex flex-1 items-center pt-32 pb-24">
            <div class="max-w-[760px]">
                <p class="text-eyebrow-hero text-gold">
                    Luật sư uy tín, minh bạch từ đầu
                </p>

                <h1 class="text-hero mt-6 text-bg">
                    Đúng luật sư. Đúng thời điểm. Không đắn đo.
                </h1>

                <p class="text-body-intro mt-6 max-w-xl text-bg/80">
                    Phí công khai. Hồ sơ đã xác minh. Lịch đặt ngay. Kết nối với luật sư uy tín tại Việt Nam, theo cách của bạn.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-button variant="gold" :href="route('match.specialty')">Tìm luật sư phù hợp →</x-button>
                    <x-button variant="on-dark-ghost" href="#how-it-works">Cách hoạt động</x-button>
                </div>
            </div>
        </div>
    </section>

    {{-- Trust strip with count-up animation on viewport entry --}}
    <section class="bg-accent" x-data="trustStripCounter()" x-init="init()">
        <div class="container-page flex items-center justify-center md:h-24">
            <div class="grid w-full grid-cols-1 divide-y divide-gold/40 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat tabular-nums text-gold">
                        <span x-text="format(counts[0], 0)">500</span>+
                    </p>
                    <p class="text-body mt-2 text-bg/80">Luật sư đã được xác minh</p>
                </div>
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat tabular-nums text-gold" x-text="format(counts[1], 1)">4.8</p>
                    <p class="text-body mt-2 text-bg/80">Đánh giá trung bình</p>
                </div>
                <div class="flex flex-col items-center px-6 py-6 md:py-0">
                    <p class="display-stat tabular-nums text-gold">
                        <span x-text="format(counts[2], 0)">10,000</span>+
                    </p>
                    <p class="text-body mt-2 text-bg/80">Buổi tư vấn đã hoàn tất</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Practice areas --}}
    <section class="container-page pt-24">
        <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between lg:gap-8">
            <h2 class="text-section-h2">Các lĩnh vực chúng tôi phụ trách</h2>
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
    @php
        $steps = [
            [
                'n' => '01', 'label' => 'Tìm luật sư',
                'head' => 'Chọn đúng người,', 'head_ghost' => 'ngay từ đầu.',
                'body' => 'Tìm hồ sơ chi tiết, đánh giá đã xác minh, và chi phí minh bạch. Lọc theo lĩnh vực, địa điểm và mức giá để tìm đúng người ngay từ đầu.',
                'vignette' => 'profile',
            ],
            [
                'n' => '02', 'label' => 'Đặt lịch',
                'head' => 'Đặt lịch', 'head_ghost' => 'trong vài phút.',
                'body' => 'Xem lịch trống của luật sư theo thời gian thực và đặt khung giờ chỉ trong vài bước. Chúng tôi gửi xác nhận ngay sau khi bạn xem lại thông tin.',
                'vignette' => 'calendar',
            ],
            [
                'n' => '03', 'label' => 'Thanh toán',
                'head' => 'Trả trước hay trả sau,', 'head_ghost' => 'bạn chọn.',
                'body' => 'Bạn có thể thanh toán toàn bộ phí tư vấn ngay để hoàn tất đặt chỗ, hoặc thanh toán trực tiếp cho luật sư tại buổi tư vấn - tùy bạn chọn.',
                'vignette' => 'receipt',
            ],
        ];
    @endphp

    <section id="how-it-works" x-data="howItWorksRail()" class="container-page pt-24 md:pt-32">
        <div class="max-w-[640px]">
            <p class="text-eyebrow text-accent">Cách hoạt động</p>
            <h2 class="text-section-h2 text-trim-cap mt-6">
                Ba bước. Không bất ngờ.
                <span class="font-light italic text-text/50">Không phát sinh.</span>
            </h2>
        </div>

        <div class="mt-16 grid gap-12 lg:grid-cols-[240px_1fr] lg:gap-20">
            {{-- Sticky rail (desktop only) --}}
            <ul class="hidden lg:sticky lg:top-32 lg:block lg:self-start lg:space-y-7">
                @foreach ($steps as $i => $step)
                    <li>
                        <button type="button" @click="goTo({{ $i }})"
                                class="text-card-h5 relative pl-8 ease-soft transition-colors duration-300"
                                :class="active === {{ $i }} ? 'text-text' : 'text-text/40'">
                            <span aria-hidden="true"
                                  class="absolute left-0 top-1/2 h-px w-4 -translate-y-1/2 bg-gold ease-soft transition-opacity duration-300"
                                  :class="active === {{ $i }} ? 'opacity-100' : 'opacity-0'"></span>
                            {{ $step['label'] }}
                        </button>
                    </li>
                @endforeach
            </ul>

            {{-- Scenes --}}
            <div class="space-y-24">
                @foreach ($steps as $i => $step)
                    <div data-step="{{ $i }}" class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                        <div>
                            <p class="numeral-stroke">{{ $step['n'] }}</p>
                            <h3 class="text-flow-h1 mt-4">
                                {{ $step['head'] }}
                                <span class="font-light italic text-text/50">{{ $step['head_ghost'] }}</span>
                            </h3>
                            <p class="text-body-prose mt-6 max-w-[48ch] text-text/70">{{ $step['body'] }}</p>
                        </div>

                        {{-- Vignette --}}
                        <div>
                            @if ($step['vignette'] === 'calendar')
                                <div class="rounded-sm border border-text/15 bg-bg p-6">
                                    <div class="text-eyebrow flex justify-between border-b border-text/15 pb-4 text-text/60">
                                        <span>Lịch trống</span>
                                        <span>T6, 24/05</span>
                                    </div>
                                    <div class="flex justify-between border-b border-text/15 py-3">
                                        <span class="text-body font-display">09:00 - 10:00</span>
                                        <span class="text-form-hint uppercase tracking-widest text-accent">Còn trống</span>
                                    </div>
                                    <div class="flex justify-between border-b border-text/15 py-3">
                                        <span class="text-body font-display text-text/50 line-through">10:30 - 11:30</span>
                                        <span class="text-form-hint uppercase tracking-widest text-text/50 line-through">Đã đặt</span>
                                    </div>
                                    <div class="flex justify-between border-b border-text/15 py-3">
                                        <span class="text-body font-display">14:00 - 15:00</span>
                                        <span class="text-form-hint uppercase tracking-widest text-accent">Còn trống</span>
                                    </div>
                                    <div class="flex justify-between py-3">
                                        <span class="text-body font-display">16:00 - 17:00</span>
                                        <span class="text-form-hint uppercase tracking-widest text-accent">Còn trống</span>
                                    </div>
                                </div>
                            @elseif ($step['vignette'] === 'profile')
                                <div class="flex items-center gap-5 rounded-sm border border-text/15 bg-bg p-6">
                                    <x-responsive-img :src="$sarahVignette['portrait_url']"
                                                      :alt="$sarahVignette['name']"
                                                      sizes="128px"
                                                      :widths="[200, 400]"
                                                      class="h-40 w-32 flex-none rounded-sm border border-text/15 object-cover object-top" />
                                    <div class="min-w-0">
                                        <h4 class="text-card-h3">{{ $sarahVignette['name'] }}</h4>
                                        <p class="text-body-dense mt-2 font-display italic text-text/70">{{ $sarahVignette['primary_specialty'] }}</p>
                                        <p class="text-form-hint mt-4 uppercase tracking-widest text-accent"><span class="text-gold-bright">★</span> {{ $sarahVignette['rating'] }} · {{ $sarahVignette['review_count'] }} đánh giá</p>
                                    </div>
                                </div>
                            @elseif ($step['vignette'] === 'receipt')
                                <div class="rounded-sm border border-text/15 bg-bg p-6">
                                    <h4 class="text-card-h3 mb-3">Xác nhận đặt chỗ</h4>
                                    <div class="flex justify-between border-b border-text/15 py-3">
                                        <span class="text-body font-display">Luật sư</span>
                                        <span class="text-body font-display">Sarah Mitchell</span>
                                    </div>
                                    <div class="flex justify-between border-b border-text/15 py-3">
                                        <span class="text-body font-display">Thời gian</span>
                                        <span class="text-body font-display">T6, 24/05 · 14:00</span>
                                    </div>
                                    <div class="flex justify-between py-3">
                                        <span class="text-body font-display">Hình thức</span>
                                        <span class="text-body font-display">Trực tuyến</span>
                                    </div>
                                    <div class="text-card-h5 mt-2 flex justify-between border-t border-text pt-4">
                                        <span>Tổng phí tư vấn</span>
                                        <span>1.500.000 ₫</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Customer review --}}
    @php
        $testimonials = [
            [
                'quote'   => 'Họ tìm được luật sư phù hợp cho tôi trong vòng 48 giờ - minh bạch và không có bất ngờ nào về chi phí.',
                'name'    => 'Mai Linh',
                'title'   => 'Doanh nhân, TP.HCM',
                'portrait'=> 'https://images.pexels.com/photos/26425549/pexels-photo-26425549.jpeg',
            ],
            [
                'quote'   => 'Sau ba lần thử các nền tảng khác, đây là lần đầu tiên tôi cảm thấy mình thực sự được lắng nghe trước khi trả tiền.',
                'name'    => 'Hoàng Nam',
                'title'   => 'Kỹ sư phần mềm, Hà Nội',
                'portrait'=> 'https://images.pexels.com/photos/26336889/pexels-photo-26336889.jpeg',
            ],
            [
                'quote'   => 'Hồ sơ rõ ràng, đánh giá thật, và lịch trống cập nhật theo thời gian thực - tôi đặt được buổi tư vấn ngay trong giờ nghỉ trưa.',
                'name'    => 'Thanh Hà',
                'title'   => 'Quản lý dự án, Đà Nẵng',
                'portrait'=> 'https://images.pexels.com/photos/26953801/pexels-photo-26953801.jpeg',
            ],
        ];
    @endphp

    <section x-data="testimonialSlider({{ count($testimonials) }})"
             @mouseenter="pause()" @mouseleave="resume()"
             aria-labelledby="testimonial-heading"
             class="container-page pt-24 md:pt-32">

        {{-- Ghost line: editorial ledge anchoring the section to the page --}}
        <div aria-hidden="true" class="h-px bg-text/10"></div>

        <h2 id="testimonial-heading" class="text-section-h2 mt-12 text-center">
            Khách hàng thật. Câu chuyện thật.
        </h2>

        <div class="relative mt-12" role="region" aria-roledescription="carousel">
            {{-- Slide stack: all slides share grid cell, container sizes to tallest, crossfade via opacity --}}
            <div class="grid">
                @foreach ($testimonials as $i => $t)
                    <div :aria-hidden="current !== {{ $i }}"
                         :class="current === {{ $i }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                         role="group"
                         aria-roledescription="slide"
                         aria-label="Lời chứng thực {{ $i + 1 }} / {{ count($testimonials) }}"
                         class="col-start-1 row-start-1 transition-opacity duration-500">

                        {{-- Overlap composition: photo right-aligned, navy card absolutely positioned over the left → photo extends beyond the card edges on the right --}}
                        <div class="relative">
                            {{-- Photo: right-aligned, 50% width on desktop, landscape aspect so it doesn't dwarf the card; full width portrait on mobile --}}
                            <div class="md:ml-auto md:w-1/2">
                                <div class="overflow-hidden rounded-xl">
                                    {{-- Eager-load so slide swaps don't trigger an image-decode flash mid-fade --}}
                                    <x-responsive-img :src="$t['portrait']"
                                                      :alt="$t['name']"
                                                      loading="eager"
                                                      sizes="(min-width: 768px) 50vw, 100vw"
                                                      :widths="[400, 600, 800, 1000]"
                                                      class="aspect-[4/5] w-full object-cover object-top md:aspect-[5/4]" />
                                </div>
                            </div>

                            {{-- Navy card: stacks below on mobile; absolutely positioned over the photo's left edge on desktop --}}
                            <div class="mt-8 rounded-xl bg-accent p-8 text-bg md:absolute md:left-0 md:top-1/2 md:mt-0 md:w-[55%] md:-translate-y-1/2 md:p-12">
                                <blockquote class="text-body-prose">
                                    "{{ $t['quote'] }}"
                                </blockquote>
                                <div class="mt-8 flex flex-wrap items-baseline gap-x-2">
                                    <span class="text-form-label font-semibold">{{ $t['name'] }}</span>
                                    <span class="text-form-label text-bg/60">{{ $t['title'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Dots: matches the news page featured carousel pattern --}}
        <div class="mt-12 flex justify-center gap-2" role="tablist" aria-label="Chọn lời chứng thực">
            @foreach ($testimonials as $i => $t)
                <button type="button"
                        role="tab"
                        @click="goTo({{ $i }})"
                        :aria-selected="current === {{ $i }}"
                        aria-label="Lời chứng thực {{ $i + 1 }}"
                        :class="current === {{ $i }} ? 'w-8 bg-accent' : 'w-2 bg-text/30 hover:bg-text/50'"
                        class="h-2 rounded-full transition-all"></button>
            @endforeach
        </div>
    </section>

    {{-- FAQ --}}
    @php
        $faqPreview = [
            ['q' => 'Tôi thanh toán khi nào?',                       'a' => 'Bạn có thể chọn thanh toán toàn bộ phí tư vấn ngay khi đặt chỗ, hoặc thanh toán trực tiếp cho luật sư tại buổi tư vấn. Không có khoản đặt cọc.'],
            ['q' => 'Luật sư được xác minh như thế nào?',            'a' => 'Mọi luật sư trên nền tảng đều được đội ngũ của chúng tôi kiểm tra tư cách thành viên đoàn luật sư, chứng chỉ hành nghề và lịch sử pháp lý.'],
            ['q' => 'Tôi có thể đổi luật sư không?',                 'a' => 'Có. Bạn có thể đổi luật sư trước buổi tư vấn miễn phí. Nếu đã thanh toán, số tiền sẽ được giữ nguyên cho lần đặt mới.'],
            ['q' => 'Nền tảng hỗ trợ những hình thức tư vấn nào?',   'a' => 'Tư vấn trực tuyến qua video, gọi điện, hoặc gặp trực tiếp tại văn phòng luật sư - theo lựa chọn của bạn.'],
        ];
    @endphp

    <section class="container-page pt-24 pb-24 md:pt-32 md:pb-32">
        <div class="grid items-start gap-12 lg:grid-cols-[5fr_7fr] lg:gap-20">
            <div>
                <p class="text-eyebrow text-accent">Trước khi bạn đặt lịch</p>
                <h2 class="text-section-h2 text-trim-cap mt-6">
                    Những điều bạn muốn biết,
                    <span class="font-light italic text-text/50">trước khi cần đến luật sư.</span>
                </h2>
                <p class="text-body-prose mt-6 max-w-[36ch] text-text/70">
                    Đây là những câu hỏi phổ biến nhất từ người dùng của chúng tôi.
                </p>
                <a href="{{ route('faq') }}"
                   class="text-link-action mt-8 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                    Xem tất cả câu hỏi
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <ul class="border-t border-text/15">
                @foreach ($faqPreview as $item)
                    <li x-data="{ open: false }" class="border-b border-text/15">
                        <button type="button" @click="open = !open"
                                :aria-expanded="open"
                                class="text-card-h4 flex w-full items-center justify-between gap-6 py-7 text-left font-display">
                            <span>{{ $item['q'] }}</span>
                            <svg class="h-5 w-5 flex-none" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.4" stroke-linecap="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <line x1="12" y1="5" x2="12" y2="19"
                                      class="origin-center ease-soft transition-transform duration-500"
                                      :class="open ? 'rotate-[270deg]' : ''" />
                            </svg>
                        </button>
                        <div class="grid ease-soft transition-[grid-template-rows,opacity] duration-300"
                             :class="open ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                            <div class="overflow-hidden">
                                <p class="text-body max-w-[64ch] pb-7 text-text/70">{{ $item['a'] }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <script>
        // Trust-strip count-up: animate 0 → target over 1800ms with cubic-ease-out.
        // Triggered by IntersectionObserver at 40% visibility; runs once.
        function trustStripCounter() {
            return {
                targets: [500, 4.8, 10000],
                counts: [0, 0, 0],
                started: false,
                init() {
                    const observer = new IntersectionObserver(([entry]) => {
                        if (entry.isIntersecting && !this.started) {
                            this.started = true;
                            this.animate();
                            observer.disconnect();
                        }
                    }, { threshold: 0.4 });
                    observer.observe(this.$el);
                },
                animate() {
                    const duration = 1800;
                    const t0 = performance.now();
                    const tick = (now) => {
                        const p = Math.min((now - t0) / duration, 1);
                        const eased = 1 - Math.pow(1 - p, 3);
                        this.counts = this.targets.map(t => t * eased);
                        if (p < 1) requestAnimationFrame(tick);
                        else this.counts = [...this.targets]; // pin to exact final values
                    };
                    requestAnimationFrame(tick);
                },
                format(n, decimals) {
                    if (decimals > 0) return n.toFixed(decimals);
                    return Math.floor(n).toLocaleString('en-US');
                },
            };
        }

        function testimonialSlider(total) {
            return {
                current: 0,
                total,
                paused: false,
                interval: 6000,
                timer: null,
                init() {
                    this.start();
                },
                start() {
                    this.stop();
                    this.timer = setInterval(() => {
                        if (!this.paused) this.current = (this.current + 1) % this.total;
                    }, this.interval);
                },
                stop() {
                    if (this.timer) clearInterval(this.timer);
                },
                pause() { this.paused = true; },
                resume() { this.paused = false; },
                goTo(i) {
                    this.current = i;
                    this.start();
                },
            };
        }

        function howItWorksRail() {
            return {
                active: 0,
                init() {
                    const sections = this.$el.querySelectorAll('[data-step]');
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(e => {
                            if (e.isIntersecting) this.active = parseInt(e.target.dataset.step);
                        });
                    }, { rootMargin: '-35% 0px -55% 0px' });
                    sections.forEach(s => observer.observe(s));
                },
                goTo(i) {
                    const el = this.$el.querySelector(`[data-step="${i}"]`);
                    el?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    this.active = i;
                }
            };
        }
    </script>
@endsection

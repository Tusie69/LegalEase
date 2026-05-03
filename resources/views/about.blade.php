@extends('layouts.app', ['title' => 'Giới thiệu về Â · LegalEase'])

@section('content')
    {{-- Hero: full-bleed photo with overlay --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1610374792793-f016b77ca51a?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/50 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Câu chuyện của chúng tôi
            </p>

            <h1 class="mx-auto mt-6 max-w-[900px] font-display text-[56px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[88px]">
                Tư vấn pháp lý rõ ràng, không còn phỏng đoán.
            </h1>

            <p class="mx-auto mt-8 max-w-[560px] text-[18px] leading-relaxed text-secondary">
                Chúng tôi kết nối người dùng tại Việt Nam với các luật sư đã được xác minh một cách nhanh chóng.
            </p>
        </div>
    </section>

    {{-- Problem block: image left, text right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1726649339367-c2577a28881b?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">vấn đề</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Hỏi quanh không phải là một chiến lược.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    Với nhiều người tại Việt Nam, tìm luật sư thường bắt đầu bằng việc hỏi người quen và hy vọng gặp đúng người. Chi phí rất khác nhau, còn thông tin hành nghề lại khó kiểm chứng.
                </p>
            </div>
        </div>
    </section>

    {{-- Solution block: text left, image right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="md:order-2 overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1758518726775-70e538b0d46e?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div class="md:order-1">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Những gì chúng tôi đã xây dựng</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Đã xác minh, minh bạch và sẵn sàng.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    Mỗi luật sư đều được đội ngũ của chúng tôi xem xét trước khi xuất hiện trên nền tảng. Phí tư vấn được công khai và việc đặt lịch chỉ mất vài phút.
                </p>
            </div>
        </div>
    </section>

    {{-- Stat moment --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1758518731722-320023fb8e66?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div>
                <p class="font-display text-[56px] font-medium leading-none tracking-[-0.03em] md:text-[72px]">
                    500+
                </p>
                <h3 class="mt-5 font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    Luật sư đã xác minh trên khắp Việt Nam.
                </h3>
                <p class="mt-4 max-w-[420px] text-[16px] leading-relaxed text-secondary">
                    Có mặt tại 12 thành phố, với thông tin đoàn luật sư và chứng chỉ hành nghề được kiểm tra trước khi hồ sơ được công bố.
                </p>
            </div>
        </div>
    </section>

    {{-- Testimonial --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="border-y border-text/10 py-20 md:py-24">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">â€œ</span>Cảm giác như có một người bạn tình cờ trở thành luật sư.<span class="text-muted">â€</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Một khách hàng trong vụ ly hôn tại Hà Nội
            </p>
        </div>
    </section>

    {{-- Team --}}
    @php
        $team = [
            [
                'name' => 'Äá»— Thá»‹ Lan',
                'role' => 'Đồng sáng lập, CEO',
                'bio'  => "Tám năm làm luật sư tranh tụng tại một công ty luật hàng đầu ở Hà Nội, sau đó rời đi để xây dựng một cách tiếp cận đơn giản hơn.",
                'portrait' => 'https://images.unsplash.com/photo-1714974528915-4c74c4c0bb27?q=80',
            ],
            [
                'name' => 'Tráº§n Quá»‘c Viá»‡t',
                'role' => 'Đồng sáng lập, Xác minh',
                'bio'  => "Sáu năm làm việc về cấp phép và đạo đức nghề nghiệp tại Liên đoàn Luật sư Việt Nam.",
                'portrait' => 'https://images.unsplash.com/photo-1591702694482-ecc51ff9642e?q=80',
            ],
            [
                'name' => 'Nguyễn Hà My',
                'role' => 'Đồng sáng lập, Sản phẩm',
                'bio'  => "Từng xây dựng các sản phẩm fintech tiêu dùng được hàng triệu người Việt sử dụng.",
                'portrait' => 'https://images.unsplash.com/photo-1733348137479-2e726d326d9b?q=80',
            ],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">đội</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Ba con người, cùng một trăn trở.
        </h2>

        <div class="mt-12 grid gap-10 md:grid-cols-3">
            @foreach ($team as $member)
                <div>
                    <div class="overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $member['portrait'] }}"
                             alt="{{ $member['name'] }}"
                             loading="lazy"
                             class="aspect-[4/5] w-full object-cover object-top grayscale">
                    </div>
                    <h3 class="mt-5 font-display text-[24px] font-medium tracking-tight">{{ $member['name'] }}</h3>
                    <p class="mt-1 text-[12px] uppercase tracking-[0.1em] text-muted">{{ $member['role'] }}</p>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Values --}}
    @php
        $values = [
            ['title' => 'Giá cả minh bạch',     'desc' => 'Giá theo giờ được đăng trước khi bạn đặt.'],
            ['title' => "Chúng tôi không thiên vị", 'desc' => 'Không có phí giới thiệu. Không có bảng xếp hạng trả phí.'],
            ['title' => 'Thông tin xác thực đã được xác minh',    'desc' => 'Mọi luật sư đều xem xét trước khi niêm yết.'],
            ['title' => 'Không có nghĩa vụ',           'desc' => 'Sau khi tư vấn, bước tiếp theo là của bạn.'],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Cách chúng tôi làm việc</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Bốn cam kết.
        </h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-8">
                    <h3 class="font-display text-[24px] font-medium leading-tight tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Sẵn sàng tìm luật sư phù hợp?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Tìm kiếm luật sư â†’</x-button>
        </div>
    </section>
@endsection

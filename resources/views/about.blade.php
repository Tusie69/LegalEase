@extends('layouts.app', ['title' => 'Giới thiệu · LegalEase'])

@section('content')
    {{-- Hero: full-bleed photo with overlay --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1610374792793-f016b77ca51a?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-white/78 via-white/65 to-white/72"></div>
        <div class="absolute inset-0 bg-black/15"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <div class="mx-auto max-w-[960px] rounded-3xl border border-white/60 bg-white/80 px-8 py-10 shadow-2xl backdrop-blur-sm md:px-14 md:py-14">
                <p class="text-[12px] font-semibold uppercase tracking-[0.12em] text-text/70">
                    Câu chuyện của chúng tôi
                </p>

                <h1 class="mx-auto mt-5 max-w-[900px] font-display text-[48px] font-semibold leading-[1.08] tracking-[-0.02em] text-text md:text-[74px]">
                    Trợ giúp pháp lý rõ ràng, không còn mơ hồ.
                </h1>

                <p class="mx-auto mt-6 max-w-[620px] text-[18px] leading-relaxed text-text/85">
                    Chúng tôi kết nối người dùng tại Việt Nam với các luật sư đã được xác minh một cách nhanh chóng và minh bạch.
                </p>
            </div>
        </div>
    </section>

    {{-- Problem block: image left, text right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1726649339367-c2577a28881b?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover">
            </div>
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Vấn đề</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Tìm luật sư bằng truyền miệng chưa bao giờ là chiến lược tốt.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    Với phần lớn người dùng ở Việt Nam, việc tìm luật sư thường bắt đầu bằng hỏi người quen và hy vọng may mắn. Mức phí chênh lệch lớn, năng lực khó kiểm chứng và rủi ro lựa chọn sai rất cao.
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
                     class="aspect-square w-full object-cover">
            </div>
            <div class="md:order-1">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Giải pháp chúng tôi xây dựng</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Xác minh rõ ràng, minh bạch chi phí, đặt lịch nhanh.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    Mỗi luật sư đều được đội ngũ LegalEase rà soát trước khi hiển thị. Mức phí theo giờ được công khai, lịch trống cập nhật liên tục và thao tác đặt lịch chỉ trong vài phút.
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
                     class="aspect-square w-full object-cover">
            </div>
            <div>
                <p class="font-display text-[56px] font-medium leading-none tracking-[-0.03em] md:text-[72px]">
                    500+
                </p>
                <h3 class="mt-5 font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    Luật sư đã xác minh trên toàn quốc.
                </h3>
                <p class="mt-4 max-w-[420px] text-[16px] leading-relaxed text-secondary">
                    Hiện diện tại hơn 12 tỉnh, thành phố với thông tin hành nghề và chứng chỉ được kiểm tra trước khi công khai.
                </p>
            </div>
        </div>
    </section>

    {{-- Testimonial --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="border-y border-text/10 py-20 md:py-24">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">“</span>Cảm giác như có một người bạn tình cờ là luật sư đồng hành cùng mình.<span class="text-muted">”</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Một khách hàng, vụ việc ly hôn tại Hà Nội
            </p>
        </div>
    </section>

    {{-- Team --}}
    @php
        $team = [
            [
                'name' => 'Đỗ Thị Lan',
                'role' => 'Đồng sáng lập, CEO',
                'bio'  => '8 năm kinh nghiệm tranh tụng tại một hãng luật lớn ở Hà Nội. Rời công việc cũ để xây dựng trải nghiệm pháp lý đơn giản hơn cho người dùng.',
                'portrait' => 'https://images.unsplash.com/photo-1714974528915-4c74c4c0bb27?q=80',
            ],
            [
                'name' => 'Trần Quốc Việt',
                'role' => 'Đồng sáng lập, Xác minh',
                'bio'  => 'Từng có 6 năm làm việc trong mảng cấp phép và chuẩn mực hành nghề luật sư, phụ trách quy trình xác minh hồ sơ tại nền tảng.',
                'portrait' => 'https://images.unsplash.com/photo-1591702694482-ecc51ff9642e?q=80',
            ],
            [
                'name' => 'Nguyễn Hà My',
                'role' => 'Đồng sáng lập, Sản phẩm',
                'bio'  => 'Xây dựng nhiều sản phẩm số cho người dùng đại chúng, tập trung vào trải nghiệm đặt lịch, thanh toán và minh bạch thông tin.',
                'portrait' => 'https://images.unsplash.com/photo-1733348137479-2e726d326d9b?q=80',
            ],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Đội ngũ</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Ba con người, một nỗi trăn trở chung.
        </h2>

        <div class="mt-12 grid gap-10 md:grid-cols-3">
            @foreach ($team as $member)
                <div>
                    <div class="overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $member['portrait'] }}"
                             alt="{{ $member['name'] }}"
                             loading="lazy"
                             class="aspect-[4/5] w-full object-cover object-top">
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
            ['title' => 'Giá cả minh bạch', 'desc' => 'Giá theo giờ được hiển thị rõ trước khi bạn đặt lịch.'],
            ['title' => 'Không thiên vị trả phí', 'desc' => 'Không có phí giới thiệu, không có bảng xếp hạng ưu tiên trả tiền.'],
            ['title' => 'Thông tin đã xác minh', 'desc' => 'Mỗi luật sư đều trải qua quy trình xác minh trước khi niêm yết.'],
            ['title' => 'Không ràng buộc', 'desc' => 'Sau buổi tư vấn, bạn hoàn toàn chủ động quyết định bước tiếp theo.'],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Cách chúng tôi làm việc</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Bốn cam kết cốt lõi.
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
            Sẵn sàng tìm luật sư phù hợp với bạn?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Tìm kiếm luật sư →</x-button>
        </div>
    </section>
@endsection

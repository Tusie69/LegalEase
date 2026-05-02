@extends('layouts.app', ['title' => 'Dịch vụ pháp lý · LegalEase'])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $firstHalf  = array_slice($practiceAreas, 0, 3);
    $secondHalf = array_slice($practiceAreas, 3);
@endphp

@section('content')
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1758518731706-be5d5230e5a5?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/65 via-black/45 to-bg/95"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-white/80">
                Chọn theo nhu cầu
            </p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] text-white md:text-[80px]">
                Bạn chưa biết bắt đầu từ đâu?
            </h1>

            <p class="mx-auto mt-8 max-w-[600px] text-[18px] leading-relaxed text-white/90">
                Hầu hết mọi người không chắc mình cần loại luật sư nào cho tình huống cụ thể. Trang này sẽ giúp bạn định hướng rõ ràng.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid auto-rows-fr items-stretch gap-6 md:grid-cols-3">
            @foreach ($firstHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 1])
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="border-y border-text/10 py-16 md:py-20">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">“</span>Bạn sắp ly hôn và cần tranh chấp quyền nuôi con.<span class="text-muted">”</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Đây là kiểu tình huống khiến khách hàng tìm đến chúng tôi
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid auto-rows-fr items-stretch gap-6 md:grid-cols-3">
            @foreach ($secondHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 4])
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-[1280px] px-8 pb-24 pt-32 text-center">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Vẫn chưa chắc chắn?</p>
        <h2 class="mt-6 font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Duyệt danh sách luật sư và lọc theo nhu cầu của bạn.
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            Hơn 500 luật sư đã xác minh tại 12 thành phố, công khai chi phí và thông tin hành nghề.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Duyệt tất cả luật sư →</x-button>
        </div>
    </section>
@endsection

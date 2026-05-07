@extends('layouts.app', ['title' => 'Dịch vụ pháp lý · LegalEase'])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $firstHalf  = array_slice($practiceAreas, 0, 3);
    $secondHalf = array_slice($practiceAreas, 3);
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1758518731706-be5d5230e5a5?q=80"
        eyebrow="Chọn theo nhu cầu">
        Bạn chưa biết bắt đầu từ đâu?

        <x-slot:subtitle>
            Hầu hết mọi người không chắc mình cần loại luật sư nào cho tình huống cụ thể. Trang này sẽ giúp bạn định hướng rõ ràng.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- First half of practice areas --}}
    <section class="container-page pt-24">
        <div class="grid items-stretch gap-6 lg:auto-rows-fr lg:grid-cols-3">
            @foreach ($firstHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 1])
            @endforeach
        </div>
    </section>

    {{-- Pull quote --}}
    <section class="container-page pt-24">
        <div class="border-y border-text/20 py-16 md:py-20">
            <blockquote class="text-pull-quote mx-auto max-w-[900px] text-center">
                <span>“</span>Bạn sắp ly hôn và cần tranh chấp quyền nuôi con.<span>”</span>
            </blockquote>
            <p class="text-eyebrow mt-8 text-center">
                Đây là kiểu tình huống khiến khách hàng tìm đến chúng tôi
            </p>
        </div>
    </section>

    {{-- Second half of practice areas --}}
    <section class="container-page pt-24">
        <div class="grid items-stretch gap-6 lg:auto-rows-fr lg:grid-cols-3">
            @foreach ($secondHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 4])
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="container-page closing-cta">
        <p class="text-eyebrow">Vẫn chưa chắc chắn?</p>
        <h2 class="text-cta-h2 mt-6">
            Duyệt danh sách luật sư và lọc theo nhu cầu của bạn.
        </h2>
        <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
            Hơn 500 luật sư đã xác minh tại 12 thành phố, công khai chi phí và thông tin hành nghề.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Duyệt tất cả luật sư →</x-button>
        </div>
    </section>
@endsection

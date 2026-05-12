@extends('layouts.app', ['title' => 'Dịch vụ pháp lý · LegalEase'])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
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

    <section class="container-page pt-24 md:pt-32">
        <div class="grid items-stretch gap-x-6 gap-y-12 lg:auto-rows-fr lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                @include('partials.legal-services-card', ['area' => $area])
            @endforeach
        </div>
    </section>

    <section class="bg-gold/5 mt-24 md:mt-32">
        <div class="container-page closing-cta">
            <p class="text-eyebrow">Vẫn chưa thấy tình huống của bạn?</p>
            <h2 class="text-cta-h2 mt-6">
                Nói chuyện với chúng tôi.
            </h2>
            <p class="text-body-prose mx-auto mt-6 max-w-[480px]">
                Chỉ cần mô tả ngắn, chúng tôi sẽ giúp bạn xác định loại luật sư cần tìm.
            </p>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
            </div>
        </div>
    </section>
@endsection

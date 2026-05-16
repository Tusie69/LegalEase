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
            Hầu hết mọi người không chắc mình cần luật sư nào cho tình huống cụ thể. Trang này sẽ giúp bạn định hướng rõ ràng.
        </x-slot:subtitle>
    </x-hero-bar>

    <section class="container-page pt-24 md:pt-32">
        <div class="grid items-stretch gap-x-6 gap-y-12 lg:auto-rows-fr lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                @include('partials.legal-services-card', ['area' => $area])
            @endforeach
        </div>
    </section>

    <x-closing-cta
        heading="Nói chuyện với chúng tôi."
        subtitle="Chỉ cần mô tả ngắn, chúng tôi sẽ giúp bạn xác định luật sư cần tìm."
        button="Liên hệ hỗ trợ →"
        :href="route('contact')" />
@endsection

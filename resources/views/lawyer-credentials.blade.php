@extends('layouts.app', ['title' => 'Xác minh thông tin đăng nhập của bạn · LegalEase'])

@php
    $documents = [
        [
            'id'    => 'bar_card',
            'name'  => 'bar_card',
            'label' => 'Thẻ luật sư',
            'desc'  => 'Bản scan hoặc ảnh rõ nét thẻ thành viên đoàn luật sư còn hiệu lực.',
        ],
        [
            'id'    => 'identity_document',
            'name'  => 'identity_document',
            'label' => 'Giấy tờ tùy thân',
            'desc'  => 'CMND hoặc hộ chiếu Việt Nam. Ảnh hoặc PDF.',
        ],
        [
            'id'    => 'education_certificate',
            'name'  => 'education_certificate',
            'label' => 'Bằng cấp',
            'desc'  => 'Bằng cử nhân luật hoặc bằng cấp tương đương.',
        ],
    ];
@endphp

@section('content')
{{-- Visual strip --}}
<div class="relative -mt-18 h-[280px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80"
         alt=""
         class="absolute inset-0 h-full w-full object-cover">
</div>

<section class="mx-auto max-w-[760px] px-8 pt-24 pb-24">
    <p class="text-eyebrow">Đăng ký luật sư</p>
    <h1 class="text-flow-h1 mt-3">
        Gửi giấy tờ của bạn
    </h1>
    <p class="text-flow-intro mt-4 max-w-[560px]">
        Chúng tôi cần ba giấy tờ để xác minh tư cách thành viên đoàn luật sư và danh tính của bạn. Quá trình xem xét diễn ra trong 2 đến 3 ngày làm việc. Thông tin của bạn được lưu trữ an toàn và chỉ đội ngũ xác minh của chúng tôi tiếp cận.
    </p>

    <form method="POST" action="{{ route('lawyer.credentials.store') }}" enctype="multipart/form-data" class="mt-12 space-y-6" novalidate>
        @csrf

        @foreach ($documents as $doc)
            <div class="card-base" x-data="{ filename: '' }">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="min-w-0">
                        <label for="{{ $doc['id'] }}" class="block text-[16px] font-medium text-text">
                            {{ $doc['label'] }} <span class="text-gold">*</span>
                        </label>
                        <p class="mt-1 text-[14px]">{{ $doc['desc'] }}</p>
                        <p class="mt-2 truncate text-[14px]" x-show="filename" x-cloak>
                            <span x-text="filename"></span>
                        </p>
                    </div>
                    <div class="flex-none">
                        <input id="{{ $doc['id'] }}" type="file" name="{{ $doc['name'] }}"
                               accept="image/*,.pdf" required
                               class="hidden"
                               x-on:change="filename = $event.target.files[0]?.name || ''">
                        <label for="{{ $doc['id'] }}"
                               class="inline-flex cursor-pointer items-center rounded-full border border-text/30 px-6 py-3 text-[14px] font-medium text-text transition-colors hover:border-accent hover:text-accent">
                            <span x-text="filename ? 'Đổi tệp' : 'Chọn tệp'">Chọn tệp</span>
                        </label>
                    </div>
                </div>
                <p class="mt-3 text-[12px]">PDF, JPG hoặc PNG. Tối đa 10 MB.</p>
            </div>
        @endforeach

        <div class="pt-4">
            <x-button variant="primary" type="submit" class="w-full">Gửi để xem xét</x-button>
        </div>

        <p class="text-center text-[14px]">
            <a href="{{ route('lawyer.dashboard') }}" class="transition-colors hover:text-accent">
                Quay lại bảng điều khiển
            </a>
        </p>
    </form>
</section>
@endsection

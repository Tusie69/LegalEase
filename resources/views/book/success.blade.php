@extends('layouts.app', ['title' => 'Đã xác nhận đặt chỗ · LegalEase'])

@php
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $user = auth()->user();
    $firstName = $user ? explode(' ', trim($user->name))[0] : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$completed || !$lawyer)
        <div class="card-base-lg">
            <p class="text-[16px]">Không tìm thấy đặt phòng. Duyệt luật sư để làm một cái mới.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-text/70">
                Tìm luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <p class="text-eyebrow">Đã xác nhận đặt chỗ</p>
        <h1 class="text-page-h1 mt-3">
            Hoàn tất{{ $firstName ? ', ' . $firstName : '' }}.
        </h1>
        <p class="text-flow-intro mt-4">
            Chúng tôi đã gửi chi tiết tới email của bạn. {{ $lawyer['name'] }} đã được thông báo.
        </p>

        {{-- Booking card --}}
        <div class="mt-12 card-base-lg">
            <p class="text-eyebrow">Mã đặt chỗ</p>
            <p class="mt-2 font-display text-[28px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-16 w-16 flex-none rounded-full object-cover object-top">
                <div class="min-w-0">
                    <p class="text-card-h4">{{ $lawyer['name'] }}</p>
                    <p class="text-[14px]">{{ $lawyer['primary_specialty'] }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span>Ngày</span>
                    <span class="text-right text-text">{{ \Carbon\Carbon::parse($completed['date'])->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span>Giờ</span>
                    <span class="text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('H:i') }}</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="flex-none">Địa chỉ</span>
                    <span class="text-right text-text">
                        {{ $lawyer['address']['street_address'] ?? '' }}<br>
                        {{ $lawyer['address']['province'] ?? '' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- What happens next --}}
        <div class="mt-12">
            <p class="text-eyebrow">Điều gì xảy ra tiếp theo</p>
            <ul class="mt-6 space-y-4 text-[16px] leading-relaxed">
                <li>Bạn sẽ nhận nhắc nhở qua {{ $completed['contact_preference'] === 'phone' ? 'điện thoại' : 'email' }} 24 giờ trước cuộc hẹn.</li>
                <li>Đến văn phòng sớm vài phút. Mang theo bất kỳ tài liệu nào bạn muốn luật sư xem xét.</li>
                <li>Cần hủy? Hủy trước hơn 24 giờ sẽ được hoàn lại toàn bộ số tiền.</li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="mt-12">
            <x-button variant="primary" href="{{ route('lawyers.index') }}" class="w-full">
                Xem thêm luật sư
            </x-button>
            <p class="mt-4 text-center text-[14px]">
                <a href="/" class="transition-colors hover:text-accent">Trở về trang chủ</a>
            </p>
        </div>
    @endif
</section>
@endsection

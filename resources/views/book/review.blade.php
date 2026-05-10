@extends('layouts.app', ['title' => 'Xem lại đặt lịch của bạn · LegalEase'])

@php
    $booking = session('booking');
    $bookingDetails = session('booking_details');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$booking || !$lawyer || !$bookingDetails)
        <div class="card-base-lg">
            <p class="text-[16px]">Hiện chưa có lượt đặt lịch nào. Hãy chọn luật sư và thời gian phù hợp.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-text/70">
                Duyệt luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <h1 class="text-flow-h1">
            Xem lại lịch hẹn
        </h1>
        <p class="text-flow-intro mt-3">
            Vui lòng xác nhận các thông tin bên dưới.
        </p>

        <div class="mt-12 card-base-lg">
            <div>
                <p class="text-eyebrow">Luật sư</p>
                <div class="mt-4 flex items-center gap-4">
                    <x-responsive-img :src="$lawyer['portrait_url']"
                                      alt=""
                                      sizes="64px"
                                      :widths="[200, 400]"
                                      class="h-16 w-16 flex-none rounded-full object-cover object-top" />
                    <div class="min-w-0">
                        <p class="text-card-h3">{{ $lawyer['name'] }}</p>
                        <p class="text-[14px]">
                            {{ $lawyer['primary_specialty'] }}@if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }}@endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div>
                <p class="text-eyebrow">Thời gian</p>
                <p class="mt-3 text-[18px] text-text">
                    {{ \Illuminate\Support\Str::title(\Carbon\Carbon::parse($booking['date'])->translatedFormat('l, d/m/Y')) }}
                </p>
                <p class="mt-1 text-[16px]">
                    {{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('H:i') }} · Buổi tư vấn 60 phút
                </p>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div>
                <p class="text-eyebrow">Địa điểm</p>
                <p class="mt-3 text-[16px] text-text">
                    {{ $lawyer['address']['street_address'] ?? '' }}
                </p>
                <p class="text-[16px]">
                    {{ $lawyer['address']['province'] ?? '' }}
                </p>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div>
                <p class="text-eyebrow">Tùy chọn</p>
                <div class="mt-3 grid grid-cols-2 gap-4 text-[14px]">
                    <div>
                        <p>Ngôn ngữ cuộc họp</p>
                        <p class="mt-1 text-text">{{ $bookingDetails['meeting_language'] === 'vi' ? 'Tiếng Việt' : 'Tiếng Anh' }}</p>
                    </div>
                    <div>
                        <p>Liên hệ để xác nhận</p>
                        <p class="mt-1 text-text">{{ ucfirst($bookingDetails['contact_preference']) }}</p>
                    </div>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div>
                <p class="text-eyebrow">Thanh toán</p>
                <div class="mt-3 text-[14px]">
                    <p>Phí tư vấn</p>
                    <p class="text-card-h3 mt-1 text-text">
                        {{ number_format($lawyer['price_per_hour']) }} VND
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <x-button variant="primary" :href="route('book.payment')" class="w-full">Tiếp tục thanh toán</x-button>
        </div>

        <p class="mt-4 text-center text-[14px]">
            <a href="{{ route('book.details') }}" class="transition-colors hover:text-accent">
                Chỉnh sửa tùy chọn
            </a>
            <span class="mx-2 text-text/40">·</span>
            <a href="{{ route('lawyers.show', ['slug' => $booking['lawyer_slug']]) }}" class="transition-colors hover:text-accent">
                Đổi khung giờ
            </a>
        </p>
    @endif
</section>
@endsection

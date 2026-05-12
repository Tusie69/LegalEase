@extends('layouts.app', ['title' => 'Cuộc hẹn · LegalEase'])

@php
    $start = \Carbon\Carbon::parse($appointment['date'] . ' ' . $appointment['time']);
    $isUpcoming = $appointment['status'] === 'CONFIRMED' && $start->isFuture();
    $isAwaitingOutcome = $appointment['status'] === 'CONFIRMED' && $start->isPast();
    $isCompleted = $appointment['status'] === 'COMPLETED';
    $isNoShow = $appointment['status'] === 'NO_SHOW_BY_CUSTOMER';
@endphp

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.dashboard') }}" class="text-caption transition-colors hover:text-text/60">
        ← Quay lại bảng điều khiển
    </a>

    <h1 class="mt-10 text-flow-h1">
        Cuộc hẹn với {{ $appointment['customer_name'] }}
    </h1>
    <p class="mt-4 text-caption">{{ $appointment['booking_code'] }}</p>

    {{-- Customer card --}}
    <div class="mt-12 card-base">
        <div class="flex items-center gap-5">
            <div class="flex h-20 w-20 flex-none items-center justify-center rounded-full bg-text/10">
                <span class="text-card-h3 text-text">{{ $appointment['customer_initials'] }}</span>
            </div>
            <div class="min-w-0">
                <p class="text-card-h3">{{ $appointment['customer_name'] }}</p>
                <p class="text-caption">
                    <a href="tel:{{ str_replace(' ', '', $appointment['customer_phone']) }}" class="transition-colors hover:text-text/60">
                        {{ $appointment['customer_phone'] }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    {{-- When --}}
    <div class="mt-10">
        <p class="text-eyebrow">Thời gian</p>
        <p class="text-card-h4 mt-2">
            {{ \Illuminate\Support\Str::title($start->translatedFormat('l, d/m/Y')) }}
        </p>
        <p class="text-caption">
            {{ $start->format('H:i') }} · 60 phút
        </p>
    </div>

    {{-- Status --}}
    <div class="mt-16 border-t border-text/20 pt-12">
        <p class="text-eyebrow">Tình trạng</p>

        @if ($isUpcoming)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-form-label text-success">Đã xác nhận</span>
            </div>
            <p class="mt-6 max-w-[520px] text-body">
                Khách hàng đã thanh toán đặt cọc. Sau khi buổi tư vấn kết thúc, hãy quay lại đây để báo cáo kết quả.
            </p>
        @elseif ($isAwaitingOutcome)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-gold/40 bg-gold/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-gold"></span>
                <span class="text-form-label text-gold">Đang chờ kết quả</span>
            </div>
            <p class="mt-6 max-w-[520px] text-body">
                Đã qua giờ hẹn. Hãy báo cáo buổi tư vấn có diễn ra hay không để chúng tôi xử lý thanh toán và mở phần đánh giá của khách hàng.
            </p>
            <div class="mt-8">
                <x-button variant="primary" :href="route('lawyer.appointments.outcome', $appointment['booking_code'])">
                    Báo cáo kết quả
                </x-button>
            </div>
        @elseif ($isCompleted)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-form-label text-success">Hoàn tất</span>
            </div>
            <p class="mt-6 max-w-[520px] text-body">
                Bạn đã báo cáo buổi tư vấn này hoàn tất vào ngày {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('d/m/Y') }}.
            </p>
        @elseif ($isNoShow)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-form-label text-error">Khách hàng vắng mặt</span>
            </div>
            <p class="mt-6 max-w-[520px] text-body">
                Đã báo cáo vào ngày {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('d/m/Y') }}. Khách hàng mất khoản đặt cọc. Phần bồi hoàn của bạn (25% tiền đặt cọc) sẽ được xử lý trong 3 đến 5 ngày làm việc.
            </p>
        @endif
    </div>

    {{-- Customer review --}}
    @if ($isCompleted && !empty($appointment['customer_review']))
        <div class="mt-12 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Đánh giá của khách hàng</p>
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <x-rating-stars :rating="$appointment['customer_review']['stars']" size="md" />
                <span class="text-caption">
                    Đã gửi {{ \Carbon\Carbon::parse($appointment['customer_review']['reviewed_at'])->format('d/m/Y') }}
                </span>
            </div>
            @if (!empty($appointment['customer_review']['review_text']))
                <blockquote class="mt-6 text-body-prose">
                    “{{ $appointment['customer_review']['review_text'] }}”
                </blockquote>
            @endif
            <p class="mt-6 text-caption">
                Nếu đánh giá này vi phạm nguyên tắc của chúng tôi, bạn có thể
                <a href="{{ route('contact') }}" class="text-text transition-colors hover:text-text/60">gắn cờ để quản trị viên xem xét →</a>
            </p>
        </div>
    @endif
</section>
@endsection

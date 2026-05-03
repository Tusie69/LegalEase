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
    <a href="{{ route('lawyer.dashboard') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
        ← Quay lại bảng điều khiển
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Lịch hẹn</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        Lịch hẹn với {{ $appointment['customer_name'] }}
    </h1>
    <p class="mt-4 text-[14px] text-muted">{{ $appointment['booking_code'] }}</p>

    {{-- Customer card --}}
    <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-5">
            <div class="flex h-20 w-20 flex-none items-center justify-center rounded-full bg-avatar">
                <span class="font-display text-[22px] font-medium text-text">{{ $appointment['customer_initials'] }}</span>
            </div>
            <div class="min-w-0">
                <p class="font-display text-[22px] font-medium tracking-tight">{{ $appointment['customer_name'] }}</p>
                <p class="text-[14px] text-muted">
                    <a href="tel:{{ str_replace(' ', '', $appointment['customer_phone']) }}" class="transition-colors hover:text-accent">
                        {{ $appointment['customer_phone'] }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    {{-- When --}}
    <div class="mt-10">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thời gian</p>
        <p class="mt-2 font-display text-[20px] font-medium tracking-tight">
            {{ $start->format('l, F j, Y') }}
        </p>
        <p class="text-[14px] text-secondary">
            {{ $start->format('g:i A') }} · 60 phút
        </p>
    </div>

    {{-- Status --}}
    <div class="mt-16 border-t border-text/10 pt-12">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Trạng thái</p>

        @if ($isUpcoming)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">Đã xác nhận</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Khách hàng đã thanh toán tiền đặt cọc. Sau khi buổi tư vấn kết thúc, hãy quay lại đây để báo cáo kết quả.
            </p>
        @elseif ($isAwaitingOutcome)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-gold/40 bg-gold/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-gold"></span>
                <span class="text-[13px] font-medium text-gold">Đang chờ kết quả</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Thời gian hẹn đã qua. Hãy báo cáo buổi hẹn có diễn ra hay không để chúng tôi xử lý thanh toán và mở phần đánh giá của khách hàng.
            </p>
            <div class="mt-8">
                <x-button variant="primary" :href="route('lawyer.appointments.outcome', $appointment['booking_code'])">
                    Báo cáo kết quả
                </x-button>
            </div>
        @elseif ($isCompleted)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">Đã hoàn tất</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Bạn đã báo cáo buổi tư vấn này hoàn tất vào {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('M j, Y') }}.
            </p>
        @elseif ($isNoShow)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-[13px] font-medium text-error">Khách hàng vắng mặt</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Đã báo cáo vào {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('M j, Y') }}. Khách hàng mất tiền đặt cọc. Khoản bồi hoàn cho bạn (25% tiền đặt cọc) sẽ được xử lý trong 3 đến 5 ngày làm việc.
            </p>
        @endif
    </div>

    {{-- Customer review (if any) --}}
    @if ($isCompleted && !empty($appointment['customer_review']))
        <div class="mt-12 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Đánh giá của khách hàng</p>
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <x-rating-stars :rating="$appointment['customer_review']['stars']" size="md" />
                <span class="text-[13px] text-muted">
                    Đã gửi vào {{ \Carbon\Carbon::parse($appointment['customer_review']['reviewed_at'])->format('M j, Y') }}
                </span>
            </div>
            @if (!empty($appointment['customer_review']['review_text']))
                <blockquote class="mt-6 border-l-2 border-text/10 pl-5 text-[17px] leading-relaxed text-secondary">
                    “{{ $appointment['customer_review']['review_text'] }}”
                </blockquote>
            @endif
            <p class="mt-6 text-[13px] text-muted">
                Nếu đánh giá này vi phạm hướng dẫn của chúng tôi, bạn có thể
                <a href="{{ route('contact') }}" class="text-text transition-colors hover:text-accent">gắn cờ để quản trị viên xem xét →</a>
            </p>
        </div>
    @endif
</section>
@endsection

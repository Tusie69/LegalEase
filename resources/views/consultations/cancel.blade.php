@extends('layouts.app', ['title' => 'Hủy tư vấn · LegalEase'])

@php
    $consultationStart = \Carbon\Carbon::parse($consultation['date'] . ' ' . $consultation['time']);
    $hoursUntil = (int) now()->diffInHours($consultationStart, false);
    $eligibleForRefund = $hoursUntil > 24;
@endphp

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('consultations.show', $consultation['booking_code']) }}"
       class="text-[14px] text-muted transition-colors hover:text-accent">
        ← Quay lại buổi tư vấn
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Hủy tư vấn</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        Bạn muốn hủy buổi tư vấn?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        Thao tác này không thể hoàn tác.
        @if ($eligibleForRefund)
            Bạn sẽ được hoàn lại toàn bộ tiền đặt cọc trong 3 đến 5 ngày làm việc.
        @else
            Các lịch hủy trong vòng 24 giờ trước giờ hẹn sẽ không đủ điều kiện hoàn tiền.
        @endif
    </p>

    {{-- Lawyer + when summary --}}
    <div class="mt-10 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-4">
            <img src="{{ $lawyer['portrait_url'] }}" alt=""
                 class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
            <div class="min-w-0">
                <p class="font-display text-[18px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
            </div>
        </div>

        <div class="mt-5 border-t border-text/10 pt-5">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thời gian</p>
            <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                {{ $consultationStart->format('l, F j, Y') }} · {{ $consultationStart->format('g:i A') }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('consultations.cancel.store', $consultation['booking_code']) }}"
          class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-4">
        @csrf
        <x-button variant="primary" type="submit">Có, hủy tư vấn</x-button>
        <a href="{{ route('consultations.show', $consultation['booking_code']) }}"
           class="text-[14px] text-muted transition-colors hover:text-accent">
            Giữ buổi tư vấn của tôi
        </a>
    </form>
</section>
@endsection

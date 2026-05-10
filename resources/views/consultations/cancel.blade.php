@extends('layouts.app', ['title' => 'Hủy tư vấn · LegalEase'])

@php
    $consultationStart = \Carbon\Carbon::parse($consultation['date'] . ' ' . $consultation['time']);
    $hoursUntil = (int) now()->diffInHours($consultationStart, false);
    $eligibleForRefund = $hoursUntil > 24;
@endphp

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('consultations.show', $consultation['booking_code']) }}"
       class="text-[14px] transition-colors hover:text-accent">
        ← Quay lại buổi tư vấn
    </a>

    <p class="mt-10 text-eyebrow">Hủy tư vấn</p>
    <h1 class="text-flow-h1 mt-3">
        Hủy buổi tư vấn của bạn?
    </h1>
    <p class="text-flow-intro mt-4">
        Hành động này không thể hoàn tác.
        @if ($eligibleForRefund)
            Bạn sẽ được hoàn lại toàn bộ tiền đặt cọc trong 3 đến 5 ngày làm việc.
        @else
            Hủy trong vòng 24 giờ trước cuộc hẹn không được hoàn tiền.
        @endif
    </p>

    <div class="mt-10 card-base">
        <div class="flex items-center gap-4">
            <x-responsive-img :src="$lawyer['portrait_url']"
                              alt=""
                              sizes="56px"
                              :widths="[200, 400]"
                              class="h-14 w-14 flex-none rounded-full object-cover object-top" />
            <div class="min-w-0">
                <p class="text-card-h5">{{ $lawyer['name'] }}</p>
                <p class="text-[14px]">{{ $lawyer['primary_specialty'] }}</p>
            </div>
        </div>

        <div class="mt-5 border-t border-text/20 pt-5">
            <p class="text-eyebrow">Thời gian</p>
            <p class="text-card-h6 mt-1">
                {{ \Illuminate\Support\Str::title($consultationStart->translatedFormat('l, d/m/Y')) }} · {{ $consultationStart->format('H:i') }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('consultations.cancel.store', $consultation['booking_code']) }}"
          class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-4">
        @csrf
        <x-button variant="primary" type="submit">Có, hủy tư vấn</x-button>
        <a href="{{ route('consultations.show', $consultation['booking_code']) }}"
           class="text-[14px] transition-colors hover:text-accent">
            Giữ buổi tư vấn
        </a>
    </form>
</section>
@endsection

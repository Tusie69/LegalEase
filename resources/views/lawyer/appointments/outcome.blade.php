@extends('layouts.app', ['title' => 'Báo cáo kết quả · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
       class="text-caption transition-colors hover:text-text/60">
        ← Quay lại cuộc hẹn
    </a>

    <p class="mt-10 text-eyebrow">Báo cáo kết quả</p>
    <h1 class="mt-3 text-flow-h1">
        Buổi tư vấn thế nào?
    </h1>
    <p class="mt-4 text-body-prose">
        Sau khi bạn chọn, chúng tôi sẽ giải ngân, cập nhật lịch hẹn, và mở phần đánh giá của khách hàng hoặc xử lý trường hợp vắng mặt.
    </p>

    {{-- Customer summary --}}
    <div class="mt-10 flex items-center gap-4 rounded-2xl border border-text/20 bg-bg p-5">
        <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-text/10">
            <span class="text-card-h6 text-text">{{ $appointment['customer_initials'] }}</span>
        </div>
        <div class="min-w-0">
            <p class="text-card-h5">{{ $appointment['customer_name'] }}</p>
            <p class="text-caption">
                {{ \Carbon\Carbon::parse($appointment['date'])->format('d/m/Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appointment['time'])->format('H:i') }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('lawyer.appointments.outcome.store', $appointment['booking_code']) }}"
          class="mt-10 space-y-8" novalidate
          x-data="{ outcome: '{{ old('outcome', '') }}' }">
        @csrf

        <div class="space-y-4">
            {{-- Outcome A --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="completed" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-bg p-6 transition-colors"
                     :class="outcome === 'completed' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'completed' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'completed' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="text-card-h4">Cuộc hẹn đã hoàn tất</p>
                            <p class="mt-2 text-caption leading-relaxed">
                                Khách hàng đã đến và buổi tư vấn đã diễn ra. Nền tảng giữ toàn bộ khoản đặt cọc. Khách hàng có thể để lại đánh giá.
                            </p>
                        </div>
                    </div>
                </div>
            </label>

            {{-- Outcome B --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="no_show_customer" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-bg p-6 transition-colors"
                     :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'no_show_customer' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="text-card-h4">Khách hàng không xuất hiện</p>
                            <p class="mt-2 text-caption leading-relaxed">
                                Khách hàng mất khoản đặt cọc. Bạn nhận 25% khoản đặt cọc (5% phí tư vấn) như khoản bồi thường cho thời gian đã dành.
                            </p>
                        </div>
                    </div>
                </div>
            </label>
        </div>

        @error('outcome') <p class="text-caption text-error">{{ $message }}</p> @enderror

        <div class="flex flex-wrap items-center gap-x-6 gap-y-4">
            <x-button variant="primary" type="submit" x-bind:disabled="!outcome"
                      x-bind:class="!outcome ? 'opacity-50 cursor-not-allowed' : ''">
                Gửi kết quả
            </x-button>
            <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
               class="text-caption transition-colors hover:text-text/60">
                Hủy
            </a>
        </div>
    </form>
</section>
@endsection

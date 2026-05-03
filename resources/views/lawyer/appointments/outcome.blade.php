@extends('layouts.app', ['title' => 'Báo cáo kết quả · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
       class="text-[14px] text-muted transition-colors hover:text-accent">
        ← Quay lại lịch hẹn
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Báo cáo kết quả</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        Buổi tư vấn diễn ra thế nào?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        Sau khi bạn chọn, chúng tôi sẽ xử lý thanh toán, cập nhật lịch hẹn và mở phần đánh giá của khách hàng hoặc xử lý trường hợp vắng mặt.
    </p>

    {{-- Customer summary --}}
    <div class="mt-10 flex items-center gap-4 rounded-2xl border border-text/10 bg-surface p-5">
        <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
            <span class="font-display text-[15px] font-medium text-text">{{ $appointment['customer_initials'] }}</span>
        </div>
        <div class="min-w-0">
            <p class="font-display text-[18px] font-medium tracking-tight">{{ $appointment['customer_name'] }}</p>
            <p class="text-[13px] text-muted">
                {{ \Carbon\Carbon::parse($appointment['date'])->format('M j, Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appointment['time'])->format('g:i A') }}
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
                <div class="rounded-2xl border bg-surface p-6 transition-colors"
                     :class="outcome === 'completed' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'completed' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'completed' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">Cuộc hẹn đã hoàn tất</p>
                            <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                                Khách hàng đã tham dự và buổi tư vấn đã diễn ra. Nền tảng giữ toàn bộ tiền đặt cọc. Khách hàng hiện có thể để lại đánh giá.
                            </p>
                        </div>
                    </div>
                </div>
            </label>

            {{-- Outcome B --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="no_show_customer" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-surface p-6 transition-colors"
                     :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'no_show_customer' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">Khách hàng không xuất hiện</p>
                            <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                                Khách hàng mất tiền đặt cọc. Bạn sẽ nhận 25% tiền đặt cọc (tương đương 5% phí tư vấn) để bồi hoàn cho thời gian đã giữ lịch.
                            </p>
                        </div>
                    </div>
                </div>
            </label>
        </div>

        @error('outcome') <p class="text-[13px] text-error">{{ $message }}</p> @enderror

        <div class="flex flex-wrap items-center gap-x-6 gap-y-4">
            <x-button variant="primary" type="submit" x-bind:disabled="!outcome"
                      x-bind:class="!outcome ? 'opacity-50 cursor-not-allowed' : ''">
                Gửi kết quả
            </x-button>
            <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
               class="text-[14px] text-muted transition-colors hover:text-accent">
                Hủy
            </a>
        </div>
    </form>
</section>
@endsection

@extends('layouts.app', ['title' => 'Một vài chi tiết cuối cùng · LegalEase'])

@php
    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8 max-w-[560px]">
            <p class="text-[15px] text-muted">Không tìm thấy bối cảnh đặt phòng. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Tìm luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <div class="max-w-[760px]">
            <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
                A few last details
            </h1>
            <p class="mt-3 text-[17px] text-secondary">
                We'll use these to confirm your booking.
            </p>
        </div>

        <div class="mt-12 grid gap-10 md:grid-cols-[1fr_320px] md:gap-12">
            {{-- Form --}}
            <div class="order-2 md:order-1">
                <form method="POST" action="{{ route('book.details.store') }}" class="space-y-8" novalidate>
                    @csrf

                    {{-- Meeting language --}}
                    <div>
                        <p class="text-[13px] font-medium text-muted">Ngôn ngữ cuộc họp</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="meeting_language" value="vi"
                                       @checked(old('meeting_language') === 'vi')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>Vietnamese</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="meeting_language" value="en"
                                       @checked(old('meeting_language') === 'en')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>English</span>
                            </label>
                        </div>
                        @error('meeting_language') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Contact preference --}}
                    <div>
                        <p class="text-[13px] font-medium text-muted">Liên hệ ưu tiên để xác nhận và nhắc nhở</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="contact_preference" value="phone"
                                       @checked(old('contact_preference') === 'phone')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>Phone</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="contact_preference" value="email"
                                       @checked(old('contact_preference') === 'email')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>Email</span>
                            </label>
                        </div>
                        @error('contact_preference') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Terms --}}
                    <label class="flex items-start gap-3 text-[13px] text-muted">
                        <input type="checkbox" name="agreed_terms" value="1"
                               @checked(old('agreed_terms'))
                               class="mt-0.5 h-4 w-4 flex-none rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span class="leading-relaxed">
                            I agree to the
                            <a href="#" class="text-text transition-colors hover:text-accent">chính sách hủy</a>
                            and consultation terms. Cancellations more than 24 hours before the appointment are eligible for a full refund.
                        </span>
                    </label>
                    @error('agreed_terms') <p class="text-[13px] text-error">{{ $message }}</p> @enderror

                    <div class="pt-2">
                        <x-button variant="primary" type="submit" class="w-full">Tiếp tục xem xét</x-button>
                    </div>
                </form>
            </div>

            {{-- Booking summary --}}
            <aside class="order-1 md:order-2 md:sticky md:top-[88px] md:self-start">
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">đặt phòng của bạn</p>

                    <div class="mt-5 flex items-center gap-3">
                        <img src="{{ $lawyer['portrait_url'] }}" alt=""
                             loading="lazy"
                             class="h-14 w-14 flex-none rounded-full object-cover object-top">
                        <div class="min-w-0">
                            <p class="font-display text-[18px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                            <p class="truncate text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-3 border-t border-text/10 pt-5 text-[14px]">
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-muted">Date</span>
                            <span class="text-text">{{ \Carbon\Carbon::parse($booking['date'])->format('M j, Y') }}</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-muted">Time</span>
                            <span class="text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('g:i A') }}</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-muted">Fee</span>
                            <span class="text-text">{{ number_format($lawyer['price_per_hour']) }} VND</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</section>
@endsection

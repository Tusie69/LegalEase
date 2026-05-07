@extends('layouts.app', ['title' => 'Một vài chi tiết cuối cùng · LegalEase'])

@php
    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="card-base-lg max-w-[560px]">
            <p class="text-[16px]">Không tìm thấy bối cảnh đặt phòng. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-text/70">
                Tìm luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <div class="max-w-[760px]">
            <h1 class="text-flow-h1">
                Vài chi tiết cuối
            </h1>
            <p class="text-flow-intro mt-3">
                Chúng tôi sẽ dùng các thông tin này để xác nhận lịch hẹn của bạn.
            </p>
        </div>

        <div class="mt-12 grid gap-10 md:grid-cols-[1fr_320px] md:gap-12">
            {{-- Form --}}
            <div class="order-2 md:order-1">
                <form method="POST" action="{{ route('book.details.store') }}" class="space-y-8" novalidate>
                    @csrf

                    {{-- Meeting language --}}
                    <div>
                        <p class="text-[14px] font-medium">Ngôn ngữ cuộc họp</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/20 bg-bg px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="meeting_language" value="vi"
                                       @checked(old('meeting_language') === 'vi')
                                       class="h-4 w-4 border-text/30 bg-bg text-accent focus:ring-0">
                                <span>Tiếng Việt</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/20 bg-bg px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="meeting_language" value="en"
                                       @checked(old('meeting_language') === 'en')
                                       class="h-4 w-4 border-text/30 bg-bg text-accent focus:ring-0">
                                <span>Tiếng Anh</span>
                            </label>
                        </div>
                        @error('meeting_language') <p class="mt-2 text-[14px] text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Contact preference --}}
                    <div>
                        <p class="text-[14px] font-medium">Liên hệ ưu tiên để xác nhận và nhắc nhở</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/20 bg-bg px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="contact_preference" value="phone"
                                       @checked(old('contact_preference') === 'phone')
                                       class="h-4 w-4 border-text/30 bg-bg text-accent focus:ring-0">
                                <span>Điện thoại</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/20 bg-bg px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="contact_preference" value="email"
                                       @checked(old('contact_preference') === 'email')
                                       class="h-4 w-4 border-text/30 bg-bg text-accent focus:ring-0">
                                <span>Email</span>
                            </label>
                        </div>
                        @error('contact_preference') <p class="mt-2 text-[14px] text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Terms --}}
                    <label class="flex items-start gap-3 text-[14px]">
                        <input type="checkbox" name="agreed_terms" value="1"
                               @checked(old('agreed_terms'))
                               class="mt-0.5 h-4 w-4 flex-none rounded border-text/20 bg-bg text-accent focus:ring-accent">
                        <span class="leading-relaxed">
                            Tôi đồng ý với
                            <a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">chính sách hủy</a>
                            và điều khoản tư vấn. Hủy trước hơn 24 giờ trước cuộc hẹn sẽ được hoàn lại toàn bộ số tiền.
                        </span>
                    </label>
                    @error('agreed_terms') <p class="text-[14px] text-error">{{ $message }}</p> @enderror

                    <div class="pt-2">
                        <x-button variant="primary" type="submit" class="w-full">Tiếp tục xem xét</x-button>
                    </div>
                </form>
            </div>

            {{-- Booking summary --}}
            <aside class="order-1 md:order-2 md:sticky md:top-[88px] md:self-start">
                <div class="card-base">
                    <p class="text-eyebrow">Lịch hẹn của bạn</p>

                    <div class="mt-5 flex items-center gap-3">
                        <img src="{{ $lawyer['portrait_url'] }}" alt=""
                             loading="lazy"
                             class="h-14 w-14 flex-none rounded-full object-cover object-top">
                        <div class="min-w-0">
                            <p class="text-card-h5">{{ $lawyer['name'] }}</p>
                            <p class="truncate text-[14px]">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-3 border-t border-text/20 pt-5">
                        <div>
                            <p class="text-eyebrow">Ngày</p>
                            <p class="mt-0.5 text-[14px] text-text">{{ \Carbon\Carbon::parse($booking['date'])->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-eyebrow">Giờ</p>
                            <p class="mt-0.5 text-[14px] text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-eyebrow">Phí</p>
                            <p class="mt-0.5 text-[14px] text-text">{{ number_format($lawyer['price_per_hour']) }} VND</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</section>
@endsection

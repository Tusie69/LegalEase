@extends('layouts.app', ['title' => 'Một vài chi tiết cuối cùng · LegalEase'])

@php
    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
    $bookingDetails = session('booking_details', []);
    $currentLang = old('meeting_language', $bookingDetails['meeting_language'] ?? null);
    $currentContact = old('contact_preference', $bookingDetails['contact_preference'] ?? null);
    $currentAgreed = old('agreed_terms', $bookingDetails['agreed_terms'] ?? false);
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="card-base-lg max-w-[560px]">
            <p class="text-body">Không tìm thấy bối cảnh đặt phòng. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-form-label text-text transition-colors hover:text-text/70">
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
                        <p class="text-form-label">Ngôn ngữ cuộc họp</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center rounded-xl border border-text/20 bg-bg px-4 py-3 text-caption text-text transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent/5 has-[:checked]:text-accent">
                                <input type="radio" name="meeting_language" value="vi"
                                       @checked($currentLang === 'vi')
                                       class="sr-only">
                                <span>Tiếng Việt</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center rounded-xl border border-text/20 bg-bg px-4 py-3 text-caption text-text transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent/5 has-[:checked]:text-accent">
                                <input type="radio" name="meeting_language" value="en"
                                       @checked($currentLang === 'en')
                                       class="sr-only">
                                <span>Tiếng Anh</span>
                            </label>
                        </div>
                        @error('meeting_language') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Contact preference --}}
                    <div>
                        <p class="text-form-label">Liên hệ ưu tiên để xác nhận và nhắc nhở</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center rounded-xl border border-text/20 bg-bg px-4 py-3 text-caption text-text transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent/5 has-[:checked]:text-accent">
                                <input type="radio" name="contact_preference" value="phone"
                                       @checked($currentContact === 'phone')
                                       class="sr-only">
                                <span>Điện thoại</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center rounded-xl border border-text/20 bg-bg px-4 py-3 text-caption text-text transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent/5 has-[:checked]:text-accent">
                                <input type="radio" name="contact_preference" value="email"
                                       @checked($currentContact === 'email')
                                       class="sr-only">
                                <span>Email</span>
                            </label>
                        </div>
                        @error('contact_preference') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Terms --}}
                    <label class="flex items-start gap-3 text-caption">
                        <input type="checkbox" name="agreed_terms" value="1"
                               @checked($currentAgreed)
                               class="mt-0.5 h-4 w-4 flex-none rounded border-text/20 bg-bg text-accent focus:ring-accent">
                        <span class="leading-relaxed">
                            Tôi đồng ý với
                            <a href="{{ route('terms') }}" class="text-text underline underline-offset-2 transition-colors hover:text-text/60">chính sách hủy</a>
                            và điều khoản tư vấn. Hủy trước hơn 24 giờ trước cuộc hẹn sẽ được hoàn lại toàn bộ số tiền.
                        </span>
                    </label>
                    @error('agreed_terms') <p class="text-caption text-error">{{ $message }}</p> @enderror

                    <div class="pt-2">
                        <x-button variant="primary" type="submit" class="w-full">Tiếp tục xem xét</x-button>
                    </div>

                    <p class="text-center text-caption">
                        <a href="{{ route('book.review') }}" class="transition-colors hover:text-text/60">
                            ← Quay lại trang xác nhận
                        </a>
                    </p>
                </form>
            </div>

            {{-- Booking summary --}}
            <aside class="order-1 md:order-2 md:sticky md:top-[88px] md:self-start">
                <div class="card-base">
                    <p class="text-eyebrow">Lịch hẹn của bạn</p>

                    <div class="mt-5 flex items-center gap-3">
                        <x-responsive-img :src="$lawyer['portrait_url']"
                                          alt=""
                                          sizes="56px"
                                          :widths="[200, 400]"
                                          class="h-14 w-14 flex-none rounded-full object-cover object-top" />
                        <div class="min-w-0">
                            <p class="text-card-h5">{{ $lawyer['name'] }}</p>
                            <p class="truncate text-caption">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    <div class="mt-5 border-t border-text/20 pt-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-eyebrow">Ngày</p>
                                <p class="mt-0.5 text-caption text-text">{{ \Carbon\Carbon::parse($booking['date'])->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-eyebrow">Giờ</p>
                                <p class="mt-0.5 text-caption text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('H:i') }}</p>
                            </div>
                        </div>

                        <div class="mt-5 border-t border-text/20 pt-5">
                            <p class="text-eyebrow">Phí</p>
                            <p class="text-card-h4 mt-1 text-accent">{{ number_format($lawyer['price_per_hour']) }} VND</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</section>
@endsection

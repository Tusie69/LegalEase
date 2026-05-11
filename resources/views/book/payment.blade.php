@extends('layouts.app', ['title' => 'Thanh toán · LegalEase'])

@php
    use Carbon\Carbon;

    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
    $fee = $lawyer['price_per_hour'] ?? 0;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="card-base-lg">
            <p class="text-body">Không có đặt phòng nào đang diễn ra. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-form-label text-text transition-colors hover:text-text/70">
                Tìm luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <h1 class="text-flow-h1">
            Thanh toán
        </h1>
        <p class="mt-3 text-body-prose">
            Bạn có thể thanh toán ngay để hoàn tất đặt chỗ, hoặc thanh toán trực tiếp cho luật sư tại buổi tư vấn.
        </p>

        {{-- Booking summary --}}
        <div class="mt-12 card-base-lg">
            {{-- Lawyer --}}
            <div class="flex items-center gap-4">
                <x-responsive-img :src="$lawyer['portrait_url']"
                                  alt=""
                                  sizes="64px"
                                  :widths="[200, 400]"
                                  class="h-16 w-16 flex-none rounded-full object-cover object-top" />
                <div class="min-w-0">
                    <p class="text-card-h3">{{ $lawyer['name'] }}</p>
                    <p class="text-caption">
                        {{ $lawyer['primary_specialty'] }}@if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }}@endif
                    </p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Time + Location --}}
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-eyebrow">Thời gian</p>
                    <p class="mt-3 text-body text-text">
                        {{ \Illuminate\Support\Str::title(Carbon::parse($booking['date'])->translatedFormat('l, d/m/Y')) }}
                    </p>
                    <p class="text-body">
                        {{ Carbon::createFromFormat('H:i', $booking['time'])->format('H:i') }} · Buổi tư vấn 60 phút
                    </p>
                </div>
                <div>
                    <p class="text-eyebrow">Địa điểm</p>
                    <p class="mt-3 text-body text-text">
                        {{ $lawyer['address']['street_address'] ?? '' }}
                    </p>
                    <p class="text-body">
                        {{ $lawyer['address']['province'] ?? '' }}
                    </p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Fee --}}
            <div>
                <p class="text-eyebrow">Phí tư vấn</p>
                <p class="text-card-h3 mt-2 text-accent">{{ number_format($fee) }} VND</p>
            </div>
        </div>

        {{-- Payment form --}}
        <form method="POST" action="{{ route('book.payment.store') }}" class="mt-10" novalidate
              x-data="{ timing: 'now', method: 'card' }">
            @csrf
            <input type="hidden" name="timing" :value="timing">
            <input type="hidden" name="method" :value="timing === 'now' ? method : 'later'">

            {{-- Timing choice --}}
            <p class="text-eyebrow">Khi nào thanh toán?</p>
            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                <button type="button" @click="timing = 'now'"
                        :class="timing === 'now' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-5 py-4 text-left transition-colors">
                    <p class="text-form-label" :class="timing === 'now' ? 'text-accent' : 'text-text'">Thanh toán ngay</p>
                    <p class="text-caption mt-1" :class="timing === 'now' ? 'text-accent/80' : 'text-text/70'">Hoàn tất đặt chỗ với thanh toán trực tuyến.</p>
                </button>
                <button type="button" @click="timing = 'later'"
                        :class="timing === 'later' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-5 py-4 text-left transition-colors">
                    <p class="text-form-label" :class="timing === 'later' ? 'text-accent' : 'text-text'">Thanh toán tại buổi hẹn</p>
                    <p class="text-caption mt-1" :class="timing === 'later' ? 'text-accent/80' : 'text-text/70'">Trả trực tiếp cho luật sư khi gặp.</p>
                </button>
            </div>

            {{-- Pay-now flow --}}
            <div x-show="timing === 'now'" x-cloak class="mt-8">
                <p class="text-eyebrow">Thanh toán bằng</p>

                {{-- Method tabs --}}
                <div class="mt-3 grid grid-cols-3 gap-2">
                    <button type="button" @click="method = 'card'"
                            :class="method === 'card' ? 'border-accent bg-accent/5 text-accent' : 'border-text/10 text-text hover:border-text/30'"
                            class="rounded-xl border px-4 py-3 text-form-label transition-colors">
                        Thẻ
                    </button>
                    <button type="button" @click="method = 'qr'"
                            :class="method === 'qr' ? 'border-accent bg-accent/5 text-accent' : 'border-text/10 text-text hover:border-text/30'"
                            class="rounded-xl border px-4 py-3 text-form-label transition-colors">
                        VietQR
                    </button>
                    <button type="button" @click="method = 'transfer'"
                            :class="method === 'transfer' ? 'border-accent bg-accent/5 text-accent' : 'border-text/10 text-text hover:border-text/30'"
                            class="rounded-xl border px-4 py-3 text-form-label transition-colors">
                        Chuyển khoản
                    </button>
                </div>

                {{-- Card form --}}
                <div x-show="method === 'card'" class="mt-6 space-y-4">
                    <div>
                        <label for="card_number" class="block text-form-label">Số thẻ</label>
                        <input id="card_number" type="text" inputmode="numeric" maxlength="19"
                               placeholder="1234 5678 9012 3456"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="card_name" class="block text-form-label">Tên trên thẻ</label>
                        <input id="card_name" type="text"
                               placeholder="NGUYEN VAN A"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="card_expiry" class="block text-form-label">Hết hạn</label>
                            <input id="card_expiry" type="text" inputmode="numeric" maxlength="5"
                                   placeholder="MM/YY"
                                   class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        </div>
                        <div>
                            <label for="card_cvv" class="block text-form-label">CVV</label>
                            <input id="card_cvv" type="text" inputmode="numeric" maxlength="4"
                                   placeholder="123"
                                   class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        </div>
                    </div>
                </div>

                {{-- VietQR --}}
                <div x-show="method === 'qr'" x-cloak class="mt-6 card-base text-center">
                    <div class="mx-auto flex h-48 w-48 items-center justify-center rounded-xl bg-text">
                        <svg class="h-32 w-32 text-bg" viewBox="0 0 100 100" fill="currentColor">
                            <rect x="0" y="0" width="30" height="30"/>
                            <rect x="35" y="0" width="10" height="10"/>
                            <rect x="55" y="0" width="10" height="10"/>
                            <rect x="70" y="0" width="30" height="30"/>
                            <rect x="40" y="15" width="20" height="10"/>
                            <rect x="0" y="35" width="10" height="10"/>
                            <rect x="20" y="35" width="15" height="10"/>
                            <rect x="45" y="35" width="10" height="20"/>
                            <rect x="65" y="35" width="20" height="10"/>
                            <rect x="90" y="35" width="10" height="15"/>
                            <rect x="10" y="50" width="20" height="10"/>
                            <rect x="55" y="55" width="15" height="10"/>
                            <rect x="80" y="60" width="20" height="10"/>
                            <rect x="0" y="70" width="30" height="30"/>
                            <rect x="35" y="70" width="10" height="20"/>
                            <rect x="55" y="80" width="20" height="10"/>
                            <rect x="80" y="80" width="20" height="20"/>
                        </svg>
                    </div>
                    <p class="mt-5 text-caption">
                        Quét bằng ứng dụng ngân hàng tương thích VietQR để thanh toán {{ number_format($fee) }} VND.
                    </p>
                    <p class="mt-2 text-form-hint">Lịch hẹn sẽ tự động xác nhận sau khi chúng tôi nhận được thanh toán.</p>
                </div>

                {{-- Bank transfer --}}
                <div x-show="method === 'transfer'" x-cloak class="mt-6 card-base">
                    <p class="text-caption">Chuyển khoản đến:</p>
                    <dl class="mt-4 space-y-3 text-caption">
                        <div class="flex items-baseline justify-between gap-4">
                            <dt>Ngân hàng</dt>
                            <dd class="text-text">Vietcombank</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt>Tên tài khoản</dt>
                            <dd class="text-text">CONG TY LEGALEASE</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt>Số tài khoản</dt>
                            <dd class="font-display text-text">0011 0000 1234 5678</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt>Nội dung chuyển khoản</dt>
                            <dd class="text-text">Mã đặt lịch của bạn (gửi khi xác nhận)</dd>
                        </div>
                    </dl>
                    <p class="mt-5 text-form-hint">
                        Hầu hết chuyển khoản hoàn tất trong vài phút. Chúng tôi sẽ gửi email khi nhận được tiền.
                    </p>
                </div>
            </div>

            {{-- Pay-later info --}}
            <div x-show="timing === 'later'" x-cloak class="mt-8 card-base">
                <p class="text-body">
                    Không cần thanh toán bây giờ. Bạn sẽ trả <span class="font-medium text-text">{{ number_format($fee) }} VND</span> trực tiếp cho luật sư tại buổi tư vấn.
                </p>
                <p class="mt-4 text-form-hint">
                    Vui lòng chuẩn bị tiền mặt hoặc phương thức thanh toán mà luật sư chấp nhận. Lịch hẹn sẽ được xác nhận ngay sau khi bạn xác nhận đặt chỗ.
                </p>
            </div>

            <div class="mt-8">
                <x-button variant="primary" type="submit" class="w-full">
                    <span x-show="timing === 'now'">Thanh toán {{ number_format($fee) }} VND</span>
                    <span x-show="timing === 'later'" x-cloak>Xác nhận đặt chỗ</span>
                </x-button>
            </div>

            <p class="mt-4 text-center text-caption">
                <a href="{{ route('book.review') }}" class="transition-colors hover:text-text/60">
                    ← Quay lại trang xác nhận
                </a>
            </p>

            <p class="mt-6 text-center text-form-hint">
                Thanh toán được xử lý an toàn. Chúng tôi không lưu số thẻ đầy đủ.
            </p>
        </form>
    @endif
</section>
@endsection

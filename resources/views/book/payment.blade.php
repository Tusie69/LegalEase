@extends('layouts.app', ['title' => 'Trả tiền đặt cọc · LegalEase'])

@php
    use Carbon\Carbon;

    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
    $fee = $lawyer['price_per_hour'] ?? 0;
    $deposit = (int) round($fee * 0.20);
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="card-base-lg">
            <p class="text-[16px]">Không có đặt phòng nào đang diễn ra. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-text/70">
                Tìm luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <h1 class="text-flow-h1">
            Thanh toán tiền đặt cọc
        </h1>
        <p class="mt-3 text-body-prose">
            Chúng tôi thu 20% phí tư vấn để giữ chỗ. 80% còn lại được thanh toán trực tiếp cho luật sư tại buổi tư vấn.
        </p>

        {{-- Booking summary --}}
        <div class="mt-12 card-base-lg">
            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-14 w-14 flex-none rounded-full object-cover object-top">
                <div class="min-w-0">
                    <p class="text-card-h5">{{ $lawyer['name'] }}</p>
                    <p class="text-[14px]">
                        {{ Carbon::parse($booking['date'])->format('d/m/Y') }} · {{ Carbon::createFromFormat('H:i', $booking['time'])->format('H:i') }}
                    </p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span>Phí tư vấn</span>
                    <span class="text-text">{{ number_format($fee) }} VND</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span>Đặt cọc (20%)</span>
                    <span class="text-text">{{ number_format($deposit) }} VND</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span>Số dư đến hạn tại cuộc hẹn</span>
                    <span class="text-text">{{ number_format($fee - $deposit) }} VND</span>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-baseline justify-between gap-4">
                <span class="text-[16px] font-medium text-text">Thanh toán ngay hôm nay</span>
                <span class="text-card-h3 text-accent">{{ number_format($deposit) }} VND</span>
            </div>
        </div>

        {{-- Payment form --}}
        <form method="POST" action="{{ route('book.payment.store') }}" class="mt-10" novalidate
              x-data="{ method: 'card' }">
            @csrf
            <input type="hidden" name="method" :value="method">

            <p class="text-eyebrow">Thanh toán bằng</p>

            {{-- Method tabs --}}
            <div class="mt-3 grid grid-cols-3 gap-2">
                <button type="button" @click="method = 'card'"
                        :class="method === 'card' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[14px] font-medium text-text transition-colors">
                    Thẻ
                </button>
                <button type="button" @click="method = 'qr'"
                        :class="method === 'qr' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[14px] font-medium text-text transition-colors">
                    VietQR
                </button>
                <button type="button" @click="method = 'transfer'"
                        :class="method === 'transfer' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[14px] font-medium text-text transition-colors">
                    Chuyển khoản
                </button>
            </div>

            {{-- Card form --}}
            <div x-show="method === 'card'" class="mt-6 space-y-4">
                <div>
                    <label for="card_number" class="block text-[14px] font-medium">Số thẻ</label>
                    <input id="card_number" type="text" inputmode="numeric" maxlength="19"
                           placeholder="1234 5678 9012 3456"
                           class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div>
                    <label for="card_name" class="block text-[14px] font-medium">Tên trên thẻ</label>
                    <input id="card_name" type="text"
                           placeholder="NGUYEN VAN A"
                           class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="card_expiry" class="block text-[14px] font-medium">Hết hạn</label>
                        <input id="card_expiry" type="text" inputmode="numeric" maxlength="5"
                               placeholder="MM/YY"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="card_cvv" class="block text-[14px] font-medium">CVV</label>
                        <input id="card_cvv" type="text" inputmode="numeric" maxlength="4"
                               placeholder="123"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
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
                <p class="mt-5 text-[14px]">
                    Quét bằng ứng dụng ngân hàng tương thích VietQR để thanh toán {{ number_format($deposit) }} VND.
                </p>
                <p class="mt-2 text-[12px]">Lịch hẹn sẽ tự động xác nhận sau khi chúng tôi nhận được thanh toán.</p>
            </div>

            {{-- Bank transfer --}}
            <div x-show="method === 'transfer'" x-cloak class="mt-6 card-base">
                <p class="text-[14px]">Chuyển khoản đặt cọc tới:</p>
                <dl class="mt-4 space-y-3 text-[14px]">
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
                <p class="mt-5 text-[12px]">
                    Hầu hết chuyển khoản hoàn tất trong vài phút. Chúng tôi sẽ gửi email khi nhận được tiền đặt cọc.
                </p>
            </div>

            <div class="mt-8">
                <x-button variant="primary" type="submit" class="w-full">
                    Thanh toán {{ number_format($deposit) }} VND
                </x-button>
            </div>

            <p class="mt-4 text-center text-[14px]">
                <a href="{{ route('book.review') }}" class="transition-colors hover:text-accent">
                    ← Quay lại trang xác nhận
                </a>
            </p>

            <p class="mt-6 text-center text-[12px]">
                Thanh toán được xử lý an toàn. Chúng tôi không lưu số thẻ đầy đủ.
            </p>
        </form>
    @endif
</section>
@endsection

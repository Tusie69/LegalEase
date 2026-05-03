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
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">Không có lịch hẹn nào đang diễn ra. Vui lòng chọn luật sư và thời gian hẹn.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Duyệt luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
            Thanh toán tiền đặt cọc
        </h1>
        <p class="mt-3 text-[17px] text-secondary">
            Chúng tôi thu 20% phí tư vấn để giữ lịch hẹn của bạn. 80% còn lại sẽ được thanh toán trực tiếp cho luật sư tại buổi hẹn.
        </p>

        {{-- Booking summary --}}
        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
                <div class="min-w-0">
                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                    <p class="text-[13px] text-muted">
                        {{ Carbon::parse($booking['date'])->format('M j, Y') }} · {{ Carbon::createFromFormat('H:i', $booking['time'])->format('g:i A') }}
                    </p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Phí tư vấn</span>
                    <span class="text-text">{{ number_format($fee) }} VND</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Đặt cọc (20%)</span>
                    <span class="text-text">{{ number_format($deposit) }} VND</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Khoản cần thanh toán cho Luật sư</span>
                    <span class="text-text">{{ number_format($fee - $deposit) }} VND</span>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-baseline justify-between gap-4">
                <span class="text-[15px] font-medium text-text">Thanh toán ngay hôm nay</span>
                <span class="font-display text-[24px] font-medium tracking-tight text-accent">{{ number_format($deposit) }} VND</span>
            </div>
        </div>

        {{-- Payment form --}}
        <form method="POST" action="{{ route('book.payment.store') }}" class="mt-10" novalidate
              x-data="{ method: 'card' }">
            @csrf
            <input type="hidden" name="method" :value="method">

            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thanh toán bằng</p>

            {{-- Method tabs --}}
            <div class="mt-3 grid grid-cols-3 gap-2">
                <button type="button" @click="method = 'card'"
                        :class="method === 'card' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[13px] font-medium text-text transition-colors">
                    Thẻ
                </button>
                <button type="button" @click="method = 'qr'"
                        :class="method === 'qr' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[13px] font-medium text-text transition-colors">
                    VietQR
                </button>
                <button type="button" @click="method = 'transfer'"
                        :class="method === 'transfer' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[13px] font-medium text-text transition-colors">
                    Chuyển khoản
                </button>
            </div>

            {{-- Card form --}}
            <div x-show="method === 'card'" class="mt-6 space-y-4">
                <div>
                    <label for="card_number" class="block text-[13px] font-medium text-muted">Số thẻ</label>
                    <input id="card_number" type="text" inputmode="numeric" maxlength="19"
                           placeholder="1234 5678 9012 3456"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div>
                    <label for="card_name" class="block text-[13px] font-medium text-muted">Tên trên thẻ</label>
                    <input id="card_name" type="text"
                           placeholder="NGUYEN VAN A"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="card_expiry" class="block text-[13px] font-medium text-muted">Ngày hết hạn</label>
                        <input id="card_expiry" type="text" inputmode="numeric" maxlength="5"
                               placeholder="MM/YY"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="card_cvv" class="block text-[13px] font-medium text-muted">CVV</label>
                        <input id="card_cvv" type="text" inputmode="numeric" maxlength="4"
                               placeholder="123"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                </div>
            </div>

            {{-- VietQR --}}
            <div x-show="method === 'qr'" x-cloak class="mt-6 rounded-2xl border border-text/10 bg-surface p-6 text-center">
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
                <p class="mt-5 text-[13px] text-secondary">
                    Quét bằng ứng dụng ngân hàng hỗ trợ VietQR để thanh toán {{ number_format($deposit) }} VND.
                </p>
                <p class="mt-2 text-[12px] text-muted">Đặt phòng sẽ tự động xác nhận sau khi chúng tôi nhận được thanh toán.</p>
            </div>

            {{-- Bank transfer --}}
            <div x-show="method === 'transfer'" x-cloak class="mt-6 rounded-2xl border border-text/10 bg-surface p-6">
                <p class="text-[13px] text-muted">Chuyển khoản đặt cọc tới:</p>
                <dl class="mt-4 space-y-3 text-[14px]">
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Ngân hàng</dt>
                        <dd class="text-text">Vietcombank</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Tên tài khoản</dt>
                        <dd class="text-text">PHÁP LUẬT CỘNG Tý</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Số tài khoản</dt>
                        <dd class="font-display text-text">0011 0000 1234 5678</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Nội dung chuyển khoản</dt>
                        <dd class="text-text">Mã đặt phòng của bạn (được gửi khi xác nhận)</dd>
                    </div>
                </dl>
                <p class="mt-5 text-[12px] text-muted">
                    Hầu hết giao dịch được ghi nhận trong vài phút. Chúng tôi sẽ gửi email khi tiền đặt cọc được nhận.
                </p>
            </div>

            <div class="mt-8">
                <x-button variant="primary" type="submit" class="w-full">
                    Thanh toán {{ number_format($deposit) }} VND
                </x-button>
            </div>

            <p class="mt-4 text-center text-[14px]">
                <a href="{{ route('book.review') }}" class="text-muted transition-colors hover:text-accent">
                    ← Quay lại bước xem lại
                </a>
            </p>

            <p class="mt-6 text-center text-[12px] text-muted">
                Thanh toán được xử lý an toàn. Chúng tôi không lưu toàn bộ số thẻ.
            </p>
        </form>
    @endif
</section>
@endsection

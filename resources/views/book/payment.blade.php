@extends('layouts.app', ['title' => 'Thanh toan - LegalEase'])

@php
    use Carbon\Carbon;

    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lawyers::findBySlug($booking['lawyer_slug']) : null;
    $fee = (float) ($lawyer['price_per_hour'] ?? 0);
    $paypalCurrency = config('services.paypal.currency', 'USD');
    $paypalExchangeRate = (float) config('services.paypal.exchange_rate', 25000);
    $paypalAmount = $fee > 0 && $paypalExchangeRate > 0 ? round($fee / $paypalExchangeRate, 2) : 0;
@endphp

@section('content')
<section class="mx-auto max-w-[760px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">Khong co lich hen nao dang duoc thanh toan. Vui long chon luat su va khung gio truoc.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Tim luat su
                <span aria-hidden="true">-&gt;</span>
            </a>
        </div>
    @else
        <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
            Chon phuong thuc thanh toan
        </h1>
        <p class="mt-3 text-[17px] leading-relaxed text-secondary">
            Lich hen se duoc tao sau buoc nay. Neu chon PayPal, he thong se redirect sang PayPal Checkout va chi xac nhan lich hen sau khi backend capture thanh cong.
        </p>

        @if ($errors->any())
            <div class="mt-8 rounded-2xl border border-error/30 bg-error/10 p-5 text-[15px] text-error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
                <div class="min-w-0">
                    <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                    <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thoi gian</p>
                    <p class="mt-3 text-[15px] text-text">
                        {{ \Illuminate\Support\Str::title(Carbon::parse($booking['date'])->translatedFormat('l, d/m/Y')) }}
                    </p>
                    <p class="text-[14px] text-secondary">
                        {{ Carbon::createFromFormat('H:i', $booking['time'])->format('H:i') }} - Tu van 60 phut
                    </p>
                </div>
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Dia diem</p>
                    <p class="mt-3 text-[15px] text-text">{{ $lawyer['address']['street_address'] ?? '' }}</p>
                    <p class="text-[14px] text-secondary">{{ $lawyer['address']['province'] ?? '' }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Phi tu van</p>
                    <p class="mt-2 font-display text-[28px] font-medium tracking-tight text-accent">{{ number_format($fee) }} VND</p>
                </div>
                <p class="text-[13px] text-muted">
                    PayPal sandbox: {{ number_format($paypalAmount, 2) }} {{ $paypalCurrency }}
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('book.payment.store') }}" class="mt-10"
              x-data="{ method: '{{ old('payment_method', 'paypal') }}' }">
            @csrf
            <input type="hidden" name="payment_method" :value="method">

            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thanh toan bang</p>
            <div class="mt-3 grid gap-4 md:grid-cols-2">
                <button type="button"
                        @click="method = 'paypal'"
                        :class="method === 'paypal' ? 'border-accent bg-text/10' : 'border-text/10 hover:border-text/30'"
                        class="rounded-2xl border bg-surface p-6 text-left transition-colors">
                    <div class="flex items-center justify-between gap-4">
                        <p class="font-display text-[20px] font-medium tracking-tight text-text">PayPal Checkout</p>
                        <span class="rounded-full border px-3 py-1 text-[12px] font-medium"
                              :class="method === 'paypal' ? 'border-accent text-accent' : 'border-text/20 text-muted'">
                            Online
                        </span>
                    </div>
                    <p class="mt-4 text-[13px] leading-relaxed text-secondary">
                        Tao appointment payment pending, redirect sang PayPal, user thanh toan, callback ve backend de capture va cap nhat thanh confirmed.
                    </p>
                </button>

                <button type="button"
                        @click="method = 'cash'"
                        :class="method === 'cash' ? 'border-accent bg-text/10' : 'border-text/10 hover:border-text/30'"
                        class="rounded-2xl border bg-surface p-6 text-left transition-colors">
                    <div class="flex items-center justify-between gap-4">
                        <p class="font-display text-[20px] font-medium tracking-tight text-text">Thanh toan tai van phong</p>
                        <span class="rounded-full border px-3 py-1 text-[12px] font-medium"
                              :class="method === 'cash' ? 'border-accent text-accent' : 'border-text/20 text-muted'">
                            Cash
                        </span>
                    </div>
                    <p class="mt-4 text-[13px] leading-relaxed text-secondary">
                        Tao appointment pending voi payment method cash. Luat su hoac admin se xac nhan thu cong sau.
                    </p>
                </button>
            </div>

            <div class="mt-8 rounded-2xl border border-text/10 bg-surface p-6">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Luong xu ly</p>
                <div class="mt-4 space-y-3 text-[14px] text-secondary">
                    <div x-show="method === 'paypal'">
                        <p>Book appointment - Payment pending</p>
                        <p class="mt-3">Redirect PayPal - User Pay</p>
                        <p class="mt-3">PayPal callback - Backend verifies transaction</p>
                        <p class="mt-3">Appointment status = Confirmed, payment = Paid</p>
                    </div>
                    <div x-show="method === 'cash'" x-cloak>
                        <p>Book appointment - Appointment pending</p>
                        <p class="mt-3">Payment method = cash</p>
                        <p class="mt-3">Lawyer/Admin confirms manually</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <x-button variant="primary" type="submit" class="w-full">
                    <span x-show="method === 'paypal'">Redirect to PayPal</span>
                    <span x-show="method === 'cash'" x-cloak>Xac nhan va thanh toan tai van phong</span>
                </x-button>
            </div>

            <p class="mt-4 text-center text-[14px]">
                <a href="{{ route('book.review') }}" class="text-muted transition-colors hover:text-accent">
                    &lt;- Quay lai trang xac nhan
                </a>
            </p>
        </form>
    @endif
</section>
@endsection

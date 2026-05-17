@extends('layouts.app', ['title' => 'Dat lich thanh cong - LegalEase'])

@php
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $user = auth()->user();
    $firstName = $user ? explode(' ', trim($user->name))[0] : null;
    $isPaid = ($completed['payment_status'] ?? null) === 'PAID';
    $isCash = ($completed['payment_method'] ?? null) === 'cash';
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$completed || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">Khong tim thay lich hen. Vui long chon luat su de dat lich moi.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Tim luat su
                <span aria-hidden="true">-&gt;</span>
            </a>
        </div>
    @else
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
            {{ $isPaid ? 'PayPal paid' : 'Cash pending' }}
        </p>
        <h1 class="mt-3 font-display text-[44px] font-medium leading-[1.08] tracking-[-0.02em] md:text-[56px]">
            {{ $isPaid ? 'Lich hen da duoc xac nhan' : 'Da tao lich hen' }}{{ $firstName ? ', ' . $firstName : '' }}.
        </h1>
        <p class="mt-4 text-[17px] leading-relaxed text-secondary">
            {{ $isPaid
                ? 'PayPal da xac nhan thanh toan. Luat su da duoc thong bao ve lich hen cua ban.'
                : 'Lich hen dang cho xac nhan thu cong. Ban se thanh toan tai van phong theo phuong thuc cash.' }}
        </p>

        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Ma dat lich</p>
                    <p class="mt-2 font-display text-[28px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>
                </div>
                <div class="rounded-full border px-4 py-2 text-[12px] font-medium {{ $isPaid ? 'border-success text-success' : 'border-gold text-gold' }}">
                    {{ $isPaid ? 'Paid / Confirmed' : 'Cash / Pending' }}
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                <div class="min-w-0">
                    <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                    <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span class="flex-none text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thoi gian</span>
                    <span class="text-right text-text">
                        {{ \Carbon\Carbon::parse($completed['date'])->format('d/m/Y') }} - {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('H:i') }}
                    </span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="flex-none text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Dia diem</span>
                    <span class="text-right text-text">
                        {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                    </span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="flex-none text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thanh toan</span>
                    <span class="text-right text-text">
                        {{ $isCash ? 'Thanh toan tai van phong' : 'PayPal Checkout' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Tiep theo</p>
            <ul class="mt-6 space-y-4 text-[15px] leading-relaxed text-secondary">
                @if ($isPaid)
                    <li>Trang thai appointment da duoc cap nhat thanh confirmed va payment da duoc ghi paid.</li>
                    <li>Ban se nhan nhac hen qua {{ $completed['contact_preference'] === 'phone' ? 'dien thoai' : 'email' }} truoc buoi hen.</li>
                @else
                    <li>Appointment dang o trang thai pending voi payment method cash.</li>
                    <li>Lawyer hoac admin can xac nhan thu cong truoc khi lich hen chuyen sang confirmed.</li>
                @endif
                <li>Vui long den som vai phut va mang theo tai lieu lien quan.</li>
            </ul>
        </div>

        <div class="mt-12">
            <x-button variant="primary" href="{{ route('appointments.index') }}" class="w-full">
                Xem lich hen cua toi
            </x-button>
            <p class="mt-4 text-center text-[14px]">
                <a href="{{ route('lawyers.index') }}" class="text-muted transition-colors hover:text-accent">
                    Tim them luat su -&gt;
                </a>
            </p>
        </div>
    @endif
</section>
@endsection

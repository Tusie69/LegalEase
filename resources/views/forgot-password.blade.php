@extends('layouts.app', ['title' => 'Quên mật khẩu · LegalEase'])

@php
    $initialState = [
        'email'   => old('email', ''),
        'touched' => [
            'email' => old('email') !== null || $errors->has('email'),
        ],
    ];
@endphp

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1724832228136-6ddd51037827?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            @if (session('reset_link_sent'))
                <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Kiểm tra email của bạn</h1>
                <p class="mt-4 text-[15px] text-secondary">
                    If an account exists for <span class="text-text">{{ session('reset_link_sent') }}</span>, chúng tôi đã gửi liên kết để đặt lại mật khẩu của bạn. Liên kết sẽ hết hạn sau 60 phút.
                </p>
                <p class="mt-3 text-[14px] text-muted">
                    Didn't get it? Check your spam folder, or
                    <a href="{{ route('password.request') }}" class="text-text transition-colors hover:text-accent">thử lại</a>.
                </p>

                <div class="mt-10">
                    <a href="{{ route('login') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
                        ← Back to login
                    </a>
                </div>
            @else
                <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Quên mật khẩu?</h1>
                <p class="mt-2 text-[15px] text-secondary">Nhập email liên kết với tài khoản của bạn và chúng tôi sẽ gửi liên kết để thiết lập một liên kết mới.</p>

                <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5" novalidate
                      x-data="forgotPasswordValidation({{ json_encode($initialState) }})"
                      @submit="markAllTouched()">
                    @csrf

                    <div>
                        <label for="email" class="block text-[13px] font-medium text-muted">
                            Email
                            <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                            <svg x-show="emailError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                               placeholder="you@example.com"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('email'))
                            <p x-show="emailError" x-cloak x-text="emailError" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>

                    <x-button variant="primary" type="submit" class="w-full">Gửi liên kết đặt lại</x-button>

                    <p class="text-center text-[14px] text-muted">
                        Remembered it?
                        <a href="{{ route('login') }}" class="text-text transition-colors hover:text-accent">Đăng nhập</a>
                    </p>
                </form>
            @endif
        </div>
    </div>
</section>

<script>
    function forgotPasswordValidation(initial) {
        return {
            email: initial.email || '',

            touched: Object.assign({ email: false }, initial.touched || {}),

            markAllTouched() {
                Object.keys(this.touched).forEach((k) => { this.touched[k] = true; });
            },

            get isEmailValid() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            get emailError() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Please enter your email address.';
                return 'Please enter a valid email address.';
            },
        };
    }
</script>
@endsection

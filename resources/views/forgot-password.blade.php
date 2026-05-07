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
<section class="relative -mt-18 flex min-h-screen flex-col lg:landscape:flex-row">
    {{-- Photo --}}
    <div class="relative h-[55vh] overflow-hidden lg:landscape:sticky lg:landscape:top-0 lg:landscape:h-screen lg:landscape:flex-1">
        <img src="https://images.unsplash.com/photo-1724832228136-6ddd51037827?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            @if (session('reset_link_sent'))
                <h1 class="text-flow-h1">Kiểm tra email của bạn</h1>
                <p class="text-body mt-4">
                    Nếu có tài khoản với <span class="text-text">{{ session('reset_link_sent') }}</span>, chúng tôi đã gửi liên kết để đặt lại mật khẩu của bạn. Liên kết sẽ hết hạn sau 60 phút.
                </p>
                <p class="mt-3 text-[14px]">
                    Không nhận được? Kiểm tra hộp thư rác, hoặc
                    <a href="{{ route('password.request') }}" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">thử lại</a>.
                </p>

                <div class="mt-10">
                    <a href="{{ route('login') }}" class="text-[14px] underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">
                        ← Quay lại đăng nhập
                    </a>
                </div>
            @else
                <h1 class="text-flow-h1">Quên mật khẩu?</h1>
                <p class="text-body mt-2">Nhập email liên kết với tài khoản của bạn và chúng tôi sẽ gửi liên kết để đặt lại mật khẩu.</p>

                <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5" novalidate
                      x-data="forgotPasswordValidation({{ json_encode($initialState) }})"
                      @submit="markAllTouched()">
                    @csrf

                    <div>
                        <label for="email" class="block text-[14px] font-medium">
                            Email
                            <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                            <svg x-show="emailError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                               placeholder="you@example.com"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('email'))
                            <p x-show="emailError" x-cloak x-text="emailError" class="mt-2 text-[14px] text-error"></p>
                        @endunless
                        @error('email') <p class="mt-2 text-[14px] text-error">{{ $message }}</p> @enderror
                    </div>

                    <x-button variant="primary" type="submit" class="w-full">Gửi liên kết đặt lại</x-button>

                    <p class="text-center text-[14px]">
                        Nhớ ra rồi?
                        <a href="{{ route('login') }}" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">Đăng nhập</a>
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
                if (this.email.length === 0) return 'Vui lòng nhập email của bạn.';
                return 'Vui lòng nhập email hợp lệ.';
            },
        };
    }
</script>
@endsection

@extends('layouts.app', ['title' => 'Đăng nhập · LegalEase'])

@section('content')
<section class="relative -mt-18 flex min-h-screen flex-col lg:landscape:flex-row">
    {{-- Photo --}}
    <div class="relative h-[55vh] overflow-hidden lg:landscape:sticky lg:landscape:top-0 lg:landscape:h-screen lg:landscape:flex-1">
        <img src="https://images.unsplash.com/photo-1524508762098-fd966ffb6ef9?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="text-flow-h1">Đăng nhập</h1>
            <p class="text-body mt-2">Chào mừng trở lại. Đăng nhập để truy cập tài khoản của bạn.</p>

            @if (session('status'))
                <p class="mt-4 rounded-xl border border-success/40 bg-success/10 px-4 py-3 text-[14px] text-success">
                    {{ session('status') }}
                </p>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-[14px] font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent @error('email') border-error focus:border-error focus:ring-error @enderror">
                    @error('email') <p class="mt-2 text-[14px] font-medium text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[14px] font-medium">Mật khẩu</label>
                    <div class="relative mt-2">
                        <input id="password" name="password"
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-[16px] text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent @error('password') border-error focus:border-error focus:ring-error @enderror">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    @error('password') <p class="mt-2 text-[14px] font-medium text-error">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-[14px]">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-text/20 bg-bg text-accent focus:ring-accent">
                        <span>Nhớ tôi</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[14px] underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">Quên mật khẩu?</a>
                </div>

                <x-button variant="primary" type="submit" class="w-full">Đăng nhập</x-button>

                <p class="text-center text-[14px]">
                    Bạn chưa có tài khoản?
                    <a href="{{ route('register') }}" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">Đăng ký</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection

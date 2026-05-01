@extends('layouts.app', ['title' => 'Log in · LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1524508762098-fd966ffb6ef9?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Log in</h1>
            <p class="mt-2 text-[15px] text-secondary">Welcome back. Log in to access your account.</p>

            @if (session('status'))
                <p class="mt-4 rounded-xl border border-success/40 bg-success/10 px-4 py-3 text-[14px] text-success">
                    {{ session('status') }}
                </p>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">Password</label>
                    <div class="relative mt-2">
                        <input id="password" name="password"
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-[14px] text-muted">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[14px] text-muted transition-colors hover:text-accent">Forgot password?</a>
                </div>

                <x-button variant="primary" type="submit" class="w-full">Log in</x-button>

                <p class="text-center text-[14px] text-muted">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-text transition-colors hover:text-accent">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection

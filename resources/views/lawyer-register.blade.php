@extends('layouts.app', ['title' => 'Apply to join · LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:h-auto md:flex-1">
        <img src="https://images.unsplash.com/photo-1547179660-453ec5367aa3?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">For lawyers</p>
            <h1 class="mt-3 font-display text-4xl font-medium tracking-tight">Apply to join</h1>
            <p class="mt-2 text-[15px] text-secondary">Profiles are reviewed before going live. We'll be in touch within a few business days.</p>

            <form method="POST" action="{{ route('lawyer.register.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-[13px] font-medium text-muted">First name</label>
                        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}"
                               placeholder="Lan"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('first_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-[13px] font-medium text-muted">Last name</label>
                        <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}"
                               placeholder="Nguyễn"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('last_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-[13px] font-medium text-muted">Phone</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                           placeholder="09xxxxxxxx"
                           pattern="[\d\+\s\-\(\)]{9,15}"
                           title="Digits, spaces, dashes, parentheses, and a leading + are allowed."
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('phone') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bar_association" class="block text-[13px] font-medium text-muted">Bar association</label>
                    <input id="bar_association" type="text" name="bar_association" value="{{ old('bar_association') }}"
                           placeholder="Hanoi Bar Association"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('bar_association') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bar_card_number" class="block text-[13px] font-medium text-muted">Bar card number</label>
                    <input id="bar_card_number" type="text" name="bar_card_number" value="{{ old('bar_card_number') }}"
                           placeholder="e.g. 12345/HN"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('bar_card_number') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
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
                    <p class="mt-2 text-[12px] text-muted">At least 8 characters, with a letter and a number.</p>
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-[13px] font-medium text-muted">Confirm password</label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation"
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                </div>

                <label class="flex items-start gap-2 text-[13px] text-muted">
                    <input type="checkbox" name="agreed_terms" value="1" class="mt-0.5 h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                    <span>I agree to the <a href="#" class="text-text transition-colors hover:text-accent">Terms of Service</a> and <a href="#" class="text-text transition-colors hover:text-accent">Privacy Policy</a>.</span>
                </label>
                @error('agreed_terms') <p class="text-[13px] text-error">{{ $message }}</p> @enderror

                <x-button variant="primary" type="submit" class="w-full">Submit application</x-button>

                <p class="text-center text-[14px] text-muted">
                    Already have a lawyer account?
                    <a href="{{ route('lawyer.login') }}" class="text-text transition-colors hover:text-accent">Log in</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection

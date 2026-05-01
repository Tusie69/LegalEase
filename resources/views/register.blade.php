@extends('layouts.app', ['title' => 'Sign up · LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:h-auto md:flex-1">
        <img src="https://images.unsplash.com/photo-1698047682091-782b1e5c6536?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="font-display text-4xl font-medium tracking-tight">Sign up</h1>
            <p class="mt-2 text-[15px] text-secondary">Access trusted legal expertise, book consultations, and manage your matters in one place.</p>

            <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-[13px] font-medium text-muted">First name <span class="text-gold">*</span></label>
                        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required
                               placeholder="Lan"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('first_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-[13px] font-medium text-muted">Last name <span class="text-gold">*</span></label>
                        <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required
                               placeholder="Nguyễn"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('last_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">Email <span class="text-gold">*</span></label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-[13px] font-medium text-muted">Phone <span class="text-gold">*</span></label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required
                           placeholder="09xxxxxxxx"
                           pattern="[\d\+\s\-\(\)]{9,15}"
                           title="Digits, spaces, dashes, parentheses, and a leading + are allowed."
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('phone') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="date_of_birth" class="block text-[13px] font-medium text-muted">Date of birth <span class="text-gold">*</span></label>
                        <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @error('date_of_birth') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-[13px] font-medium text-muted">Gender <span class="text-gold">*</span></label>
                        <div class="relative mt-2">
                            <select id="gender" name="gender" required
                                    class="block w-full appearance-none rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <option value="">Select</option>
                                <option value="female" @selected(old('gender') === 'female')>Female</option>
                                <option value="male" @selected(old('gender') === 'male')>Male</option>
                                <option value="other" @selected(old('gender') === 'other')>Other</option>
                                <option value="undisclosed" @selected(old('gender') === 'undisclosed')>Prefer not to say</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-muted">
                                <x-icon name="chevron-down" :size="16" />
                            </span>
                        </div>
                        @error('gender') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">Password <span class="text-gold">*</span></label>
                    <div class="relative mt-2">
                        <input id="password" name="password" required
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
                    <label for="password_confirmation" class="block text-[13px] font-medium text-muted">Confirm password <span class="text-gold">*</span></label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation" required
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

                <div>
                    <label class="flex items-start gap-2 text-[13px] text-muted">
                        <input type="checkbox" name="agreed_terms" value="1" required @checked(old('agreed_terms')) class="mt-0.5 h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>I agree to the <a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-text transition-colors hover:text-accent">Privacy Policy</a>. <span class="text-gold">*</span></span>
                    </label>
                    @error('agreed_terms') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <x-button variant="primary" type="submit" class="w-full">Create account</x-button>

                <p class="text-center text-[14px] text-muted">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-text transition-colors hover:text-accent">Log in</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Rate your consultation · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Your consultation</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        How did it go?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        Honest feedback helps other clients pick the right lawyer.
    </p>

    {{-- Lawyer summary --}}
    <div class="mt-12 flex items-center gap-4 rounded-2xl border border-text/10 bg-surface p-5">
        <img src="{{ $lawyer['portrait_url'] }}"
             alt=""
             class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
        <div class="min-w-0">
            <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
            <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('consultations.rate.store', $consultation['booking_code']) }}"
          class="mt-10 space-y-8" novalidate
          x-data="{ stars: {{ (int) old('stars', 0) }}, hover: 0 }"
          @submit="if (!stars) { $event.preventDefault(); }">
        @csrf

        {{-- Stars --}}
        <div>
            <p class="text-[13px] font-medium text-muted">
                How would you rate your experience?
            </p>
            <div class="mt-4 flex items-center gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button"
                            @click="stars = {{ $i }}"
                            @mouseover="hover = {{ $i }}"
                            @mouseleave="hover = 0"
                            aria-label="{{ $i }} star{{ $i === 1 ? '' : 's' }}"
                            class="transition-transform duration-150 hover:scale-110 focus:outline-none">
                        <svg class="h-10 w-10 transition-colors duration-150"
                             :class="(hover || stars) >= {{ $i }} ? 'text-gold' : 'text-text/20'"
                             viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
                        </svg>
                    </button>
                @endfor
            </div>
            <input type="hidden" name="stars" :value="stars">
            <p x-show="!stars && {{ $errors->has('stars') ? 'true' : 'false' }}" x-cloak
               class="mt-3 text-[13px] text-error">Please choose a rating.</p>
            @error('stars') <p class="mt-3 text-[13px] text-error">{{ $message }}</p> @enderror
        </div>

        {{-- Review text --}}
        <div>
            <label for="review_text" class="block text-[13px] font-medium text-muted">
                Add a review <span class="text-muted/60">(optional)</span>
            </label>
            <textarea id="review_text" name="review_text" rows="6" maxlength="2000"
                      placeholder="What stood out? Anything that could have been better?"
                      class="mt-3 block w-full resize-y rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] leading-relaxed text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('review_text') }}</textarea>
            @error('review_text') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-6">
            <x-button variant="primary" type="submit">Submit review</x-button>
            <a href="{{ route('consultations.show', $consultation['booking_code']) }}" class="text-[14px] text-muted transition-colors hover:text-accent">
                Maybe later
            </a>
        </div>
    </form>
</section>
@endsection

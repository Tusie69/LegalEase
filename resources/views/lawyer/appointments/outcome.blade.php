@extends('layouts.app', ['title' => 'Report outcome · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
       class="text-[14px] text-muted transition-colors hover:text-accent">
        ← Back to appointment
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Report outcome</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        How did it go?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        Once you choose, we'll release payment, update the booking, and either unlock the customer's review or process the no-show.
    </p>

    {{-- Customer summary --}}
    <div class="mt-10 flex items-center gap-4 rounded-2xl border border-text/10 bg-surface p-5">
        <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
            <span class="font-display text-[15px] font-medium text-text">{{ $appointment['customer_initials'] }}</span>
        </div>
        <div class="min-w-0">
            <p class="font-display text-[18px] font-medium tracking-tight">{{ $appointment['customer_name'] }}</p>
            <p class="text-[13px] text-muted">
                {{ \Carbon\Carbon::parse($appointment['date'])->format('M j, Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $appointment['time'])->format('g:i A') }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('lawyer.appointments.outcome.store', $appointment['booking_code']) }}"
          class="mt-10 space-y-8" novalidate
          x-data="{ outcome: '{{ old('outcome', '') }}' }">
        @csrf

        <div class="space-y-4">
            {{-- Outcome A --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="completed" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-surface p-6 transition-colors"
                     :class="outcome === 'completed' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'completed' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'completed' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">Appointment completed</p>
                            <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                                The customer attended and the consultation took place. The platform retains the full deposit. The customer can now leave a review.
                            </p>
                        </div>
                    </div>
                </div>
            </label>

            {{-- Outcome B --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="no_show_customer" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-surface p-6 transition-colors"
                     :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'no_show_customer' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">Customer didn't show up</p>
                            <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                                The customer forfeits the deposit. You'll receive 25% of the deposit (5% of the consultation fee) as compensation for the reserved time.
                            </p>
                        </div>
                    </div>
                </div>
            </label>
        </div>

        @error('outcome') <p class="text-[13px] text-error">{{ $message }}</p> @enderror

        <div class="flex flex-wrap items-center gap-x-6 gap-y-4">
            <x-button variant="primary" type="submit" x-bind:disabled="!outcome"
                      x-bind:class="!outcome ? 'opacity-50 cursor-not-allowed' : ''">
                Submit outcome
            </x-button>
            <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
               class="text-[14px] text-muted transition-colors hover:text-accent">
                Cancel
            </a>
        </div>
    </form>
</section>
@endsection

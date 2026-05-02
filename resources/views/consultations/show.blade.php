@extends('layouts.app', ['title' => 'Tư vấn · LegalEase'])

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('home') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
        ← Back to dashboard
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Consultation</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        Your consultation with {{ $lawyer['name'] }}
    </h1>
    <p class="mt-4 text-[14px] text-muted">{{ $consultation['booking_code'] }}</p>

    {{-- Lawyer card --}}
    <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-5">
            <img src="{{ $lawyer['portrait_url'] }}" alt=""
                 class="h-20 w-20 flex-none rounded-full object-cover object-top grayscale">
            <div class="min-w-0">
                <p class="font-display text-[22px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                <p class="text-[14px] text-muted">
                    {{ $lawyer['primary_specialty'] }} · {{ $lawyer['bar_association'] }}
                </p>
            </div>
        </div>
    </div>

    {{-- When + where --}}
    <div class="mt-10 grid gap-10 md:grid-cols-2">
        <div>
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
            <p class="mt-2 font-display text-[20px] font-medium tracking-tight">
                {{ \Carbon\Carbon::parse($consultation['date'])->format('l, F j, Y') }}
            </p>
            <p class="text-[14px] text-secondary">
                {{ \Carbon\Carbon::createFromFormat('H:i', $consultation['time'])->format('g:i A') }} · 60 minutes
            </p>
        </div>
        <div>
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Where</p>
            <p class="mt-2 text-[15px] text-text">{{ $lawyer['address']['street_address'] }}</p>
            <p class="text-[14px] text-muted">{{ $lawyer['address']['province'] }}</p>
        </div>
    </div>

    @if ($consultation['status'] === 'cancelled')
        {{-- Cancelled --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Status</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-[13px] font-medium text-error">Cancelled</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                You cancelled this consultation on {{ \Carbon\Carbon::parse($consultation['cancelled_at'])->format('M j, Y') }}.
                @if ($consultation['refund_eligible'])
                    Your full deposit will be refunded within 3 to 5 business days.
                @else
                    Cancellations less than 24 hours before the appointment are not eligible for a refund.
                @endif
            </p>
        </div>

        {{-- Book again --}}
        <div class="mt-12 border-t border-text/10 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-[15px] font-medium text-text transition-colors hover:text-secondary">
                Book {{ $lawyer['name'] }} again
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @elseif ($consultation['status'] === 'upcoming')
        {{-- Status (upcoming) --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Status</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">Confirmed</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Your consultation is booked. You'll receive a reminder 24 hours before. Cancellations more than 24 hours in advance are fully refunded.
            </p>
        </div>

        {{-- Manage --}}
        <div class="mt-12 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Manage</p>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('consultations.cancel', $consultation['booking_code']) }}"
                   class="text-[14px] font-medium text-error transition-colors hover:text-error/80">
                    Cancel consultation
                </a>
                <a href="{{ route('contact') }}"
                   class="text-[14px] text-muted transition-colors hover:text-accent">
                    Get in touch with our team →
                </a>
            </div>
        </div>
    @else
        {{-- Review (past) --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            @if ($consultation['rated'])
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Đánh giá của bạn</p>
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <x-rating-stars :rating="$consultation['stars']" size="md" />
                    <span class="text-[13px] text-muted">
                        Submitted {{ \Carbon\Carbon::parse($consultation['reviewed_at'])->format('M j, Y') }}
                    </span>
                </div>
                @if (!empty($consultation['review_text']))
                    <blockquote class="mt-6 border-l-2 border-text/10 pl-5 text-[17px] leading-relaxed text-secondary">
                        “{{ $consultation['review_text'] }}”
                    </blockquote>
                @endif
            @else
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Nó thế nào?</p>
                <h2 class="mt-3 font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">
                    Let other clients know.
                </h2>
                <p class="mt-3 max-w-[520px] text-[15px] text-secondary">
                    Honest reviews help future clients pick the right lawyer.
                </p>
                <div class="mt-8">
                    <x-button variant="primary" :href="route('consultations.rate', $consultation['booking_code'])">
                        Leave a review
                    </x-button>
                </div>
            @endif
        </div>

        {{-- Book again --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-[15px] font-medium text-text transition-colors hover:text-secondary">
                Book {{ $lawyer['name'] }} again
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @endif
</section>
@endsection

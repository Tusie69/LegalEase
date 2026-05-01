@extends('layouts.app', ['title' => 'FAQ · LegalEase'])

@php
    $sections = [
        [
            'title' => 'Booking and payments',
            'items' => [
                [
                    'q' => 'How do I book a consultation?',
                    'a' => "Browse lawyers by specialty, location, and price. Pick a lawyer, choose a time slot on their profile, then confirm your details. We'll hold a 20% deposit at booking.",
                ],
                [
                    'q' => "What's the deposit?",
                    'a' => 'When you confirm a booking, we hold 20% of the consultation fee as a deposit. The remaining 80% is paid directly to the lawyer at the time of the appointment.',
                ],
                [
                    'q' => 'When do I pay the rest?',
                    'a' => 'At the appointment itself. The platform only holds the deposit; the balance is settled directly between you and the lawyer.',
                ],
                [
                    'q' => 'What payment methods do you accept?',
                    'a' => 'Major credit and debit cards, plus local Vietnamese payment methods including bank transfer and popular e-wallets.',
                ],
            ],
        ],
        [
            'title' => 'Cancellations and refunds',
            'items' => [
                [
                    'q' => 'How do I cancel a booking?',
                    'a' => "From your dashboard, open the booking and click cancel. We'll process the cancellation according to our refund policy.",
                ],
                [
                    'q' => 'Will I get my deposit back?',
                    'a' => 'Cancel more than 24 hours before the appointment and you receive a full refund. Cancel within 24 hours and the deposit is forfeited (with limited exceptions).',
                ],
                [
                    'q' => 'What if my lawyer cancels?',
                    'a' => "You'll receive a full refund of the deposit and we'll help you find an alternative lawyer if you'd like.",
                ],
                [
                    'q' => "What if I don't show up?",
                    'a' => 'The deposit is forfeited. The platform retains 75% and the lawyer receives 25% as compensation for the reserved time.',
                ],
            ],
        ],
        [
            'title' => 'For lawyers',
            'items' => [
                [
                    'q' => 'How do I apply to join?',
                    'a' => "Visit our For Lawyers page and submit an application. We'll review your bar credentials and respond within a few business days.",
                ],
                [
                    'q' => 'How long does verification take?',
                    'a' => "Usually 2 to 3 business days. Complex cases may take longer; we'll update you if we need more time.",
                ],
                [
                    'q' => 'When do I get paid?',
                    'a' => 'The bulk of your fee (80%) is paid directly by the client at the appointment. Platform deposits are settled to your account on a weekly basis.',
                ],
                [
                    'q' => 'Can I set my own rates?',
                    'a' => "Yes. You set your hourly rate when you list and can update it any time, though changes don't affect existing bookings.",
                ],
            ],
        ],
        [
            'title' => 'Trust and safety',
            'items' => [
                [
                    'q' => 'How are lawyers verified?',
                    'a' => "Every lawyer on the platform has had their bar membership and credentials reviewed by our team before being listed. We re-verify periodically.",
                ],
                [
                    'q' => 'Are my consultations confidential?',
                    'a' => 'Yes. Consultations are between you and your lawyer, protected by attorney-client privilege under Vietnamese law.',
                ],
                [
                    'q' => 'How do reviews work?',
                    'a' => 'After a completed consultation, clients can leave a written review and a 1 to 5 star rating. Reviews must be honest and based on direct experience. Lawyers can flag inappropriate reviews for our team to review.',
                ],
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">FAQ</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Common questions.
            </h1>
        </div>
    </section>

    {{-- Sections --}}
    @foreach ($sections as $i => $section)
        <section class="mx-auto max-w-[760px] px-8 pt-24">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">{{ $section['title'] }}</h2>
            <div class="mt-12 border-t border-text/10">
                @foreach ($section['items'] as $item)
                    <div x-data="{ open: false }" class="border-b border-text/10">
                        <button type="button" @click="open = !open"
                                class="flex w-full items-baseline justify-between gap-6 py-6 text-left transition-colors hover:text-accent">
                            <span class="font-display text-[18px] font-medium tracking-tight md:text-[20px]">{{ $item['q'] }}</span>
                            <svg x-show="!open" class="h-5 w-5 flex-none text-muted"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <svg x-show="open" x-cloak class="h-5 w-5 flex-none text-muted"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pb-6">
                            <p class="max-w-[640px] text-[15px] leading-relaxed text-secondary">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Still have questions?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Contact support →</x-button>
        </div>
    </section>
@endsection

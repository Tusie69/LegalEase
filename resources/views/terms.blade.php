@extends('layouts.app', ['title' => 'Điều khoản dịch vụ · LegalEase'])

@php
    $lastUpdated = 'May 1, 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Chấp nhận các điều khoản',
            'paras' => [
                "By creating an account or using LegalEase, you agree to these Terms of Service. If you don't agree, please don't use the platform.",
                "These terms apply to both clients seeking legal consultations and lawyers offering services through LegalEase. We may update these terms occasionally and will notify users of material changes through the platform or by email.",
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Đủ điều kiện',
            'paras' => [
                "To use LegalEase as a client, you must be at least 18 years old and able to enter into binding contracts under Vietnamese law. To list as a lawyer, you must hold a current bar membership in Vietnam and pass our verification process.",
                "We reserve the right to refuse service or terminate accounts that don't meet our eligibility requirements.",
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Tài khoản và bảo mật',
            'paras' => [
                "You're responsible for keeping your account credentials secure and for all activity under your account. Notify us immediately if you suspect unauthorized access.",
                "You agree to provide accurate information during signup and to keep your profile up to date. Misrepresentation may result in suspension.",
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Đặt chỗ và đặt cọc',
            'paras' => [
                "LegalEase facilitates the booking of legal consultations between clients and verified lawyers. When a booking is confirmed, the platform holds a deposit equal to 20% of the consultation fee. The remaining 80% is paid directly to the lawyer at the time of the appointment.",
                "Deposits are non-refundable except in the cases set out in our cancellation policy.",
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Hủy và hoàn tiền',
            'paras' => [
                "Cancellations made more than 24 hours before the scheduled appointment are eligible for a full refund of the deposit. Cancellations within 24 hours forfeit the deposit unless the lawyer also cancels or fails to attend.",
                "If a lawyer cancels at any time, the client receives a full refund. If a client doesn't attend, the lawyer retains a portion of the deposit per our policy.",
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Trách nhiệm của luật sư',
            'paras' => [
                "Lawyers listed on LegalEase must hold valid bar credentials, accurately represent their experience and specializations, and conduct consultations professionally.",
                "Lawyers are independent practitioners. LegalEase does not employ lawyers and is not responsible for the legal advice they provide. Lawyers agree to honor confirmed bookings and update their availability promptly to prevent conflicts.",
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Trách nhiệm của khách hàng',
            'paras' => [
                "Clients are expected to attend booked consultations on time, treat lawyers professionally, and provide accurate information about their legal matter. The deposit policy is intended to protect both parties from no-shows.",
                "Clients agree not to use the platform to harass lawyers or share confidential information outside appropriate channels.",
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Đánh giá và xếp hạng',
            'paras' => [
                "Clients may leave honest reviews after a completed consultation. Reviews must be based on direct experience and may not contain personal attacks, confidential information, or content that violates Vietnamese law.",
                "We reserve the right to remove reviews that violate these guidelines. Lawyers may not request, incentivize, or retaliate against reviews.",
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Sở hữu trí tuệ',
            'paras' => [
                "All content provided by LegalEase, including platform design, brand assets, and editorial content, is owned by LegalEase or licensed to us. You may not copy, modify, or distribute our content without permission.",
                "User-generated content (profiles, reviews) remains owned by the user, but you grant us a license to display and distribute it on the platform.",
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Giới hạn trách nhiệm pháp lý',
            'paras' => [
                "LegalEase is a marketplace platform. We do not provide legal advice and are not responsible for the outcomes of consultations conducted through the platform.",
                "To the fullest extent permitted by law, our liability is limited to the platform fees paid in the previous 12 months. We do not warrant that the platform will be error-free or always available.",
            ],
        ],
        [
            'n'     => 11,
            'title' => 'Những thay đổi đối với các điều khoản này',
            'paras' => [
                "We may update these Terms of Service from time to time. Material changes will be communicated through the platform. Continued use after a change constitutes acceptance of the updated terms.",
            ],
        ],
        [
            'n'     => 12,
            'title' => 'Liên hệ',
            'paras' => [
                'Câu hỏi về các điều khoản này? E-mail <a href="mailto:legal@legalease.vn" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">legal@legalease.vn</a> hoặc sử dụng <a href="' . route('contact') . '" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">trang liên hệ</a>.',
            ],
        ],
    ];
@endphp

@section('content')
    <style>
        body > nav {
            background: #ffffff !important;
            backdrop-filter: none !important;
            border-bottom-color: rgba(15, 23, 42, 0.12) !important;
        }
    </style>

    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1593115057322-e94b77572f20?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Last updated {{ $lastUpdated }}</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Terms of Service
            </h1>
        </div>
    </section>

    {{-- Contents --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Contents</p>
        <ol class="mt-6 grid gap-2 text-[14px] sm:grid-cols-2">
            @foreach ($sections as $section)
                <li>
                    <a href="#section-{{ $section['n'] }}" class="text-text transition-colors hover:text-accent">
                        {{ $section['n'] }}. {{ $section['title'] }}
                    </a>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Sections --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        @foreach ($sections as $section)
            <div id="section-{{ $section['n'] }}" class="{{ $loop->first ? '' : 'mt-16' }}">
                <h2 class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    {{ $section['n'] }}. {{ $section['title'] }}
                </h2>
                <div class="mt-5 space-y-4 text-[16px] leading-relaxed text-secondary">
                    @foreach ($section['paras'] as $para)
                        <p>{!! $para !!}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <div class="pb-24"></div>
@endsection

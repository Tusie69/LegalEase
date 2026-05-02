@extends('layouts.app', ['title' => 'Chính sách quyền riêng tư · LegalEase'])

@php
    $lastUpdated = 'May 1, 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Thông tin chúng tôi thu thập',
            'paras' => [
                "We collect information you provide directly when you create an account, book consultations, or contact us. This includes your name, email, phone number, date of birth, gender, and (for lawyers) bar credentials and professional details.",
                "We also collect technical information automatically as you use the platform: device type, IP address, browser, and pages visited. This helps us keep the service running and improve the experience.",
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Cách chúng tôi sử dụng thông tin của bạn',
            'paras' => [
                "We use your information to operate the platform: matching clients with lawyers, processing deposits, sending booking confirmations and reminders, and providing customer support.",
                "We use technical information to monitor performance, detect abuse, and analyze how the platform is used so we can improve it. We do not sell personal information to third parties.",
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Chia sẻ thông tin',
            'paras' => [
                "When you book a consultation, we share necessary details with the lawyer (your name, phone, email, and the time of the appointment). When a lawyer accepts a booking, we share their office address and contact details with you.",
                "We may share information with service providers who help us operate the platform (payment processors, hosting, analytics) under strict confidentiality. We may also disclose information when required by Vietnamese law or to protect the rights and safety of users.",
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Cookie và theo dõi',
            'paras' => [
                "We use cookies and similar technologies to keep you signed in, remember your preferences, and understand how the platform is used. You can disable cookies in your browser, though some features may not work as expected.",
                "We do not use third-party advertising trackers. Our analytics are limited to first-party measurements that help us improve the service.",
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Bảo mật dữ liệu',
            'paras' => [
                "We use industry-standard security practices to protect your data, including encryption in transit, encrypted storage of sensitive fields, and access controls for our team.",
                "No system is perfectly secure. If we become aware of a breach affecting your information, we will notify you without undue delay.",
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Quyền của bạn',
            'paras' => [
                "You have the right to access, correct, or delete the personal information we hold about you. Most of this can be done directly from your account settings; for anything more, contact us at privacy@legalease.vn.",
                "You can also request a copy of your data or ask us to stop processing it for certain purposes. We will respond within a reasonable timeframe consistent with Vietnamese data protection law.",
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Lưu giữ dữ liệu',
            'paras' => [
                "We retain your account information for as long as your account is active. After account deletion, we may keep limited records for legal, tax, or fraud-prevention purposes for up to seven years.",
                "Booking and consultation records are retained for the periods required by Vietnamese law and our financial reporting obligations.",
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Những đứa trẻ\'s privacy',
            'paras' => [
                "LegalEase is not directed to children under 18. We do not knowingly collect personal information from children. If you believe we have collected information from a minor, contact us and we will delete it promptly.",
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Những thay đổi đối với chính sách này',
            'paras' => [
                "We may update this Privacy Policy from time to time. Material changes will be communicated through the platform. The \"Last updated\" date at the top reflects the most recent revision.",
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Liên hệ',
            'paras' => [
                'Các câu hỏi về chính sách này hoặc cách chúng tôi xử lý dữ liệu của bạn? E-mail <a href="mailto:privacy@legalease.vn" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">privacy@legalease.vn</a> hoặc sử dụng <a href="' . route('contact') . '" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">trang liên hệ</a>.',
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1615985250204-b48c0936d4fc?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Last updated {{ $lastUpdated }}</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Privacy Policy
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

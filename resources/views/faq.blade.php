@extends('layouts.app', ['title' => 'Câu hỏi thường gặp · LegalEase'])

@php
    $sections = [
        [
            'title' => 'Đặt chỗ và thanh toán',
            'items' => [
                [
                    'q' => 'Làm thế nào để đặt lịch tư vấn?',
                    'a' => "Browse lawyers by specialty, location, and price. Pick a lawyer, choose a time slot on their profile, then confirm your details. We'll hold a 20% deposit at booking.",
                ],
                [
                    'q' => "What's the deposit?",
                    'a' => 'Khi bạn xác nhận đặt phòng, chúng tôi giữ 20% phí tư vấn làm tiền đặt cọc. 80% còn lại được thanh toán trực tiếp cho luật sư tại thời điểm bổ nhiệm.',
                ],
                [
                    'q' => 'Khi nào tôi thanh toán phần còn lại?',
                    'a' => 'Tại cuộc hẹn. Nền tảng chỉ giữ tiền gửi; số dư được giải quyết trực tiếp giữa bạn và luật sư.',
                ],
                [
                    'q' => 'Những phương thức thanh toán nào bạn chấp nhận?',
                    'a' => 'Các loại thẻ tín dụng và thẻ ghi nợ phổ biến, cộng với các phương thức thanh toán địa phương của Việt Nam bao gồm chuyển khoản ngân hàng và ví điện tử phổ biến.',
                ],
            ],
        ],
        [
            'title' => 'Hủy và hoàn tiền',
            'items' => [
                [
                    'q' => 'Làm cách nào để hủy đặt chỗ?',
                    'a' => "From your dashboard, open the booking and click cancel. We'll process the cancellation according to our refund policy.",
                ],
                [
                    'q' => 'Tôi có lấy lại được tiền đặt cọc không?',
                    'a' => 'Hủy hơn 24 giờ trước cuộc hẹn và bạn sẽ được hoàn lại toàn bộ số tiền. Hủy trong vòng 24 giờ và tiền đặt cọc sẽ bị mất (với một số trường hợp ngoại lệ).',
                ],
                [
                    'q' => 'Nếu luật sư của tôi hủy bỏ thì sao?',
                    'a' => "You'll receive a full refund of the deposit and we'll help you find an alternative lawyer if you'd like.",
                ],
                [
                    'q' => "What if I don't show up?",
                    'a' => 'Tiền đặt cọc bị mất. Nền tảng giữ lại 75% và luật sư nhận được 25% dưới dạng bồi thường cho thời gian dành riêng.',
                ],
            ],
        ],
        [
            'title' => 'Dành cho luật sư',
            'items' => [
                [
                    'q' => 'Làm cách nào để đăng ký tham gia?',
                    'a' => "Visit our For Lawyers page and submit an application. We'll review your bar credentials and respond within a few business days.",
                ],
                [
                    'q' => 'Quá trình xác minh mất bao lâu?',
                    'a' => "Usually 2 to 3 business days. Complex cases may take longer; we'll update you if we need more time.",
                ],
                [
                    'q' => 'Khi nào tôi được trả tiền?',
                    'a' => 'Phần lớn phí của bạn (80%) được khách hàng thanh toán trực tiếp tại cuộc hẹn. Tiền gửi nền tảng được thanh toán vào tài khoản của bạn hàng tuần.',
                ],
                [
                    'q' => 'Tôi có thể đặt mức giá của riêng mình không?',
                    'a' => "Yes. You set your hourly rate when you list and can update it any time, though changes don't affect existing bookings.",
                ],
            ],
        ],
        [
            'title' => 'Sự tin cậy và an toàn',
            'items' => [
                [
                    'q' => 'Luật sư được xác minh như thế nào?',
                    'a' => "Every lawyer on the platform has had their bar membership and credentials reviewed by our team before being listed. We re-verify periodically.",
                ],
                [
                    'q' => 'Việc tư vấn của tôi có được bảo mật không?',
                    'a' => 'Đúng. Việc tư vấn là giữa bạn và luật sư của bạn, được bảo vệ bởi đặc quyền của luật sư-khách hàng theo luật pháp Việt Nam.',
                ],
                [
                    'q' => 'Đánh giá hoạt động như thế nào?',
                    'a' => 'Sau khi tư vấn xong, khách hàng có thể để lại đánh giá bằng văn bản và xếp hạng từ 1 đến 5 sao. Đánh giá phải trung thực và dựa trên kinh nghiệm trực tiếp. Luật sư có thể gắn cờ các đánh giá không phù hợp để nhóm của chúng tôi xem xét.',
                ],
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
            <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
        </div>
    </section>
@endsection

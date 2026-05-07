@extends('layouts.app', ['title' => 'Câu hỏi thường gặp · LegalEase'])

@php
    $sections = [
        [
            'title' => 'Đặt chỗ và thanh toán',
            'items' => [
                [
                    'q' => 'Làm thế nào để đặt lịch tư vấn?',
                    'a' => 'Duyệt danh sách luật sư theo chuyên môn, địa điểm và mức phí. Chọn một luật sư, chọn khung giờ trong hồ sơ của họ, rồi xác nhận thông tin của bạn. Chúng tôi sẽ giữ khoản đặt cọc 20% khi đặt chỗ.',
                ],
                [
                    'q' => 'Khoản đặt cọc là gì?',
                    'a' => 'Khi bạn xác nhận đặt chỗ, chúng tôi giữ 20% phí tư vấn làm khoản đặt cọc. 80% còn lại được thanh toán trực tiếp cho luật sư tại buổi tư vấn.',
                ],
                [
                    'q' => 'Khi nào tôi thanh toán phần còn lại?',
                    'a' => 'Tại cuộc hẹn. Nền tảng chỉ giữ khoản đặt cọc; số dư được giải quyết trực tiếp giữa bạn và luật sư.',
                ],
                [
                    'q' => 'Những phương thức thanh toán nào bạn chấp nhận?',
                    'a' => 'Các loại thẻ tín dụng và thẻ ghi nợ phổ biến, cùng các phương thức thanh toán địa phương như chuyển khoản ngân hàng và ví điện tử.',
                ],
            ],
        ],
        [
            'title' => 'Hủy và hoàn tiền',
            'items' => [
                [
                    'q' => 'Làm cách nào để hủy đặt chỗ?',
                    'a' => 'Từ bảng điều khiển của bạn, mở thông tin đặt chỗ và nhấn hủy. Chúng tôi sẽ xử lý theo chính sách hoàn tiền.',
                ],
                [
                    'q' => 'Tôi có lấy lại được tiền đặt cọc không?',
                    'a' => 'Hủy hơn 24 giờ trước cuộc hẹn và bạn sẽ được hoàn lại toàn bộ số tiền. Hủy trong vòng 24 giờ và tiền đặt cọc sẽ bị mất (với một số trường hợp ngoại lệ).',
                ],
                [
                    'q' => 'Nếu luật sư của tôi hủy thì sao?',
                    'a' => 'Bạn sẽ được hoàn lại toàn bộ khoản đặt cọc, và chúng tôi sẽ giúp bạn tìm một luật sư khác nếu bạn muốn.',
                ],
                [
                    'q' => 'Nếu tôi không tới buổi hẹn thì sao?',
                    'a' => 'Khoản đặt cọc bị mất. Nền tảng giữ lại 75% và luật sư nhận 25% như khoản bồi thường cho thời gian đã dành.',
                ],
            ],
        ],
        [
            'title' => 'Dành cho luật sư',
            'items' => [
                [
                    'q' => 'Làm cách nào để đăng ký tham gia?',
                    'a' => 'Truy cập trang Dành cho luật sư và gửi hồ sơ ứng tuyển. Chúng tôi sẽ xem xét chứng chỉ thành viên đoàn luật sư của bạn và phản hồi trong vài ngày làm việc.',
                ],
                [
                    'q' => 'Quá trình xác minh mất bao lâu?',
                    'a' => 'Thông thường 2 đến 3 ngày làm việc. Các trường hợp phức tạp có thể lâu hơn; chúng tôi sẽ thông báo nếu cần thêm thời gian.',
                ],
                [
                    'q' => 'Khi nào tôi được trả tiền?',
                    'a' => 'Phần lớn phí của bạn (80%) được khách hàng thanh toán trực tiếp tại cuộc hẹn. Khoản đặt cọc do nền tảng giữ sẽ được chuyển vào tài khoản của bạn hàng tuần.',
                ],
                [
                    'q' => 'Tôi có thể tự đặt mức phí của mình không?',
                    'a' => 'Có. Bạn tự đặt mức phí theo giờ khi đăng ký và có thể cập nhật bất kỳ lúc nào, các thay đổi không ảnh hưởng đến những lượt đặt chỗ đã có.',
                ],
            ],
        ],
        [
            'title' => 'Sự tin cậy và an toàn',
            'items' => [
                [
                    'q' => 'Luật sư được xác minh như thế nào?',
                    'a' => 'Mọi luật sư trên nền tảng đều được đội ngũ của chúng tôi kiểm tra tư cách thành viên đoàn luật sư và chứng chỉ trước khi được đăng. Chúng tôi xác minh lại theo định kỳ.',
                ],
                [
                    'q' => 'Việc tư vấn của tôi có được bảo mật không?',
                    'a' => 'Có. Việc tư vấn là giữa bạn và luật sư của bạn, được bảo vệ bởi đặc quyền của luật sư-khách hàng theo luật pháp Việt Nam.',
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
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80"
        eyebrow="FAQ">
        Câu hỏi thường gặp.

        <x-slot:subtitle>
            Đặt chỗ, thanh toán, hủy, và sự tin cậy. Trả lời cho những câu hỏi phổ biến nhất.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- Sections --}}
    @foreach ($sections as $section)
        <section class="container-narrow pt-24">
            <h2 class="text-section-h2">{{ $section['title'] }}</h2>
            <div class="mt-12 border-t border-text/20">
                @foreach ($section['items'] as $item)
                    <div x-data="{ open: false }" class="border-b border-text/20">
                        <button type="button" @click="open = !open"
                                class="flex w-full items-baseline justify-between gap-6 py-6 text-left transition-colors hover:text-accent">
                            <span class="font-display text-[18px] font-medium tracking-tight md:text-[20px]">{{ $item['q'] }}</span>
                            <svg x-show="!open" class="h-5 w-5 flex-none"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <svg x-show="open" x-cloak class="h-5 w-5 flex-none"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pb-6">
                            <p class="text-body max-w-[640px]">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    {{-- Closing CTA --}}
    <section class="container-page closing-cta">
        <h2 class="text-cta-h2">Bạn vẫn còn câu hỏi?</h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Liên hệ hỗ trợ →</x-button>
        </div>
    </section>
@endsection

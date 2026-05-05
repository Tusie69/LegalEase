@extends('layouts.app', ['title' => 'Chính sách quyền riêng tư · LegalEase'])

{{-- Translation note: legal copy translated for readability. Have a Vietnamese legal translator review before publishing. --}}

@php
    $lastUpdated = 'Ngày 1 tháng 5, 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Thông tin chúng tôi thu thập',
            'paras' => [
                'Chúng tôi thu thập thông tin bạn cung cấp trực tiếp khi bạn tạo tài khoản, đặt lịch tư vấn hoặc liên hệ với chúng tôi. Bao gồm họ tên, email, số điện thoại, ngày sinh, giới tính và (đối với luật sư) thông tin chứng chỉ thành viên đoàn luật sư cùng các thông tin chuyên môn.',
                'Chúng tôi cũng tự động thu thập thông tin kỹ thuật khi bạn sử dụng nền tảng: loại thiết bị, địa chỉ IP, trình duyệt và các trang đã xem. Việc này giúp chúng tôi duy trì dịch vụ và cải thiện trải nghiệm.',
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Cách chúng tôi sử dụng thông tin của bạn',
            'paras' => [
                'Chúng tôi sử dụng thông tin của bạn để vận hành nền tảng: kết nối khách hàng với luật sư, xử lý khoản đặt cọc, gửi xác nhận và nhắc nhở lịch hẹn, cũng như cung cấp hỗ trợ khách hàng.',
                'Chúng tôi sử dụng thông tin kỹ thuật để theo dõi hiệu suất, phát hiện hành vi lạm dụng và phân tích cách nền tảng được sử dụng nhằm cải thiện. Chúng tôi không bán thông tin cá nhân cho bên thứ ba.',
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Chia sẻ thông tin',
            'paras' => [
                'Khi bạn đặt lịch tư vấn, chúng tôi chia sẻ các thông tin cần thiết với luật sư (họ tên, số điện thoại, email và thời gian cuộc hẹn). Khi luật sư chấp nhận đặt chỗ, chúng tôi chia sẻ địa chỉ văn phòng và thông tin liên hệ của họ với bạn.',
                'Chúng tôi có thể chia sẻ thông tin với các nhà cung cấp dịch vụ hỗ trợ chúng tôi vận hành nền tảng (đơn vị xử lý thanh toán, lưu trữ, phân tích) trong khuôn khổ bảo mật chặt chẽ. Chúng tôi cũng có thể tiết lộ thông tin khi pháp luật Việt Nam yêu cầu hoặc để bảo vệ quyền lợi và an toàn của người dùng.',
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Cookie và theo dõi',
            'paras' => [
                'Chúng tôi sử dụng cookie và các công nghệ tương tự để giữ bạn đăng nhập, ghi nhớ tùy chọn và hiểu cách nền tảng được sử dụng. Bạn có thể tắt cookie trong trình duyệt, tuy nhiên một số tính năng có thể không hoạt động như mong đợi.',
                'Chúng tôi không sử dụng các trình theo dõi quảng cáo của bên thứ ba. Phân tích của chúng tôi giới hạn ở các phép đo nội bộ giúp cải thiện dịch vụ.',
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Bảo mật dữ liệu',
            'paras' => [
                'Chúng tôi áp dụng các biện pháp bảo mật theo tiêu chuẩn ngành để bảo vệ dữ liệu của bạn, bao gồm mã hóa khi truyền tải, lưu trữ mã hóa các trường nhạy cảm và kiểm soát truy cập của đội ngũ.',
                'Không hệ thống nào tuyệt đối an toàn. Nếu phát hiện một sự cố ảnh hưởng đến thông tin của bạn, chúng tôi sẽ thông báo cho bạn không chậm trễ.',
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Quyền của bạn',
            'paras' => [
                'Bạn có quyền truy cập, chỉnh sửa hoặc xóa thông tin cá nhân mà chúng tôi đang lưu giữ về bạn. Hầu hết các thao tác có thể thực hiện trực tiếp từ phần cài đặt tài khoản; với các yêu cầu khác, vui lòng liên hệ privacy@legalease.vn.',
                'Bạn cũng có thể yêu cầu một bản sao dữ liệu của mình hoặc đề nghị chúng tôi ngừng xử lý dữ liệu cho một số mục đích. Chúng tôi sẽ phản hồi trong một khoảng thời gian hợp lý phù hợp với quy định pháp luật Việt Nam về bảo vệ dữ liệu.',
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Lưu giữ dữ liệu',
            'paras' => [
                'Chúng tôi lưu giữ thông tin tài khoản của bạn trong thời gian tài khoản còn hoạt động. Sau khi tài khoản bị xóa, chúng tôi có thể giữ lại các bản ghi giới hạn cho mục đích pháp lý, thuế hoặc phòng chống gian lận trong thời hạn lên đến bảy năm.',
                'Hồ sơ đặt chỗ và tư vấn được lưu giữ trong các khoảng thời gian theo quy định của pháp luật Việt Nam và nghĩa vụ báo cáo tài chính của chúng tôi.',
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Quyền riêng tư của trẻ em',
            'paras' => [
                'LegalEase không hướng đến trẻ em dưới 18 tuổi. Chúng tôi không cố ý thu thập thông tin cá nhân từ trẻ em. Nếu bạn cho rằng chúng tôi đã thu thập thông tin từ một trẻ vị thành niên, vui lòng liên hệ và chúng tôi sẽ xóa nhanh chóng.',
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Những thay đổi đối với chính sách này',
            'paras' => [
                'Chúng tôi có thể cập nhật Chính sách quyền riêng tư này theo thời gian. Các thay đổi quan trọng sẽ được thông báo qua nền tảng. Ngày "Cập nhật lần cuối" ở đầu trang phản ánh phiên bản mới nhất.',
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Liên hệ',
            'paras' => [
                'Các câu hỏi về chính sách này hoặc cách chúng tôi xử lý dữ liệu của bạn? Gửi email tới <a href="mailto:privacy@legalease.vn" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">privacy@legalease.vn</a> hoặc qua <a href="' . route('contact') . '" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">trang liên hệ</a>.',
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero: photo top, navy bar bottom --}}
    <section class="relative -mt-[72px] flex min-h-screen flex-col overflow-hidden">
        <div class="relative flex-1 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1615985250204-b48c0936d4fc?q=80"
                 alt=""
                 class="absolute inset-0 h-full w-full object-cover">
        </div>

        <div class="bg-accent">
            <div class="mx-auto w-full max-w-[1280px] px-8 py-14 text-center md:py-20">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-white/65">
                    Cập nhật lần cuối: {{ $lastUpdated }}
                </p>
                <h1 class="mx-auto mt-5 max-w-[920px] font-display text-[44px] font-medium leading-[1.1] tracking-[-0.02em] text-white md:text-[64px]">
                    Chính sách quyền riêng tư
                </h1>
                <p class="mx-auto mt-5 max-w-[560px] text-[17px] leading-relaxed text-white/80">
                    Cách chúng tôi thu thập, sử dụng và bảo vệ dữ liệu của bạn.
                </p>
            </div>
        </div>
    </section>

    {{-- Contents --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Mục lục</p>
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

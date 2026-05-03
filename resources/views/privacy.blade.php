@extends('layouts.app', ['title' => 'Chính sách quyền riêng tư · LegalEase'])

@php
    $lastUpdated = '1 tháng 5 năm 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Thông tin chúng tôi thu thập',
            'paras' => [
                "Chúng tôi thu thập thông tin bạn cung cấp trực tiếp khi tạo tài khoản, đặt lịch tư vấn hoặc liên hệ với chúng tôi. Thông tin này gồm tên, email, số điện thoại, ngày sinh, giới tính và đối với luật sư là thông tin đoàn luật sư cùng chi tiết nghề nghiệp.",
                "Chúng tôi cũng tự động thu thập thông tin kỹ thuật khi bạn sử dụng nền tảng: loại thiết bị, địa chỉ IP, trình duyệt và các trang đã truy cập. Điều này giúp chúng tôi duy trì dịch vụ và cải thiện trải nghiệm.",
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Cách chúng tôi sử dụng thông tin của bạn',
            'paras' => [
                "Chúng tôi sử dụng thông tin của bạn để vận hành nền tảng: kết nối khách hàng với luật sư, xử lý tiền đặt cọc, gửi xác nhận và lời nhắc lịch hẹn, cũng như hỗ trợ khách hàng.",
                "Chúng tôi sử dụng thông tin kỹ thuật để theo dõi hiệu năng, phát hiện lạm dụng và phân tích cách nền tảng được sử dụng nhằm cải thiện dịch vụ. Chúng tôi không bán thông tin cá nhân cho bên thứ ba.",
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Chia sẻ thông tin',
            'paras' => [
                "Khi bạn đặt lịch tư vấn, chúng tôi chia sẻ các thông tin cần thiết với luật sư, gồm tên, số điện thoại, email và thời gian hẹn. Khi luật sư nhận lịch, chúng tôi chia sẻ địa chỉ văn phòng và thông tin liên hệ của họ với bạn.",
                "Chúng tôi có thể chia sẻ thông tin với nhà cung cấp dịch vụ hỗ trợ vận hành nền tảng, như xử lý thanh toán, lưu trữ và phân tích, theo nghĩa vụ bảo mật nghiêm ngặt. Chúng tôi cũng có thể tiết lộ thông tin khi pháp luật Việt Nam yêu cầu hoặc để bảo vệ quyền và sự an toàn của người dùng.",
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Cookie và theo dõi',
            'paras' => [
                "Chúng tôi sử dụng cookie và công nghệ tương tự để duy trì đăng nhập, ghi nhớ tùy chọn của bạn và hiểu cách nền tảng được sử dụng. Bạn có thể tắt cookie trong trình duyệt, nhưng một số tính năng có thể không hoạt động như mong đợi.",
                "Chúng tôi không sử dụng trình theo dõi quảng cáo của bên thứ ba. Phân tích của chúng tôi chỉ giới hạn ở dữ liệu đo lường nội bộ nhằm cải thiện dịch vụ.",
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Bảo mật dữ liệu',
            'paras' => [
                "Chúng tôi áp dụng các thực hành bảo mật tiêu chuẩn trong ngành để bảo vệ dữ liệu của bạn, bao gồm mã hóa khi truyền tải, lưu trữ mã hóa đối với trường dữ liệu nhạy cảm và kiểm soát quyền truy cập của đội ngũ.",
                "Không hệ thống nào an toàn tuyệt đối. Nếu phát hiện sự cố ảnh hưởng đến thông tin của bạn, chúng tôi sẽ thông báo cho bạn trong thời gian hợp lý.",
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Quyền của bạn',
            'paras' => [
                "Bạn có quyền truy cập, chỉnh sửa hoặc xóa thông tin cá nhân mà chúng tôi lưu giữ về bạn. Phần lớn thao tác có thể thực hiện trực tiếp trong cài đặt tài khoản; với yêu cầu khác, hãy liên hệ privacy@legalease.vn.",
                "Bạn cũng có thể yêu cầu bản sao dữ liệu hoặc đề nghị chúng tôi ngừng xử lý dữ liệu cho một số mục đích nhất định. Chúng tôi sẽ phản hồi trong thời hạn hợp lý phù hợp với pháp luật bảo vệ dữ liệu của Việt Nam.",
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Lưu giữ dữ liệu',
            'paras' => [
                "Chúng tôi lưu giữ thông tin tài khoản trong thời gian tài khoản còn hoạt động. Sau khi tài khoản bị xóa, chúng tôi có thể giữ một số hồ sơ giới hạn cho mục đích pháp lý, thuế hoặc phòng chống gian lận trong tối đa bảy năm.",
                "Hồ sơ đặt lịch và tư vấn được lưu giữ trong thời hạn theo quy định pháp luật Việt Nam và nghĩa vụ báo cáo tài chính của chúng tôi.",
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Quyền riêng tư của trẻ em',
            'paras' => [
                "LegalEase không dành cho người dưới 18 tuổi. Chúng tôi không cố ý thu thập thông tin cá nhân của trẻ em. Nếu bạn cho rằng chúng tôi đã thu thập thông tin của người chưa thành niên, hãy liên hệ để chúng tôi xóa kịp thời.",
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Những thay đổi đối với chính sách này',
            'paras' => [
                "Chúng tôi có thể cập nhật Chính sách quyền riêng tư theo thời gian. Các thay đổi quan trọng sẽ được thông báo qua nền tảng. Ngày \"Cập nhật lần cuối\" ở đầu trang thể hiện phiên bản mới nhất.",
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
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Cập nhật lần cuối {{ $lastUpdated }}</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Chính sách quyền riêng tư
            </h1>
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

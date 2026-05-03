@extends('layouts.app', ['title' => 'Điều khoản dịch vụ · LegalEase'])

@php
    $lastUpdated = '1 tháng 5 năm 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Chấp nhận các điều khoản',
            'paras' => [
                "Bằng việc tạo tài khoản hoặc sử dụng LegalEase, bạn đồng ý với các Điều khoản dịch vụ này. Nếu không đồng ý, vui lòng không sử dụng nền tảng.",
                "Các điều khoản này áp dụng cho cả khách hàng tìm kiếm tư vấn pháp lý và luật sư cung cấp dịch vụ qua LegalEase. Chúng tôi có thể cập nhật điều khoản theo thời gian và sẽ thông báo các thay đổi quan trọng qua nền tảng hoặc email.",
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Đủ điều kiện',
            'paras' => [
                "Để sử dụng LegalEase với tư cách khách hàng, bạn phải từ 18 tuổi trở lên và có khả năng giao kết hợp đồng theo pháp luật Việt Nam. Để đăng hồ sơ luật sư, bạn phải có tư cách thành viên đoàn luật sư còn hiệu lực tại Việt Nam và vượt qua quy trình xác minh của chúng tôi.",
                "Chúng tôi có quyền từ chối cung cấp dịch vụ hoặc chấm dứt tài khoản không đáp ứng yêu cầu đủ điều kiện.",
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Tài khoản và bảo mật',
            'paras' => [
                "Bạn chịu trách nhiệm bảo mật thông tin đăng nhập và mọi hoạt động diễn ra dưới tài khoản của mình. Hãy thông báo ngay cho chúng tôi nếu nghi ngờ có truy cập trái phép.",
                "Bạn đồng ý cung cấp thông tin chính xác khi đăng ký và duy trì hồ sơ cập nhật. Việc cung cấp thông tin sai lệch có thể dẫn đến tạm ngừng tài khoản.",
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Đặt chỗ và đặt cọc',
            'paras' => [
                "LegalEase hỗ trợ đặt lịch tư vấn pháp lý giữa khách hàng và luật sư đã xác minh. Khi lịch hẹn được xác nhận, nền tảng giữ khoản đặt cọc bằng 20% phí tư vấn. 80% còn lại được thanh toán trực tiếp cho luật sư tại thời điểm hẹn.",
                "Tiền đặt cọc không được hoàn lại, trừ các trường hợp được quy định trong chính sách hủy lịch.",
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Hủy và hoàn tiền',
            'paras' => [
                "Các lịch hủy trước giờ hẹn hơn 24 giờ đủ điều kiện được hoàn lại toàn bộ tiền đặt cọc. Lịch hủy trong vòng 24 giờ sẽ mất tiền đặt cọc, trừ khi luật sư cũng hủy hoặc không tham dự.",
                "Nếu luật sư hủy vào bất kỳ thời điểm nào, khách hàng được hoàn tiền đầy đủ. Nếu khách hàng không tham dự, luật sư được giữ một phần tiền đặt cọc theo chính sách của chúng tôi.",
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Trách nhiệm của luật sư',
            'paras' => [
                "Luật sư trên LegalEase phải có chứng chỉ hành nghề hợp lệ, trình bày chính xác kinh nghiệm và lĩnh vực chuyên môn, đồng thời thực hiện tư vấn một cách chuyên nghiệp.",
                "Luật sư là người hành nghề độc lập. LegalEase không tuyển dụng luật sư và không chịu trách nhiệm về lời khuyên pháp lý họ cung cấp. Luật sư đồng ý thực hiện các lịch hẹn đã xác nhận và cập nhật lịch trống kịp thời để tránh xung đột.",
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Trách nhiệm của khách hàng',
            'paras' => [
                "Khách hàng cần tham dự buổi tư vấn đúng giờ, ứng xử chuyên nghiệp với luật sư và cung cấp thông tin chính xác về vấn đề pháp lý. Chính sách đặt cọc nhằm bảo vệ cả hai bên khỏi việc vắng mặt không báo trước.",
                "Khách hàng đồng ý không sử dụng nền tảng để quấy rối luật sư hoặc chia sẻ thông tin bảo mật ngoài các kênh phù hợp.",
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Đánh giá và xếp hạng',
            'paras' => [
                "Khách hàng có thể để lại đánh giá trung thực sau buổi tư vấn đã hoàn tất. Đánh giá phải dựa trên trải nghiệm trực tiếp và không được chứa công kích cá nhân, thông tin bảo mật hoặc nội dung vi phạm pháp luật Việt Nam.",
                "Chúng tôi có quyền xóa các đánh giá vi phạm hướng dẫn này. Luật sư không được yêu cầu, khuyến khích bằng lợi ích hoặc trả đũa liên quan đến đánh giá.",
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Sở hữu trí tuệ',
            'paras' => [
                "Tất cả nội dung do LegalEase cung cấp, bao gồm thiết kế nền tảng, tài sản thương hiệu và nội dung biên tập, thuộc sở hữu của LegalEase hoặc được cấp phép cho chúng tôi. Bạn không được sao chép, chỉnh sửa hoặc phân phối nội dung của chúng tôi khi chưa được phép.",
                "Nội dung do người dùng tạo như hồ sơ và đánh giá vẫn thuộc sở hữu của người dùng, nhưng bạn cấp cho chúng tôi quyền hiển thị và phân phối nội dung đó trên nền tảng.",
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Giới hạn trách nhiệm pháp lý',
            'paras' => [
                "LegalEase là nền tảng kết nối. Chúng tôi không cung cấp tư vấn pháp lý và không chịu trách nhiệm về kết quả của các buổi tư vấn được thực hiện qua nền tảng.",
                "Trong phạm vi tối đa pháp luật cho phép, trách nhiệm của chúng tôi được giới hạn ở khoản phí nền tảng đã thanh toán trong 12 tháng trước đó. Chúng tôi không bảo đảm nền tảng luôn không lỗi hoặc luôn sẵn sàng.",
            ],
        ],
        [
            'n'     => 11,
            'title' => 'Những thay đổi đối với các điều khoản này',
            'paras' => [
                "Chúng tôi có thể cập nhật Điều khoản dịch vụ theo thời gian. Các thay đổi quan trọng sẽ được thông báo qua nền tảng. Việc tiếp tục sử dụng sau thay đổi đồng nghĩa với việc chấp nhận điều khoản đã cập nhật.",
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
    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1593115057322-e94b77572f20?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Cập nhật lần cuối {{ $lastUpdated }}</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Điều khoản dịch vụ
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

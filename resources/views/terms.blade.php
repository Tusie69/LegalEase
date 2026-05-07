@extends('layouts.app', ['title' => 'Điều khoản dịch vụ · LegalEase'])

@php
    $lastUpdated = 'Ngày 1 tháng 5, 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Chấp nhận các điều khoản',
            'paras' => [
                'Khi tạo tài khoản hoặc sử dụng LegalEase, bạn đồng ý với các Điều khoản dịch vụ này. Nếu bạn không đồng ý, vui lòng không sử dụng nền tảng.',
                'Các điều khoản này áp dụng cho cả khách hàng tìm kiếm tư vấn pháp lý và luật sư cung cấp dịch vụ thông qua LegalEase. Chúng tôi có thể cập nhật các điều khoản này theo thời gian và sẽ thông báo cho người dùng về các thay đổi quan trọng qua nền tảng hoặc qua email.',
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Đủ điều kiện',
            'paras' => [
                'Để sử dụng LegalEase với tư cách khách hàng, bạn phải đủ 18 tuổi và có khả năng giao kết hợp đồng theo pháp luật Việt Nam. Để đăng ký với tư cách luật sư, bạn phải là thành viên hiện hành của một đoàn luật sư tại Việt Nam và vượt qua quy trình xác minh của chúng tôi.',
                'Chúng tôi có quyền từ chối cung cấp dịch vụ hoặc chấm dứt tài khoản không đáp ứng các yêu cầu về điều kiện sử dụng.',
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Tài khoản và bảo mật',
            'paras' => [
                'Bạn chịu trách nhiệm bảo mật thông tin đăng nhập tài khoản và toàn bộ hoạt động phát sinh dưới tài khoản của bạn. Hãy thông báo cho chúng tôi ngay lập tức nếu bạn nghi ngờ có truy cập trái phép.',
                'Bạn đồng ý cung cấp thông tin chính xác khi đăng ký và cập nhật hồ sơ kịp thời. Việc cung cấp thông tin sai lệch có thể dẫn đến đình chỉ tài khoản.',
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Đặt chỗ và đặt cọc',
            'paras' => [
                'LegalEase tạo điều kiện cho khách hàng đặt lịch tư vấn pháp lý với các luật sư đã được xác minh. Khi một lượt đặt chỗ được xác nhận, nền tảng giữ khoản đặt cọc bằng 20% phí tư vấn. 80% còn lại được khách hàng thanh toán trực tiếp cho luật sư tại thời điểm cuộc hẹn diễn ra.',
                'Khoản đặt cọc không hoàn lại, trừ các trường hợp được nêu trong chính sách hủy của chúng tôi.',
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Hủy và hoàn tiền',
            'paras' => [
                'Các yêu cầu hủy được thực hiện trước thời điểm cuộc hẹn hơn 24 giờ sẽ được hoàn lại 100% khoản đặt cọc. Hủy trong vòng 24 giờ trước cuộc hẹn sẽ mất khoản đặt cọc, trừ khi luật sư cũng hủy hoặc không tham dự.',
                'Nếu luật sư hủy ở bất kỳ thời điểm nào, khách hàng được hoàn lại toàn bộ khoản đặt cọc. Nếu khách hàng không tham dự, luật sư giữ một phần khoản đặt cọc theo chính sách của chúng tôi.',
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Trách nhiệm của luật sư',
            'paras' => [
                'Luật sư đăng ký trên LegalEase phải có giấy tờ thành viên đoàn luật sư hợp lệ, mô tả chính xác kinh nghiệm và lĩnh vực chuyên môn, và tiến hành tư vấn một cách chuyên nghiệp.',
                'Luật sư là người hành nghề độc lập. LegalEase không tuyển dụng luật sư và không chịu trách nhiệm về tư vấn pháp lý mà họ cung cấp. Luật sư đồng ý tuân thủ các lượt đặt chỗ đã xác nhận và cập nhật lịch trống kịp thời để tránh xung đột lịch.',
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Trách nhiệm của khách hàng',
            'paras' => [
                'Khách hàng được kỳ vọng đến đúng giờ cho các buổi tư vấn đã đặt, đối xử với luật sư một cách chuyên nghiệp và cung cấp thông tin chính xác về vấn đề pháp lý của mình. Chính sách đặt cọc nhằm bảo vệ cả hai bên khỏi tình trạng không đến hẹn.',
                'Khách hàng đồng ý không sử dụng nền tảng để quấy rối luật sư hoặc chia sẻ thông tin bảo mật ngoài các kênh phù hợp.',
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Đánh giá và xếp hạng',
            'paras' => [
                'Khách hàng có thể để lại đánh giá trung thực sau khi hoàn thành một buổi tư vấn. Đánh giá phải dựa trên trải nghiệm trực tiếp và không được chứa công kích cá nhân, thông tin bảo mật, hoặc nội dung vi phạm pháp luật Việt Nam.',
                'Chúng tôi có quyền gỡ bỏ các đánh giá vi phạm những nguyên tắc trên. Luật sư không được yêu cầu, khuyến khích, hay trả đũa vì các đánh giá.',
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Sở hữu trí tuệ',
            'paras' => [
                'Mọi nội dung do LegalEase cung cấp, bao gồm thiết kế nền tảng, tài sản thương hiệu và nội dung biên tập, đều thuộc sở hữu của LegalEase hoặc được cấp phép cho chúng tôi. Bạn không được sao chép, chỉnh sửa hay phân phối nội dung của chúng tôi nếu không có sự cho phép.',
                'Nội dung do người dùng tạo (hồ sơ, đánh giá) vẫn thuộc sở hữu của người dùng, nhưng bạn cấp cho chúng tôi quyền hiển thị và phân phối nội dung đó trên nền tảng.',
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Giới hạn trách nhiệm pháp lý',
            'paras' => [
                'LegalEase là một nền tảng kết nối. Chúng tôi không cung cấp tư vấn pháp lý và không chịu trách nhiệm về kết quả của các buổi tư vấn được thực hiện qua nền tảng.',
                'Trong phạm vi tối đa được pháp luật cho phép, trách nhiệm của chúng tôi giới hạn ở các khoản phí nền tảng đã được thanh toán trong 12 tháng gần nhất. Chúng tôi không bảo đảm rằng nền tảng luôn không có lỗi hoặc luôn sẵn sàng hoạt động.',
            ],
        ],
        [
            'n'     => 11,
            'title' => 'Những thay đổi đối với các điều khoản này',
            'paras' => [
                'Chúng tôi có thể cập nhật Điều khoản dịch vụ này theo thời gian. Các thay đổi quan trọng sẽ được thông báo qua nền tảng. Việc tiếp tục sử dụng sau khi có thay đổi đồng nghĩa với việc bạn chấp nhận các điều khoản đã được cập nhật.',
            ],
        ],
        [
            'n'     => 12,
            'title' => 'Liên hệ',
            'paras' => [
                'Câu hỏi về các điều khoản này? Gửi email tới <a href="mailto:legal@legalease.vn" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">legal@legalease.vn</a> hoặc qua <a href="' . route('contact') . '" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">trang liên hệ</a>.',
            ],
        ],
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1593115057322-e94b77572f20?q=80"
        :eyebrow="'Cập nhật lần cuối: ' . $lastUpdated">
        Điều khoản dịch vụ

        <x-slot:subtitle>
            Các quy tắc cho khách hàng và luật sư khi sử dụng LegalEase.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- Contents --}}
    <section class="container-narrow pt-24">
        <p class="text-eyebrow">Mục lục</p>
        <ol class="text-body-dense mt-6 grid gap-2 sm:grid-cols-2">
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
    <section class="container-narrow pt-24 pb-24">
        @foreach ($sections as $section)
            <div id="section-{{ $section['n'] }}" class="{{ $loop->first ? '' : 'mt-16' }}">
                <h2 class="text-chapter-h2">
                    {{ $section['n'] }}. {{ $section['title'] }}
                </h2>
                <div class="text-body-prose mt-5 space-y-4">
                    @foreach ($section['paras'] as $para)
                        <p>{!! $para !!}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endsection

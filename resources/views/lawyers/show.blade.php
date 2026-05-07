@extends('layouts.app', ['title' => 'Hồ sơ luật sư · LegalEase'])

@php
    use Carbon\Carbon;

    $profileOverrides = [
        'nguyen-minh-anh' => [
            'name' => 'Nguyễn Minh Anh',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '12 Lý Thường Kiệt, Hoàn Kiếm'],
            'specialty_tags' => ['Luật Hôn nhân & Gia đình', 'Tố tụng dân sự'],
            'bio' => [
                'Luật sư Nguyễn Minh Anh có hơn 12 năm kinh nghiệm trong lĩnh vực hôn nhân và gia đình, tập trung vào ly hôn, quyền nuôi con và tranh chấp tài sản.',
                'Phong cách làm việc của chị là rõ ràng, đồng cảm và thực tế, giúp khách hàng nắm rõ từng bước pháp lý để đưa ra quyết định đúng đắn.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Cử nhân Luật', 'year' => 2011],
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2014],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'tran-van-hung' => [
            'name' => 'Trần Văn Hùng',
            'bar_association' => 'Đoàn Luật sư TP.HCM',
            'address' => ['province' => 'TP.HCM', 'street_address' => '45 Nguyễn Huệ, Quận 1'],
            'specialty_tags' => ['Luật Doanh nghiệp', 'Tố tụng dân sự'],
            'bio' => [
                'Luật sư Trần Văn Hùng tư vấn cho các startup và doanh nghiệp lâu năm trên khắp Việt Nam về thành lập công ty, hợp đồng thương mại và tuân thủ pháp lý. Sau khi tốt nghiệp Đại học Luật TP.HCM, anh làm việc bảy năm tại một công ty luật quốc tế trước khi mở văn phòng riêng để phục vụ các doanh nhân Việt Nam.',
                'Phong cách của anh Hùng là thực tế. Anh xem vai trò của mình là giúp chủ doanh nghiệp đưa ra quyết định rõ ràng, đủ thông tin thay vì khiến họ ngộp trong thuật ngữ pháp lý. Khách hàng của anh trải dài từ những nhà sáng lập lần đầu chuẩn bị hợp đồng đầu tiên đến các công ty lớn đang xử lý thương vụ M&A.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật TP.HCM', 'degree' => 'Cử nhân Luật', 'year' => 2008],
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2013],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'le-thi-huong' => [
            'name' => 'Lê Thị Hương',
            'bar_association' => 'Đoàn Luật sư Đà Nẵng',
            'address' => ['province' => 'Đà Nẵng', 'street_address' => '88 Bạch Đằng, Hải Châu'],
            'specialty_tags' => ['Bất động sản', 'Luật Doanh nghiệp'],
            'bio' => [
                'Luật sư Lê Thị Hương hành nghề tại Đà Nẵng, chuyên về bất động sản. Chị xử lý giao dịch nhà đất, rà soát tình trạng pháp lý và các thỏa thuận thuê mặt bằng cho cả khách hàng cá nhân lẫn doanh nghiệp. Hành nghề của chị bắt đầu từ niềm quan tâm lâu dài đối với giao điểm giữa luật bất động sản và phát triển đô thị.',
                'Chị Hương được đồng nghiệp biết đến với khả năng rà soát hợp đồng tỉ mỉ. Chị tin rằng khoảng cách giữa một giao dịch suôn sẻ và một tranh chấp tốn kém thường nằm ở những trang giấy tờ mà ít người chịu đọc kỹ. Chị làm việc bằng tiếng Việt và tiếng Anh, phục vụ khách hàng trên khắp miền Trung.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật TP.HCM', 'degree' => 'Cử nhân Luật', 'year' => 2014],
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2017],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'pham-quoc-bao' => [
            'name' => 'Phạm Quốc Bảo',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '27 Trần Phú, Ba Đình'],
            'specialty_tags' => ['Bào chữa hình sự'],
            'bio' => [
                'Luật sư Phạm Quốc Bảo có gần hai thập kỷ hành nghề bào chữa hình sự. Tốt nghiệp Đại học Luật Hà Nội, anh đã đại diện cho khách hàng trong các vụ án từ tội phạm cổ cồn trắng đến tội nghiêm trọng, luôn tập trung vào việc bảo đảm quy trình công bằng và kết quả tương xứng.',
                'Uy tín của anh Bảo dựa trên sự chuẩn bị kỹ. Anh được biết đến với việc dành hàng tuần nghiên cứu hồ sơ vụ án mà các luật sư khác có thể chỉ làm trong vài ngày. Với anh, sức nặng của hậu quả hình sự đòi hỏi không gì kém hơn thế. Anh chủ yếu hành nghề bằng tiếng Việt.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Cử nhân Luật', 'year' => 2005],
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2010],
            ],
            'languages' => ['Tiếng Việt'],
        ],
        'hoang-thu-trang' => [
            'name' => 'Hoàng Thu Trang',
            'bar_association' => 'Đoàn Luật sư TP.HCM',
            'address' => ['province' => 'TP.HCM', 'street_address' => '234 Pasteur, Quận 3'],
            'specialty_tags' => ['Luật Lao động'],
            'bio' => [
                'Luật sư Hoàng Thu Trang đại diện cho người lao động và các doanh nghiệp nhỏ trong các tranh chấp lao động tại TP.HCM. Công việc của chị bao gồm hợp đồng lao động, khiếu kiện sa thải trái pháp luật, các vấn đề bảo hiểm xã hội và tranh chấp lao động tập thể. Chị chuyển sang nghề luật sau năm năm làm nhân sự, mang theo góc nhìn thực tế cho công việc pháp lý.',
                'Chị Trang thường nói với khách hàng rằng luật lao động không phải là chuyện thắng tranh luận mà là giúp môi trường làm việc vận hành công bằng. Phần lớn các vụ của chị kết thúc bằng thỏa thuận thay vì ra tòa, và chị xem đó là thước đo tốt cho công việc đã làm.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật TP.HCM', 'degree' => 'Cử nhân Luật', 'year' => 2015],
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Thạc sĩ Luật Lao động', 'year' => 2018],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'vu-duc-minh' => [
            'name' => 'Vũ Đức Minh',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '8 Phạm Văn Đồng, Cầu Giấy'],
            'specialty_tags' => ['Tố tụng dân sự', 'Luật Doanh nghiệp'],
            'bio' => [
                'Luật sư Vũ Đức Minh đã xây dựng hành nghề tranh tụng dân sự tập trung vào tranh chấp hợp đồng, khiếu kiện về tài sản và các vụ việc bồi thường ngoài hợp đồng. Anh được đào tạo tại Khoa Luật - ĐHQG Hà Nội và dành tám năm đầu sự nghiệp tại một công ty luật lớn trong nước, xử lý tranh tụng thương mại trước khi mở văn phòng riêng vào năm 2020.',
                'Triết lý của anh Minh là tranh tụng nên là lựa chọn cuối cùng, không phải đầu tiên. Khi không thể tránh khỏi, anh ưu tiên sự chuẩn bị kỹ lưỡng và lập luận rõ ràng hơn là kịch tính. Anh đã xuất hiện trước nhiều tòa án ở miền Bắc và làm việc bằng tiếng Việt và tiếng Anh.',
            ],
            'education' => [
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Cử nhân Luật', 'year' => 2010],
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2013],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'dang-thi-mai' => [
            'name' => 'Đặng Thị Mai',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '56 Thái Hà, Đống Đa'],
            'specialty_tags' => ['Luật Hôn nhân & Gia đình'],
            'bio' => [
                'Luật sư Đặng Thị Mai chuyên về hôn nhân và gia đình, xây dựng hành nghề quanh các khách hàng đang xử lý ly hôn, quyền nuôi con và giám hộ. Chị bắt đầu sự nghiệp tại một văn phòng ở Hà Nội tập trung vào hòa giải gia đình trước khi chuyển sang tranh tụng gia đình rộng hơn vào năm 2019.',
                'Chị Mai đặc biệt chú ý đến các vụ liên quan đến trẻ em, và thường phối hợp với nhân viên xã hội cũng như các chuyên gia tư vấn gia đình khi cần. Chị xem quy trình pháp lý là một trong nhiều công cụ và luôn thẳng thắn với khách hàng về con đường có khả năng phục vụ gia đình họ tốt nhất.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Cử nhân Luật', 'year' => 2012],
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Thạc sĩ Luật', 'year' => 2015],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'bui-thanh-tung' => [
            'name' => 'Bùi Thanh Tùng',
            'bar_association' => 'Đoàn Luật sư Hà Nội',
            'address' => ['province' => 'Hà Nội', 'street_address' => '203 Hai Bà Trưng, Hoàn Kiếm'],
            'specialty_tags' => ['Luật Doanh nghiệp', 'Tố tụng dân sự'],
            'bio' => [
                'Luật sư Bùi Thanh Tùng tư vấn cho các khách hàng doanh nghiệp về quản trị, M&A và giao dịch xuyên biên giới. Trải qua hơn hai thập kỷ hành nghề, anh đã làm việc với các công ty ở mọi giai đoạn, từ thủ tục thành lập đến những thương vụ mua lại quy mô lớn. Anh được đào tạo tại Đại học Luật Hà Nội và hoàn thành Thạc sĩ chuyên về luật thương mại.',
                'Anh Tùng được biết đến với lời khuyên thẳng thắn, nói với khách hàng những điều họ cần nghe chứ không phải những điều họ muốn nghe. Anh phục vụ khách hàng trên khắp Việt Nam và thường xuyên làm việc với các bên ở Singapore, Nhật Bản và Hàn Quốc.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật Hà Nội', 'degree' => 'Cử nhân Luật', 'year' => 2003],
                ['institution' => 'Khoa Luật - ĐHQG Hà Nội', 'degree' => 'Thạc sĩ Luật Thương mại', 'year' => 2007],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
        'ngo-hai-yen' => [
            'name' => 'Ngô Hải Yến',
            'bar_association' => 'Đoàn Luật sư TP.HCM',
            'address' => ['province' => 'TP.HCM', 'street_address' => '112 Nguyễn Đình Chiểu, Quận 1'],
            'specialty_tags' => ['Bất động sản'],
            'bio' => [
                'Luật sư Ngô Hải Yến xử lý các vấn đề bất động sản nhà ở và thương mại tại TP.HCM. Công việc của chị bao gồm giao dịch mua bán, rà soát giấy chứng nhận quyền sử dụng đất và cho thuê thương mại. Chị bắt đầu sự nghiệp tại một văn phòng chuyên về bất động sản trước khi mở văn phòng riêng vào năm 2023.',
                'Chị Yến đặc biệt chú ý đến những người mua nhà lần đầu, vốn cần nhiều bối cảnh hơn so với nhà đầu tư có kinh nghiệm. Chị tin rằng chất lượng của một giao dịch bất động sản được quyết định từ rất lâu trước khi ký, ở những câu hỏi được đặt ra, những giấy tờ được kiểm tra và những điều khoản được đàm phán cẩn thận.',
            ],
            'education' => [
                ['institution' => 'Đại học Luật TP.HCM', 'degree' => 'Cử nhân Luật', 'year' => 2016],
                ['institution' => 'Đại học Luật TP.HCM', 'degree' => 'Thạc sĩ Luật', 'year' => 2019],
            ],
            'languages' => ['Tiếng Việt', 'Tiếng Anh'],
        ],
    ];

    if (isset($profileOverrides[$lawyer['slug']])) {
        $lawyer = array_replace_recursive($lawyer, $profileOverrides[$lawyer['slug']]);
    }

    $today = Carbon::today('Asia/Ho_Chi_Minh');
    $days = [];
    foreach ($lawyer['availability'] as $entry) {
        $date = $today->copy()->addDays($entry['day_offset']);
        $slotList = [];
        foreach ($entry['slots'] as $t) {
            $slotList[] = [
                'time'  => $t,
                'label' => Carbon::createFromFormat('H:i', $t)->format('g:i A'),
            ];
        }
        $days[] = [
            'abbrev'  => strtoupper($date->format('D')),
            'dayNum'  => $date->day,
            'dateStr' => $date->toDateString(),
            'slots'   => $slotList,
        ];
    }
@endphp

@section('content')
    <section class="container-page py-20">
        {{-- Breadcrumb --}}
        <nav class="text-[14px]">
            <a href="/" class="transition-colors hover:text-accent">Trang chủ</a>
            <span class="px-1">/</span>
            <a href="/lawyers" class="transition-colors hover:text-accent">Luật sư</a>
            <span class="px-1">/</span>
            <span class="text-text">{{ $lawyer['name'] }}</span>
        </nav>

        <div class="mt-10 grid gap-16 lg:grid-cols-3">
            <div class="min-w-0 lg:col-span-2">
                {{-- Portrait --}}
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $lawyer['portrait_url'] }}"
                         alt="{{ $lawyer['name'] }}"
                         class="aspect-[4/5] max-h-[560px] w-full object-cover object-top">
                </div>

                {{-- Identity --}}
                <h1 class="mt-10 font-display text-[40px] font-medium leading-snug tracking-tight md:text-[48px]">
                    {{ $lawyer['name'] }}
                </h1>

                <p class="text-body mt-2">
                    Luật sư
                    @if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }} @endif
                    · {{ $lawyer['years_of_experience'] }} năm kinh nghiệm
                </p>

                <div class="mt-3">
                    <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" />
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($lawyer['specialty_tags'] as $tag)
                        <span class="text-status-pill inline-flex items-center rounded-full border border-text/30 px-3 py-1">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>

                {{-- Bio --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Giới thiệu</h2>
                    <div class="text-body mt-4 space-y-4">
                        @foreach ($lawyer['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Education --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Học vấn</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach ($lawyer['education'] as $edu)
                            <li class="flex items-baseline justify-between gap-6 border-b border-text/20 pb-3">
                                <div>
                                    <p class="text-body text-text">{{ $edu['degree'] }}</p>
                                    <p class="text-caption">{{ $edu['institution'] }}</p>
                                </div>
                                <span class="text-caption">{{ $edu['year'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Languages --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Ngôn ngữ</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['languages'] as $lang)
                            <span class="inline-flex items-center rounded-full border border-text/30 px-3 py-1 text-[14px] text-text">
                                {{ $lang }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Reviews --}}
                <div class="mt-12">
                    <h2 class="text-card-h3">Đánh giá của khách hàng</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($lawyer['reviews'] as $review)
                            @php
                                $initial = mb_strtoupper(mb_substr($review['author'], 0, 1));
                                $reviewDate = Carbon::parse($review['date'])->format('d/m/Y');
                            @endphp
                            <article class="card-base">
                                <header class="flex items-start gap-4">
                                    <div class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-text/10 font-display text-[18px] font-medium text-text">
                                        {{ $initial }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-baseline justify-between gap-4">
                                            <p class="text-[16px] font-medium text-text">{{ $review['author'] }}</p>
                                            <p class="text-caption">{{ $reviewDate }}</p>
                                        </div>
                                        <div class="mt-1">
                                            <x-rating-stars :rating="$review['stars']" size="sm" />
                                        </div>
                                    </div>
                                </header>
                                <p class="text-body mt-4 text-text/90">{{ $review['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Booking sidebar --}}
            <aside class="min-w-0 lg:col-span-1">
                <div class="lg:sticky lg:top-22"
                     x-data='{
                        selected: 0,
                        days: @json($days),
                        pickSlot(dateStr, time, label) {
                            const params = new URLSearchParams({
                                lawyer: "{{ $lawyer['slug'] }}",
                                date: dateStr,
                                time: time,
                            });
                            window.location.href = "{{ route('book.start') }}?" + params.toString();
                        }
                    }'>
                    <div class="card-base-lg flex min-h-[560px] flex-col">
                        <h3 class="text-card-h3">Đặt lịch tư vấn</h3>

                        <div class="mt-4">
                            <p class="font-display text-[32px] font-medium leading-none tracking-tight text-accent">
                                {{ number_format($lawyer['price_per_hour']) }} VND
                            </p>
                            <p class="text-caption mt-2">mỗi lần tư vấn</p>
                        </div>

                        @if (!empty($lawyer['address']['street_address']))
                            <div class="mt-5 flex items-start gap-2 text-[14px]">
                                <x-icon name="map-pin" :size="16" class="flex-none" />
                                <span>
                                    {{ $lawyer['address']['street_address'] }}, {{ $lawyer['address']['province'] }}
                                </span>
                            </div>
                        @endif

                        <div class="my-6 h-px bg-text/10"></div>

                        {{-- Day picker --}}
                        <div class="flex gap-1.5 overflow-hidden pb-1">
                            @foreach ($days as $i => $day)
                                <button type="button"
                                        @click="selected = {{ $i }}"
                                        :class="selected === {{ $i }} ? 'bg-accent text-bg border-accent' : 'border-text/30 text-text hover:border-accent'"
                                        class="flex min-w-0 flex-1 flex-col items-center rounded-xl border px-1 py-2 transition-colors">
                                    <span class="text-eyebrow-tight"
                                          :class="selected === {{ $i }} ? 'text-bg/65' : 'text-text/55'">
                                        {{ $day['abbrev'] }}
                                    </span>
                                    <span class="mt-0.5 font-display text-[18px] font-medium leading-none">
                                        {{ $day['dayNum'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        {{-- Time slots --}}
                        <div class="mt-6">
                            <h4 class="text-eyebrow">Thời gian có sẵn</h4>
                        </div>

                        @foreach ($days as $i => $day)                            <div x-show="selected === {{ $i }}" x-cloak class="mt-4">
                                @if (count($day['slots']) === 0)
                                    <p class="text-[14px]">Không có thời gian trống vào ngày này.</p>
                                @else
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($day['slots'] as $slot)
                                            <button type="button"
                                                    @click="pickSlot('{{ $day['dateStr'] }}', '{{ $slot['time'] }}', '{{ $slot['label'] }}')"
                                                    class="rounded-xl border border-text/30 px-3 py-3 text-center text-[14px] text-text transition-colors hover:border-accent hover:bg-accent/10">
                                                {{ $slot['label'] }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

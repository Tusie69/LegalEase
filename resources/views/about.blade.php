@extends('layouts.app', ['title' => 'Giới thiệu · LegalEase'])

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1610374792793-f016b77ca51a?q=80"
        eyebrow="Vì sao chúng tôi bắt đầu">
        Pháp lý không còn là chuyện khó hiểu.

        <x-slot:subtitle>
            Chúng tôi kết nối người dùng tại Việt Nam với các luật sư đã được xác minh một cách nhanh chóng và minh bạch.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- Problem block --}}
    <section class="container-page pt-24 md:pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <x-responsive-img src="https://images.pexels.com/photos/33472306/pexels-photo-33472306.jpeg"
                                  alt=""
                                  sizes="(min-width: 768px) 50vw, 100vw"
                                  :widths="[400, 600, 900, 1200]"
                                  class="aspect-square w-full object-cover" />
            </div>
            <div>
                <p class="text-eyebrow">Vấn đề</p>
                <h3 class="text-section-h2 mt-5 leading-snug">
                    Tìm luật sư bằng truyền miệng chưa bao giờ là chiến lược tốt.
                </h3>
                <p class="text-body-prose mt-6 max-w-[480px]">
                    Với phần lớn người dùng ở Việt Nam, việc tìm luật sư thường bắt đầu bằng hỏi người quen và hy vọng may mắn. Mức phí chênh lệch lớn, năng lực khó kiểm chứng và rủi ro lựa chọn sai rất cao.
                </p>
            </div>
        </div>
    </section>

    {{-- Solution block --}}
    <section class="container-page pt-24 md:pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="md:order-2 overflow-hidden rounded-2xl">
                <x-responsive-img src="https://images.unsplash.com/photo-1758518726775-70e538b0d46e"
                                  alt=""
                                  sizes="(min-width: 768px) 50vw, 100vw"
                                  :widths="[400, 600, 900, 1200]"
                                  class="aspect-square w-full object-cover" />
            </div>
            <div class="md:order-1">
                <p class="text-eyebrow">Giải pháp chúng tôi xây dựng</p>
                <h3 class="text-section-h2 mt-5 leading-snug">
                    Xác minh rõ ràng, minh bạch chi phí, đặt lịch nhanh.
                </h3>
                <p class="text-body-prose mt-6 max-w-[480px]">
                    Mỗi luật sư đều được đội ngũ LegalEase rà soát trước khi hiển thị. Mức phí theo giờ được công khai, lịch trống cập nhật liên tục và thao tác đặt lịch chỉ trong vài phút.
                </p>
            </div>
        </div>
    </section>

    {{-- Stat moment --}}
    <section class="container-page pt-24 md:pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <x-responsive-img src="https://images.pexels.com/photos/7693114/pexels-photo-7693114.jpeg"
                                  alt=""
                                  sizes="(min-width: 768px) 50vw, 100vw"
                                  :widths="[400, 600, 900, 1200]"
                                  class="aspect-square w-full object-cover" />
            </div>
            <div>
                <p class="display-stat-feature">
                    500+
                </p>
                <h3 class="text-chapter-h2 mt-5">
                    Luật sư đã xác minh trên toàn quốc.
                </h3>
                <p class="text-body-prose mt-4 max-w-[420px]">
                    Hiện diện tại hơn 12 tỉnh, thành phố với thông tin hành nghề và chứng chỉ được kiểm tra trước khi công khai.
                </p>
            </div>
        </div>
    </section>

    {{-- Success stories --}}
    @php
        $successStories = [
            [
                'image' => 'https://images.pexels.com/photos/4623175/pexels-photo-4623175.jpeg',
                'lead'  => 'Bảo vệ sáng tạo',
                'title' => 'Thắng vụ tranh chấp sở hữu trí tuệ',
                'desc'  => 'Đại diện một startup công nghệ trong vụ tranh chấp sở hữu trí tuệ phức tạp, giữ vững quyền sử dụng công nghệ cốt lõi và mở đường cho vòng gọi vốn tiếp theo.',
                'tag'   => 'Doanh nghiệp',
                'href'  => '#',
            ],
            [
                'image' => 'https://images.pexels.com/photos/8124194/pexels-photo-8124194.jpeg',
                'lead'  => 'Bị buộc tội oan',
                'title' => 'Hủy bỏ cáo buộc hình sự',
                'desc'  => 'Đảm bảo việc bãi bỏ cáo buộc hình sự do thiếu chứng cứ, bảo vệ thân chủ khỏi bản án sai và giữ gìn quyền lợi hợp pháp.',
                'tag'   => 'Bào chữa hình sự',
                'href'  => '#',
            ],
            [
                'image' => 'https://images.pexels.com/photos/8469986/pexels-photo-8469986.jpeg',
                'lead'  => 'Đòi lại lương',
                'title' => 'Mười hai công nhân được trả nợ lương',
                'desc'  => 'Sau sáu tuần thương lượng với chủ doanh nghiệp, toàn bộ ba tháng tiền lương tồn đọng được hoàn lại từng người, không cần ra tòa.',
                'tag'   => 'Lao động',
                'href'  => '#',
            ],
            [
                'image' => 'https://images.pexels.com/photos/7642217/pexels-photo-7642217.jpeg',
                'lead'  => 'Giữ gìn gia đình',
                'title' => 'Giành quyền nuôi con qua hòa giải',
                'desc'  => 'Một thỏa thuận hai bên cùng ký, không cần đến tòa, giữ cuộc sống của hai con nguyên vẹn nhất có thể trong giai đoạn chuyển tiếp.',
                'tag'   => 'Hôn nhân & Gia đình',
                'href'  => '#',
            ],
        ];
    @endphp

    <section x-data="successStoriesCarousel({{ count($successStories) }})"
             @mouseenter="pause()"
             @mouseleave="play()"
             class="container-page pt-24 md:pt-32">
        <h2 class="text-section-h2">Câu chuyện thành công</h2>
        <p class="text-body-prose mt-6 max-w-[640px]">
            Những vụ việc đã được giải quyết và cách chuyên môn pháp lý mang lại kết quả thực tế cho khách hàng.
        </p>

        {{-- Carousel slides --}}
        <div class="mt-12 grid">
            @foreach ($successStories as $i => $story)
                <div :class="currentSlide === {{ $i }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                     class="col-start-1 row-start-1 transition-opacity duration-500">
                    <a href="{{ $story['href'] }}" class="block group">
                        <article class="grid gap-8 lg:grid-cols-2 lg:items-center lg:gap-12">
                            {{-- Image --}}
                            <div class="overflow-hidden rounded-2xl">
                                <x-responsive-img :src="$story['image']"
                                                  alt=""
                                                  sizes="(min-width: 1024px) 50vw, 100vw"
                                                  :widths="[600, 900, 1200, 1600]"
                                                  class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]" />
                            </div>

                            {{-- Text --}}
                            <div>
                                <p class="text-eyebrow">{{ $story['tag'] }}</p>
                                <h3 class="text-feature-h3 mt-4 transition-colors group-hover:text-accent">
                                    <span class="italic">{{ $story['lead'] }}:</span>
                                    <span>{{ $story['title'] }}</span>
                                </h3>
                                <p class="text-body mt-5 max-w-[520px]">
                                    {{ $story['desc'] }}
                                </p>
                                <p class="text-link-action mt-6 inline-flex items-center gap-2 text-text transition-colors group-hover:text-accent">
                                    <span>Đọc thêm</span>
                                    <span aria-hidden="true">→</span>
                                </p>
                            </div>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Pagination dots --}}
        <div class="mt-10 flex justify-center gap-2">
            @foreach ($successStories as $i => $_)
                <button type="button"
                        @click="goTo({{ $i }})"
                        aria-label="Câu chuyện {{ $i + 1 }}"
                        :class="currentSlide === {{ $i }} ? 'w-8 bg-accent' : 'w-2 bg-text/30 hover:bg-text/50'"
                        class="h-2 rounded-full transition-all"></button>
            @endforeach
        </div>
    </section>

    {{-- Team --}}
    @php
        $team = [
            [
                'name' => 'Emma Brooks',
                'role' => 'Đồng sáng lập, CEO',
                'bio'  => '8 năm kinh nghiệm tranh tụng tại một hãng luật quốc tế ở London. Rời công việc cũ để xây dựng trải nghiệm pháp lý đơn giản hơn cho người dùng tại Việt Nam.',
                'portrait' => 'https://images.unsplash.com/photo-1714974528915-4c74c4c0bb27?q=80',
            ],
            [
                'name' => 'Michael Hartley',
                'role' => 'Đồng sáng lập, Xác minh',
                'bio'  => 'Từng có 6 năm làm việc trong mảng tuân thủ và chuẩn mực hành nghề luật sư tại các hãng luật ở New York, phụ trách quy trình xác minh hồ sơ tại nền tảng.',
                'portrait' => 'https://images.unsplash.com/photo-1720805752653-10ddccea4c94?q=80',
            ],
            [
                'name' => 'Sophia Lin',
                'role' => 'Đồng sáng lập, Sản phẩm',
                'bio'  => 'Xây dựng nhiều sản phẩm số cho người dùng đại chúng tại Singapore và Hà Nội, tập trung vào trải nghiệm đặt lịch, thanh toán và minh bạch thông tin.',
                'portrait' => 'https://images.unsplash.com/photo-1733348137479-2e726d326d9b?q=80',
            ],
        ];
    @endphp

    <section class="container-page pt-24 md:pt-32">
        <p class="text-eyebrow">Đội ngũ</p>
        <h2 class="text-section-h2 mt-5">
            Ba người sáng lập, một điều muốn thay đổi.
        </h2>

        <div class="mt-12 grid gap-10 md:grid-cols-3">
            @foreach ($team as $member)
                <div>
                    <div class="overflow-hidden rounded-2xl bg-bg">
                        <x-responsive-img :src="$member['portrait']"
                                          :alt="$member['name']"
                                          sizes="(min-width: 768px) 33vw, 100vw"
                                          :widths="[400, 600, 800]"
                                          class="aspect-[4/5] w-full object-cover object-top" />
                    </div>
                    <h3 class="text-card-h3 mt-5">{{ $member['name'] }}</h3>
                    <p class="text-eyebrow mt-1">{{ $member['role'] }}</p>
                    <p class="text-body mt-3">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Values --}}
    @php
        $values = [
            [
                'short' => 'Minh bạch',
                'title' => 'Giá cả minh bạch',
                'desc'  => 'Giá theo giờ được hiển thị rõ trước khi bạn đặt lịch. Không phụ phí ẩn, không bất ngờ sau buổi tư vấn.',
                'chip'  => '850.000 VND / giờ, hiển thị trước',
                'image' => 'https://images.pexels.com/photos/7718798/pexels-photo-7718798.jpeg',
            ],
            [
                'short' => 'Công bằng',
                'title' => 'Không thiên vị trả phí',
                'desc'  => 'Không có phí giới thiệu, không có bảng xếp hạng ưu tiên trả tiền. Bạn thấy luật sư phù hợp nhất, không phải người trả nhiều nhất.',
                'chip'  => 'Xếp hạng theo đánh giá, không theo ngân sách',
                'image' => 'https://images.pexels.com/photos/5520330/pexels-photo-5520330.jpeg',
            ],
            [
                'short' => 'Tin cậy',
                'title' => 'Thông tin đã xác minh',
                'desc'  => 'Mỗi luật sư đều trải qua quy trình xác minh chứng chỉ hành nghề, lịch sử kỷ luật và danh tính trước khi xuất hiện trên LegalEase.',
                'chip'  => 'Xác minh trực tiếp trước khi niêm yết',
                'image' => 'https://images.pexels.com/photos/17262454/pexels-photo-17262454.jpeg',
            ],
            [
                'short' => 'Chủ động',
                'title' => 'Không ràng buộc',
                'desc'  => 'Sau buổi tư vấn, bạn hoàn toàn chủ động quyết định bước tiếp theo. Không cam kết dài hạn, không phí hủy.',
                'chip'  => 'Không hợp đồng trói buộc',
                'image' => 'https://images.pexels.com/photos/7677826/pexels-photo-7677826.jpeg',
            ],
        ];
    @endphp

    <section class="container-page pt-24 md:pt-32">
        <p class="text-eyebrow">Cách chúng tôi làm việc</p>
        <h2 class="text-section-h2 mt-5">
            Bốn điều chúng tôi không bao giờ thoả hiệp.
        </h2>
        <p class="text-body-prose mt-6 max-w-[56ch] text-text/70">
            Mỗi quyết định thiết kế trên LegalEase đều quay về bốn nguyên tắc này, để bạn luôn rõ ràng, công bằng và hoàn toàn chủ động.
        </p>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($values as $i => $v)
                <article class="group flex flex-col gap-4 transition-transform duration-200 hover:-translate-y-0.5">
                    <div class="relative aspect-[16/10] overflow-hidden rounded-2xl bg-text/5">
                        <img src="{{ $v['image'] }}" alt="" loading="lazy"
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.04]">
                        <span class="absolute bottom-4 left-4 inline-flex items-center gap-2 rounded-full border border-text/15 bg-bg/95 px-4 py-2 text-caption font-medium text-text backdrop-blur">
                            <span aria-hidden="true" class="inline-block h-2 w-2 rounded-full bg-accent"></span>
                            {{ $v['chip'] }}
                        </span>
                    </div>
                    <div class="flex flex-1 flex-col gap-3 rounded-2xl border border-text/20 p-7 transition-colors group-hover:border-accent">
                        <p class="text-eyebrow text-text/60">{{ sprintf('%02d', $i + 1) }}. {{ $v['short'] }}</p>
                        <h3 class="text-card-h3">{{ $v['title'] }}</h3>
                        <p class="text-body-dense text-text/70">{{ $v['desc'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <x-closing-cta
        heading="Bắt đầu với đúng luật sư của bạn."
        subtitle="Tìm hồ sơ luật sư đã được xác minh với mức phí minh bạch. Bạn quyết định bước tiếp theo, không có ràng buộc."
        button="Tìm kiếm luật sư →"
        href="/lawyers" />

    <script>
        function successStoriesCarousel(count) {
            return {
                currentSlide: 0,
                count,
                interval: null,

                init() {
                    this.play();
                },

                play() {
                    this.pause();
                    if (this.count <= 1) return;
                    this.interval = setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.count;
                    }, 5000);
                },

                pause() {
                    if (this.interval) {
                        clearInterval(this.interval);
                        this.interval = null;
                    }
                },

                goTo(index) {
                    this.currentSlide = index;
                    this.play();
                },
            };
        }
    </script>
@endsection

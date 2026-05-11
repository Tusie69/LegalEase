@extends('layouts.app', ['title' => 'Giới thiệu · LegalEase'])

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1610374792793-f016b77ca51a?q=80"
        eyebrow="Câu chuyện của chúng tôi">
        Trợ giúp pháp lý rõ ràng, không còn mơ hồ.

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
                'lead'  => 'Lương được hoàn',
                'title' => 'Mười hai công nhân được trả nợ',
                'desc'  => 'Sau sáu tuần thương lượng với chủ doanh nghiệp, toàn bộ ba tháng tiền lương tồn đọng được hoàn lại từng người, không cần ra tòa.',
                'tag'   => 'Lao động',
                'href'  => '#',
            ],
            [
                'image' => 'https://images.pexels.com/photos/7642217/pexels-photo-7642217.jpeg',
                'lead'  => 'Gia đình giữ nguyên',
                'title' => 'Quyền nuôi con bằng hòa giải',
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
            Ba con người, một nỗi trăn trở chung.
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
            ['title' => 'Giá cả minh bạch', 'desc' => 'Giá theo giờ được hiển thị rõ trước khi bạn đặt lịch.'],
            ['title' => 'Không thiên vị trả phí', 'desc' => 'Không có phí giới thiệu, không có bảng xếp hạng ưu tiên trả tiền.'],
            ['title' => 'Thông tin đã xác minh', 'desc' => 'Mỗi luật sư đều trải qua quy trình xác minh trước khi niêm yết.'],
            ['title' => 'Không ràng buộc', 'desc' => 'Sau buổi tư vấn, bạn hoàn toàn chủ động quyết định bước tiếp theo.'],
        ];
    @endphp

    <section class="container-page pt-24 md:pt-32">
        <p class="text-eyebrow">Cách chúng tôi làm việc</p>
        <h2 class="text-section-h2 mt-5">
            Bốn cam kết cốt lõi.
        </h2>

        <div class="mt-12 grid gap-x-16 gap-y-12 md:grid-cols-2">
            @foreach ($values as $v)
                <div class="border-t border-text/15 pt-6">
                    <h3 class="text-card-h3">{{ $v['title'] }}</h3>
                    <p class="text-body-dense mt-3">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gold/5 mt-24 md:mt-32">
        <div class="container-page closing-cta">
            <h2 class="text-cta-h2">
                Sẵn sàng tìm luật sư phù hợp với bạn?
            </h2>
            <p class="text-body-prose mx-auto mt-6 max-w-[520px]">
                Duyệt hồ sơ luật sư đã được xác minh với mức phí minh bạch. Bạn quyết định bước tiếp theo, không có ràng buộc.
            </p>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="/lawyers">Tìm kiếm luật sư →</x-button>
            </div>
        </div>
    </section>

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

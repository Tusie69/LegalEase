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
                <p class="font-display text-[56px] font-medium leading-none tracking-tighter md:text-[72px]">
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

    <section class="container-page pt-24 md:pt-32"
             x-data="{
                 idx: 0,
                 count: {{ count($successStories) }},
                 prev() { if (this.idx > 0) this.idx--; },
                 next() { if (this.idx < this.count - 1) this.idx++; },
             }">
        <div class="flex flex-col items-start gap-8 md:flex-row md:items-end md:justify-between md:gap-8">
            <div class="max-w-[640px]">
                <h2 class="text-section-h2">Câu chuyện thành công</h2>
                <p class="text-body-prose mt-6">
                    Những vụ việc đã được giải quyết và cách chuyên môn pháp lý mang lại kết quả thực tế cho khách hàng.
                </p>
            </div>
            <div class="flex flex-none gap-3">
                <button type="button"
                        @click="prev()"
                        :disabled="idx === 0"
                        :class="idx === 0 ? 'opacity-30 cursor-not-allowed' : 'hover:border-accent hover:text-accent'"
                        aria-label="Câu chuyện trước"
                        class="flex h-12 w-12 items-center justify-center rounded-full border border-text/30 text-text transition-colors">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" x2="5" y1="12" y2="12"/>
                        <polyline points="11 18 5 12 11 6"/>
                    </svg>
                </button>
                <button type="button"
                        @click="next()"
                        :disabled="idx === count - 1"
                        :class="idx === count - 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-text'"
                        aria-label="Câu chuyện kế"
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-accent text-bg transition-colors">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" x2="19" y1="12" y2="12"/>
                        <polyline points="13 6 19 12 13 18"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="mt-12 overflow-hidden">
            <div class="flex transition-transform duration-500 ease-out"
                 :style="`transform: translateX(-${idx * 100}%)`">
                @foreach ($successStories as $story)
                    <article class="w-full flex-none">
                        <a href="{{ $story['href'] }}" class="group grid gap-6 md:grid-cols-2 md:gap-12 lg:gap-16">
                            <div class="aspect-square overflow-hidden rounded-2xl">
                                <x-responsive-img :src="$story['image']"
                                                  alt=""
                                                  sizes="(min-width: 768px) 50vw, 100vw"
                                                  :widths="[400, 600, 900, 1200]"
                                                  class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]" />
                            </div>

                            <div class="flex flex-col md:justify-center">
                                <h3 class="text-feature-h3 text-text">
                                    <span class="italic">{{ $story['lead'] }}:</span>
                                    <span>{{ $story['title'] }}</span>
                                </h3>
                                <p class="text-body-prose mt-6 max-w-[520px]">
                                    {{ $story['desc'] }}
                                </p>
                                <div class="mt-6 flex items-center justify-between gap-4">
                                    <span class="tag-pill">
                                        {{ $story['tag'] }}
                                    </span>
                                    <p class="text-link-action flex items-center gap-2 text-text transition-colors group-hover:text-accent">
                                        Đọc thêm
                                        <span aria-hidden="true">→</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>

    </section>

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
                <div>
                    <h3 class="text-card-h3 leading-snug">{{ $v['title'] }}</h3>
                    <p class="text-body mt-3 max-w-[440px]">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-gold/5 mt-24 md:mt-32">
        <div class="container-page closing-cta">
            <h2 class="text-cta-h2">
                Sẵn sàng tìm luật sư phù hợp với bạn?
            </h2>
            <div class="mt-10 flex justify-center">
                <x-button variant="primary" href="/lawyers">Tìm kiếm luật sư →</x-button>
            </div>
        </div>
    </section>
@endsection

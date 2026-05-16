@extends('layouts.app', ['title' => 'Nghề nghiệp · LegalEase'])

@php
    $values = [
        [
            'short' => 'Sứ mệnh',
            'title' => 'Định hướng sứ mệnh',
            'desc'  => 'Mọi vai trò đều gắn trực tiếp với mục tiêu giúp người Việt tiếp cận pháp luật dễ dàng hơn. Công việc của bạn đến tay người dùng ngay trong tuần này.',
            'chip'  => 'Sản phẩm ra mắt mỗi tuần',
            'image' => 'https://images.pexels.com/photos/5324941/pexels-photo-5324941.jpeg',
        ],
        [
            'short' => 'Văn phòng',
            'title' => 'Trụ sở tại Hà Nội',
            'desc'  => 'Văn phòng ngay trung tâm Hà Nội. Ba ngày tại văn phòng, hai ngày làm việc từ xa, để bạn vừa giữ sự gắn kết của đội ngũ vừa có không gian tập trung.',
            'chip'  => '3 ngày văn phòng, 2 ngày từ xa',
            'image' => 'https://images.pexels.com/photos/35215417/pexels-photo-35215417.jpeg',
        ],
        [
            'short' => 'Tác động',
            'title' => 'Tác động nhìn thấy được',
            'desc'  => 'Đội ngũ nhỏ, quy mô đang lớn nhanh. Việc bạn làm hôm nay, người dùng thấy tuần sau, không qua nhiều lớp quy trình.',
            'chip'  => 'Dưới 25 người trong toàn công ty',
            'image' => 'https://images.pexels.com/photos/159760/computer-pc-workplace-home-office-159760.jpeg',
        ],
        [
            'short' => 'Phát triển',
            'title' => 'Ngân sách học tập',
            'desc'  => 'Ngân sách hằng năm cho khóa học, sách, hội nghị, hoặc bất cứ điều gì giúp bạn nâng cao kỹ năng và mở rộng tư duy.',
            'chip'  => '20 triệu / năm cho mỗi người',
            'image' => 'https://images.pexels.com/photos/5951549/pexels-photo-5951549.jpeg',
        ],
    ];

    $roles = [
        [
            'slug'   => 'backend-engineer',
            'title'  => 'Kỹ sư backend cao cấp',
            'dept'   => 'Kỹ thuật',
            'loc'    => 'Hà Nội',
            'meta'   => 'Kỹ thuật · Hà Nội · Toàn thời gian',
            'desc'   => 'Laravel và MySQL. Mở rộng nền tảng đang vận hành hơn 500 hồ sơ luật sư.',
            'salary' => '50-80M',
        ],
        [
            'slug'   => 'product-designer',
            'title'  => 'Nhà thiết kế sản phẩm',
            'dept'   => 'Sản phẩm',
            'loc'    => 'Hà Nội',
            'meta'   => 'Sản phẩm · Hà Nội · Toàn thời gian',
            'desc'   => 'Dẫn dắt hành trình của khách hàng từ tìm kiếm đến tư vấn.',
            'salary' => '40-65M',
        ],
        [
            'slug'   => 'lawyer-verification',
            'title'  => 'Chuyên gia xác minh luật sư',
            'dept'   => 'Hoạt động',
            'loc'    => 'Hà Nội',
            'meta'   => 'Hoạt động · Hà Nội · Toàn thời gian',
            'desc'   => 'Thẩm định mọi luật sư trước khi đưa hồ sơ lên nền tảng. Ưu tiên ứng viên có nền tảng pháp lý.',
            'salary' => '25-40M',
        ],
        [
            'slug'   => 'customer-ops-lead',
            'title'  => 'Trưởng nhóm vận hành khách hàng',
            'dept'   => 'Hoạt động',
            'loc'    => 'Hà Nội / TP.HCM',
            'meta'   => 'Hoạt động · Hà Nội hoặc TP.HCM · Toàn thời gian',
            'desc'   => 'Người tiếp nhận đầu tiên cho khách hàng. Xây dựng quy trình hỗ trợ có khả năng mở rộng.',
            'salary' => '30-45M',
        ],
        [
            'slug'   => 'marketing-director',
            'title'  => 'Giám đốc tiếp thị',
            'dept'   => 'Tiếp thị',
            'loc'    => 'Hà Nội',
            'meta'   => 'Tiếp thị · Hà Nội · Toàn thời gian',
            'desc'   => 'Thương hiệu, nội dung và tăng trưởng trên toàn Việt Nam.',
            'salary' => '35-55M',
        ],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Ứng tuyển',           'desc' => 'Không cần thư xin việc.'],
        ['n' => '02', 'title' => 'Hai vòng phỏng vấn',  'desc' => 'Quản lý tuyển dụng, sau đó là đội ngũ.'],
        ['n' => '03', 'title' => 'Quyết định',          'desc' => 'Trong vòng mười ngày.'],
    ];

    $perks = [
        [
            'icon'  => 'heart',
            'title' => 'Bảo hiểm sức khỏe cao cấp',
            'desc'  => 'Khám bệnh, nha khoa, thị lực. Chúng tôi chi trả 100% bảo hiểm sức khỏe và bổ sung gói cho người thân.',
        ],
        [
            'icon'  => 'wallet',
            'title' => 'Lương cạnh tranh và cổ phần',
            'desc'  => 'Mức lương theo top thị trường, kèm cổ phần ESOP. Mỗi người ở LegalEase đều là đồng sở hữu.',
        ],
        [
            'icon'  => 'monitor',
            'title' => 'Thiết bị làm việc đầy đủ',
            'desc'  => 'MacBook đời mới và bất cứ thiết bị nào bạn cần. Văn phòng có bàn làm việc đứng và màn hình ngoài.',
        ],
        [
            'icon'  => 'coffee',
            'title' => 'Bữa trưa và đồ uống',
            'desc'  => 'Bữa trưa hằng ngày tại văn phòng, cà phê và đồ ăn vặt không giới hạn để bạn luôn đủ năng lượng.',
        ],
        [
            'icon'  => 'sun',
            'title' => 'Nghỉ phép linh hoạt',
            'desc'  => '20 ngày phép có lương mỗi năm, cộng các ngày lễ Tết. Nghỉ khi bạn cần để giữ sức bền lâu dài.',
        ],
        [
            'icon'  => 'sparkles',
            'title' => 'Hỗ trợ sức khỏe tinh thần',
            'desc'  => 'Gói trị liệu tâm lý được hỗ trợ và một ngày nghỉ sức khỏe tinh thần mỗi quý.',
        ],
    ];
@endphp

@section('content')
    <x-hero-bar
        photo="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80"
        eyebrow="Chúng tôi đang tuyển dụng">
        Xây dựng cách người Việt tiếp cận pháp luật.

        <x-slot:subtitle>
            Một đội ngũ nhỏ ở Hà Nội, đang thay đổi cách hàng triệu người Việt gặp luật sư.
        </x-slot:subtitle>
    </x-hero-bar>

    {{-- What it's like --}}
    <section class="container-page pt-24 md:pt-32">
        <p class="text-eyebrow">Làm việc tại LegalEase</p>
        <h2 class="text-section-h2 mt-5">Thông tin bạn cần biết.</h2>
        <p class="text-body-prose mt-6 max-w-[56ch] text-text/70">
            Đội ngũ nhỏ, nhịp làm việc nhanh, mỗi vai trò đều có ảnh hưởng thấy được lên sản phẩm và lên người dùng thật.
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

    {{-- Perks / benefits --}}
    <section class="container-page pt-24">
        <p class="text-eyebrow">Phúc lợi</p>
        <h2 class="text-section-h2 mt-5">Chúng tôi lo phần còn lại.</h2>
        <p class="text-body-prose mt-6 max-w-[56ch] text-text/70">
            Mọi quyền lợi đều được lo sẵn, để bạn tập trung vào công việc của mình.
        </p>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($perks as $perk)
                <div class="rounded-2xl bg-text/5 p-8">
                    <x-icon :name="$perk['icon']" :size="28" class="text-accent" />
                    <h3 class="text-card-h3 mt-12">{{ $perk['title'] }}</h3>
                    <p class="text-body-dense mt-3 text-text/70">{{ $perk['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Open positions --}}
    <section x-data="careersFilter({{ json_encode($roles) }})" class="container-page pt-24">
        <div class="flex flex-col items-start gap-6 md:flex-row md:items-end md:justify-between">
            <h2 class="text-section-h2">Vị trí tuyển dụng</h2>

            <div class="flex flex-wrap gap-3">
                {{-- Department pill --}}
                <div class="relative" @click.outside="openMenu = null">
                    <button type="button"
                            @click.stop="openMenu = openMenu === 'dept' ? null : 'dept'"
                            :class="dept === 'all' ? 'border-text/20' : 'border-accent'"
                            class="inline-flex items-center gap-2 rounded-full border bg-bg px-5 py-2.5 text-caption font-medium text-text transition-colors hover:border-accent">
                        <span x-text="dept === 'all' ? 'Phòng ban' : dept"></span>
                        <svg class="h-3.5 w-3.5 transition-transform"
                             :class="openMenu === 'dept' ? 'rotate-180' : ''"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div x-show="openMenu === 'dept'" x-cloak
                         x-transition.opacity.duration.150ms
                         class="absolute left-0 top-full z-20 mt-2 min-w-[220px] rounded-2xl border border-text/15 bg-bg py-2">
                        <template x-for="opt in departments" :key="opt">
                            <button type="button"
                                    @click.stop="dept = opt; openMenu = null"
                                    class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-accent/5"
                                    x-text="opt === 'all' ? 'Tất cả' : opt"></button>
                        </template>
                    </div>
                </div>

                {{-- Location pill --}}
                <div class="relative" @click.outside="openMenu = null">
                    <button type="button"
                            @click.stop="openMenu = openMenu === 'loc' ? null : 'loc'"
                            :class="loc === 'all' ? 'border-text/20' : 'border-accent'"
                            class="inline-flex items-center gap-2 rounded-full border bg-bg px-5 py-2.5 text-caption font-medium text-text transition-colors hover:border-accent">
                        <span x-text="loc === 'all' ? 'Địa điểm' : loc"></span>
                        <svg class="h-3.5 w-3.5 transition-transform"
                             :class="openMenu === 'loc' ? 'rotate-180' : ''"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div x-show="openMenu === 'loc'" x-cloak
                         x-transition.opacity.duration.150ms
                         class="absolute left-0 top-full z-20 mt-2 min-w-[220px] rounded-2xl border border-text/15 bg-bg py-2">
                        <template x-for="opt in locations" :key="opt">
                            <button type="button"
                                    @click.stop="loc = opt; openMenu = null"
                                    class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-accent/5"
                                    x-text="opt === 'all' ? 'Tất cả' : opt"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 border-b border-text/15">
            <template x-for="role in filtered" :key="role.slug">
                <a href="{{ route('careers') }}"
                   class="group relative grid grid-cols-1 items-center gap-4 border-t border-text/15 py-7 transition-[padding] duration-200 hover:pl-4 md:grid-cols-[1fr_auto_auto] md:gap-10">
                    <span aria-hidden="true"
                          class="absolute left-0 top-1/2 hidden h-3/5 w-0.5 origin-center -translate-y-1/2 scale-y-0 bg-accent transition-transform duration-200 group-hover:scale-y-100 md:block"></span>

                    <div>
                        <h3 class="text-card-h3 transition-colors group-hover:text-accent" x-text="role.title"></h3>
                        <p class="text-caption mt-2 text-text/60" x-text="role.meta"></p>
                        <p class="text-body mt-3 max-w-[560px]" x-text="role.desc"></p>
                    </div>

                    <div class="md:text-right">
                        <p class="text-chapter-h2" x-text="role.salary"></p>
                        <p class="text-eyebrow mt-1 text-text/60">VND / tháng</p>
                    </div>

                    <span aria-hidden="true"
                          class="hidden h-11 w-11 flex-none items-center justify-center rounded-full border border-text/25 text-text transition-colors group-hover:border-accent group-hover:bg-accent group-hover:text-bg md:inline-flex">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="6" y1="18" x2="18" y2="6"/>
                            <polyline points="9 6 18 6 18 15"/>
                        </svg>
                    </span>
                </a>
            </template>

            <p x-show="filtered.length === 0" x-cloak
               class="text-body-prose py-12 text-center italic text-text/60">
                Không tìm thấy vị trí phù hợp với bộ lọc hiện tại.
            </p>
        </div>

        <script>
            function careersFilter(roles) {
                return {
                    roles,
                    dept: 'all',
                    loc: 'all',
                    openMenu: null,
                    departments: ['all', ...new Set(roles.map(r => r.dept))],
                    locations: ['all', ...new Set(roles.map(r => r.loc))],
                    get filtered() {
                        return this.roles.filter(r =>
                            (this.dept === 'all' || r.dept === this.dept) &&
                            (this.loc === 'all' || r.loc === this.loc)
                        );
                    },
                };
            }
        </script>
    </section>

    {{-- How we hire --}}
    <section class="container-page pt-24">
        <h2 class="text-section-h2">Chúng tôi tuyển dụng như thế nào?</h2>

        <div class="relative mt-12 grid divide-y divide-text/15 md:grid-cols-3 md:gap-12 md:divide-y-0">
            {{-- Ground line --}}
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 hidden h-px bg-text/15 md:block md:top-20 lg:top-24"></div>

            @foreach ($hiring as $step)
                <div class="py-10 first:pt-0 last:pb-0 md:py-0">
                    <p class="display-stat-feature text-accent">{{ $step['n'] }}</p>
                    <h3 class="text-card-h3 mt-8">{{ $step['title'] }}</h3>
                    <p class="text-body mt-4 max-w-sm">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <x-closing-cta
        heading="Không thấy vị trí phù hợp?"
        subtitle="Chúng tôi luôn sẵn sàng trò chuyện với người tài. Gửi cho chúng tôi một dòng giới thiệu."
        button="Liên hệ →"
        :href="route('contact')" />
@endsection

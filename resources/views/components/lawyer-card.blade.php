@props(['lawyer'])

<a href="/lawyers/{{ $lawyer['slug'] }}"
   {{ $attributes->class('group flex flex-col overflow-hidden rounded-2xl border border-text/10 bg-surface p-6 transition-all duration-200 hover:-translate-y-0.5 hover:border-accent') }}>
    <div class="overflow-hidden rounded-xl">
        <img src="{{ $lawyer['portrait_url'] }}"
             alt="{{ $lawyer['name'] }}"
             loading="lazy"
             class="aspect-square w-full object-cover object-top grayscale">
    </div>

    @php
        $displayName = match ($lawyer['slug'] ?? '') {
            'nguyen-minh-anh' => 'Nguyễn Minh Anh',
            'tran-van-hung' => 'Trần Văn Hùng',
            'le-thi-huong' => 'Lê Thị Hương',
            'pham-quoc-bao' => 'Phạm Quốc Bảo',
            'hoang-thu-trang' => 'Hoàng Thu Trang',
            'vu-duc-minh' => 'Vũ Đức Minh',
            'dang-thi-mai' => 'Đặng Thị Mai',
            'bui-thanh-tung' => 'Bùi Thanh Tùng',
            'ngo-hai-yen' => 'Ngô Hải Yến',
            default => $lawyer['name'],
        };

        $displaySpecialty = match ($lawyer['slug'] ?? '') {
            'nguyen-minh-anh', 'dang-thi-mai' => 'Luật Hôn nhân & Gia đình',
            'tran-van-hung', 'bui-thanh-tung' => 'Luật Doanh nghiệp',
            'le-thi-huong', 'ngo-hai-yen' => 'Bất động sản',
            'pham-quoc-bao' => 'Bào chữa hình sự',
            'hoang-thu-trang' => 'Luật Lao động',
            'vu-duc-minh' => 'Tố tụng dân sự',
            default => $lawyer['primary_specialty'],
        };

        $shortProvince = match ($lawyer['slug'] ?? '') {
            'nguyen-minh-anh', 'pham-quoc-bao', 'vu-duc-minh', 'dang-thi-mai', 'bui-thanh-tung' => 'Hà Nội',
            'tran-van-hung', 'hoang-thu-trang', 'ngo-hai-yen' => 'TP.HCM',
            'le-thi-huong' => 'Đà Nẵng',
            default => match ($lawyer['address']['province'] ?? null) {
            'Ho Chi Minh City' => 'TP.HCM',
            'Hanoi' => 'Hà Nội',
                default => $lawyer['address']['province'] ?? null,
            },
        };
    @endphp

    <div class="mt-5 flex items-center gap-2">
        <h3 class="font-display text-2xl font-medium tracking-tight text-text">
            {{ $displayName }}
        </h3>
        @if (($lawyer['verification_status'] ?? null) === 'VERIFIED')
            <span title="Verified" class="inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-gold/15 text-gold">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
        @endif
    </div>

    <div class="mt-3 flex items-center justify-between gap-3">
        <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[12px] font-medium text-muted">
            {{ $displaySpecialty }}
        </span>
        @if ($shortProvince)
            <span class="inline-flex items-center gap-1 text-[13px] text-muted">
                <x-icon name="map-pin" :size="14" />
                {{ $shortProvince }}
            </span>
        @endif
    </div>

    <p class="mt-3 text-[14px] text-muted">
        {{ $lawyer['years_of_experience'] }} năm kinh nghiệm · {{ number_format($lawyer['price_per_hour']) }} VND/giờ
    </p>

    <div class="mt-3">
        <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" />
    </div>

    <div class="mt-5">
        <x-button variant="secondary" class="w-full group-hover:border-accent group-hover:text-accent">
            Xem hồ sơ
        </x-button>
    </div>
</a>


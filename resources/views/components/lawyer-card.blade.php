@props(['lawyer'])

<a href="/lawyers/{{ $lawyer['slug'] }}"
   {{ $attributes->class('group flex flex-col overflow-hidden rounded-2xl border border-text/20 bg-bg p-6 transition-all duration-200 hover:-translate-y-0.5 hover:border-accent') }}>
    <div class="overflow-hidden rounded-xl">
        <x-responsive-img :src="$lawyer['portrait_url']"
                          :alt="$lawyer['name']"
                          sizes="(min-width: 1280px) 360px, (min-width: 768px) 45vw, calc(100vw - 96px)"
                          :widths="[400, 600, 800]"
                          class="aspect-square w-full object-cover object-top" />
    </div>

    <div class="mt-5 flex items-start gap-2">
        <h3 class="min-w-0 font-display text-2xl font-medium leading-snug tracking-tight text-text">
            {{ $lawyer['name'] }}
        </h3>
        @if (($lawyer['verification_status'] ?? null) === 'VERIFIED')
            <span title="Đã xác minh" class="mt-1 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-accent/10">
                <svg class="h-4 w-4 text-accent" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                </svg>
            </span>
        @endif
    </div>

    <div class="meta-row mt-3">
        <span class="tag-pill">
            {{ $lawyer['primary_specialty'] }}
        </span>
        @if (!empty($lawyer['address']['province']))
            <span class="inline-flex items-center gap-1 text-[14px]">
                <x-icon name="map-pin" :size="14" />
                {{ $lawyer['address']['province'] }}
            </span>
        @endif
    </div>

    <p class="mt-3 text-[14px]">
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


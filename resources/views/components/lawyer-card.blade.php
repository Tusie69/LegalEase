@props(['lawyer'])

<a href="/lawyers/{{ $lawyer['slug'] }}"
   {{ $attributes->class('group relative block aspect-[3/4] overflow-hidden rounded-2xl bg-accent text-bg isolate') }}>
    {{-- Photo --}}
    <x-responsive-img :src="$lawyer['portrait_url']"
                      :alt="$lawyer['name']"
                      sizes="(min-width: 1280px) 360px, (min-width: 768px) 45vw, calc(100vw - 96px)"
                      :widths="[400, 600, 800]"
                      class="absolute inset-0 z-0 h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.04]" />

    {{-- Bottom scrim: flat navy band so name + meta stay readable on any portrait --}}
    <span aria-hidden="true"
          class="pointer-events-none absolute inset-x-0 bottom-0 z-[1] h-[44%] bg-accent opacity-55"></span>

    {{-- Top-left: specialty pill (mirrors the rating badge in the opposite corner) --}}
    <span class="text-form-hint absolute left-4 top-4 z-[2] inline-flex items-center gap-1.5 rounded-full border border-bg/20 bg-accent px-3 py-1 font-semibold text-bg">
        {{ $lawyer['primary_specialty'] }}
    </span>

    {{-- Top-right: rating badge --}}
    <span class="text-form-hint absolute right-4 top-4 z-[2] inline-flex items-center gap-1 rounded-full border border-bg/20 bg-accent px-2.5 py-1 font-semibold text-bg">
        <svg class="h-3 w-3 fill-gold-bright text-gold-bright" viewBox="0 0 24 24">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
        </svg>
        {{ $lawyer['rating'] }}
    </span>

    {{-- Rest state: name + meta (fades out on hover) --}}
    <div class="absolute inset-x-0 bottom-0 z-[2] p-5 transition-opacity duration-200 group-hover:opacity-0">
        <h3 class="font-display text-2xl font-medium leading-tight tracking-tight text-bg">
            {{ $lawyer['name'] }}
        </h3>
        <p class="text-form-hint mt-1 text-bg/85">
            @if (!empty($lawyer['address']['province']))
                {{ $lawyer['address']['province'] }} ·
            @endif
            {{ $lawyer['years_of_experience'] }} năm kinh nghiệm
        </p>
    </div>

    {{-- Hover state: action bar slides up --}}
    <div class="absolute inset-x-4 bottom-4 z-[3] flex translate-y-full items-center justify-between gap-3 rounded-xl border border-bg/20 bg-accent px-4 py-3 opacity-0 transition-all duration-300 ease-out group-hover:translate-y-0 group-hover:opacity-100">
        <div class="min-w-0 flex-1">
            <p class="text-card-h5 truncate text-bg">{{ $lawyer['name'] }}</p>
            <p class="text-form-hint text-bg/70">{{ number_format($lawyer['price_per_hour']) }} VND / giờ</p>
        </div>
        <span class="text-form-hint inline-flex flex-shrink-0 items-center gap-1.5 rounded-full bg-bg px-3 py-2 font-semibold text-accent">
            Xem hồ sơ
            <span aria-hidden="true">→</span>
        </span>
    </div>
</a>

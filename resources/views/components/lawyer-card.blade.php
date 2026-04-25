@props(['lawyer'])

<a href="/lawyers/{{ $lawyer['slug'] }}"
   class="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-surface p-6 transition-all duration-200 hover:-translate-y-0.5 hover:border-accent">
    <div class="overflow-hidden rounded-xl">
        <img src="{{ $lawyer['portrait_url'] }}"
             alt="{{ $lawyer['name'] }}"
             loading="lazy"
             class="aspect-[4/5] w-full object-cover grayscale">
    </div>

    <h3 class="mt-5 font-display text-2xl font-medium tracking-tight text-text">
        {{ $lawyer['name'] }}
    </h3>

    <div class="mt-3 flex flex-wrap gap-2">
        <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[12px] font-medium text-muted">
            {{ $lawyer['primary_specialty'] }}
        </span>
    </div>

    <p class="mt-3 text-[14px] text-muted">
        {{ $lawyer['years_of_experience'] }} years experience · {{ number_format($lawyer['price_per_hour']) }} VND/hr
    </p>

    <div class="mt-3">
        <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" />
    </div>

    <div class="mt-5">
        <x-button variant="secondary" class="w-full group-hover:border-accent group-hover:text-accent">
            View profile
        </x-button>
    </div>
</a>

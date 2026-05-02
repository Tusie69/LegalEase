<article class="flex h-full flex-col rounded-2xl border border-text/10 bg-surface p-8 md:p-10">
    <div class="flex items-start justify-between gap-4">
        <x-icon :name="$area['icon']" :size="44" class="mt-1 text-text" />
        <span class="font-display text-[24px] font-medium text-muted/70">
            {{ str_pad($number, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <h2 class="mt-6 min-h-[64px] max-w-[95%] font-display text-[24px] font-medium leading-tight tracking-[-0.01em] md:text-[26px]">
        {{ $area['name'] }}
    </h2>

    <p class="mt-3 text-[15px] text-muted">
        {{ $area['description'] }}
    </p>

    @if (!empty($area['scenarios']))
        <p class="mt-8 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
            Bạn có thể cần mục này nếu
        </p>
        <ul class="mt-4 space-y-3 text-[15px] leading-relaxed text-secondary">
            @foreach ($area['scenarios'] as $scenario)
                <li class="flex gap-3">
                    <span class="mt-[10px] block h-px w-3 flex-none bg-text/30"></span>
                    <span>{{ $scenario }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-auto pt-8">
        <a href="/lawyers"
           class="inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
            Xem luật sư phù hợp
            <span aria-hidden="true">→</span>
        </a>
    </div>
</article>

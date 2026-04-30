<article class="flex flex-col rounded-2xl border border-text/10 bg-surface p-8 md:p-10">
    <div class="flex items-center justify-between">
        <x-icon :name="$area['icon']" :size="56" class="text-text" />
        <span class="font-display text-[28px] font-medium text-muted">
            {{ str_pad($number, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <h2 class="mt-8 font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[28px]">
        {{ $area['name'] }}
    </h2>

    <p class="mt-3 text-[15px] text-muted">
        {{ $area['description'] }}
    </p>

    @if (!empty($area['scenarios']))
        <p class="mt-8 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
            You might come here if
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
            Browse {{ $area['name'] }} lawyers
            <span aria-hidden="true">→</span>
        </a>
    </div>
</article>

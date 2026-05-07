<article class="card-base-lg flex h-full flex-col md:p-10">
    <div class="flex items-center justify-between gap-4">
        <x-icon :name="$area['icon']" :size="44" class="text-text" />
        <span class="text-card-h3 text-text/70">
            {{ str_pad($number, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <h3 class="text-card-h3 mt-6 max-w-[95%]">
        {{ $area['name'] }}
    </h3>

    <p class="text-body mt-5">
        {{ $area['description'] }}
    </p>

    @if (!empty($area['scenarios']))
        <p class="text-eyebrow mt-8">
            Bạn có thể cần mục này nếu
        </p>
        <ul class="text-body mt-4 space-y-3">
            @foreach ($area['scenarios'] as $scenario)
                <li class="flex gap-3">
                    <span class="mt-3 block h-px w-3 flex-none bg-text/30"></span>
                    <span>{{ $scenario }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-auto pt-8">
        <a href="/lawyers"
           class="text-link-action inline-flex items-center gap-2 text-text transition-colors hover:text-text/70">
            Xem luật sư phù hợp
            <span aria-hidden="true">→</span>
        </a>
    </div>
</article>

<article class="flex h-full flex-col overflow-hidden rounded-2xl bg-accent">
    <x-responsive-img :src="$area['image_url']"
                      alt=""
                      sizes="(min-width: 1024px) 33vw, (min-width: 768px) 50vw, 100vw"
                      :widths="[400, 600, 900, 1200]"
                      class="aspect-[16/9] w-full object-cover [-webkit-mask-image:linear-gradient(to_bottom,black_65%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_65%,transparent_100%)]" />

    <div class="flex flex-1 flex-col px-8 pt-8 pb-10 md:px-10 md:pt-10 md:pb-12">
        <h3 class="text-card-h3 max-w-[95%] text-bg">
            {{ $area['name'] }}
        </h3>

        <p class="text-body mt-5 text-bg/80">
            {{ $area['description'] }}
        </p>

        @if (!empty($area['scenarios']))
            <hr class="mt-8 border-t border-gold" />
            <p class="text-eyebrow-hero mt-8 text-gold">
                Bạn có thể cần mục này nếu
            </p>
            <ul class="text-body mt-4 space-y-4 text-bg">
                @foreach ($area['scenarios'] as $scenario)
                    <li class="flex gap-4">
                        <x-icon :name="$scenario['icon']" :size="24" class="mt-1 flex-none text-gold" />
                        <span>{{ $scenario['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-auto pt-8">
            <x-button variant="gold" href="/lawyers" class="w-full">
                Xem luật sư phù hợp →
            </x-button>
        </div>
    </div>
</article>

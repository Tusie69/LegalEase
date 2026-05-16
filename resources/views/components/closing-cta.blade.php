@props([
    'heading',
    'subtitle' => null,
    'button' => null,
    'href' => null,
])

@php
    $featuredLawyers = collect(\App\Data\Lawyers::all())
        ->filter(fn ($l) => !empty($l['portrait_url']))
        ->take(5)
        ->values();
@endphp

<section class="mt-24 bg-accent text-bg md:mt-32">
    <div class="container-page py-16 md:py-20">
        <div class="grid gap-12 lg:grid-cols-[5fr_7fr] lg:items-center lg:gap-16">
            {{-- Left: heading + subtitle + CTA --}}
            <div class="flex flex-col">
                <h2 class="text-cta-h2">{{ $heading }}</h2>
                @if ($subtitle)
                    <p class="text-body-prose mt-6 max-w-[460px] text-bg/80">{{ $subtitle }}</p>
                @endif
                @if ($button && $href)
                    <div class="mt-8">
                        <x-button variant="gold" :href="$href">{{ $button }}</x-button>
                    </div>
                @endif
            </div>

            {{-- Right: spliced portrait grid (five lawyer portraits butted edge-to-edge; desktop only, mobile is text-only for clarity) --}}
            <div class="hidden md:grid grid-cols-5 overflow-hidden rounded-2xl">
                @foreach ($featuredLawyers as $lawyer)
                    <div class="aspect-[2/5] overflow-hidden">
                        {{-- Tall aspect-[2/5] frame means height is 2.5x width. Landscape source photos get cropped heavily, so widths bumped to give the browser enough source pixels to scale down cleanly. --}}
                        <x-responsive-img :src="$lawyer['portrait_url']"
                                          :alt="$lawyer['name']"
                                          sizes="(min-width: 1024px) 240px, 30vw"
                                          :widths="[400, 800, 1200]"
                                          class="h-full w-full object-cover object-top" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

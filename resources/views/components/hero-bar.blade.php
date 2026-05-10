@props([
    'photo' => '',
    'eyebrow' => null,
])

@php
    $hasPhoto = !empty($photo);
@endphp

<section @class([
    'relative flex flex-col overflow-hidden bg-accent',
    '-mt-18 min-h-screen' => $hasPhoto,
    'min-h-[50vh] md:min-h-[60vh]' => !$hasPhoto,
])>
    @if ($hasPhoto)
        <div class="relative flex-1 overflow-hidden min-h-[65vh] md:h-[55vh] md:min-h-0 md:flex-none">
            <x-responsive-img :src="$photo"
                              alt=""
                              loading="eager"
                              sizes="100vw"
                              :widths="[600, 900, 1200, 1600]"
                              class="absolute inset-0 h-full w-full object-cover [-webkit-mask-image:linear-gradient(to_bottom,black_70%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_70%,transparent_100%)]" />
        </div>
    @endif

    <div @class([
        'relative w-full',
        'md:flex md:items-center md:min-h-[45vh]' => $hasPhoto,
        'flex flex-1 items-center' => !$hasPhoto,
    ])>
        <div class="container-page w-full text-center py-14 md:py-0">
            @if (!empty($eyebrow))
                <p class="text-eyebrow-hero text-gold">{{ $eyebrow }}</p>
            @endif
            <h1 @class([
                'text-bar-h1 mx-auto max-w-[920px] text-bg',
                'mt-5' => !empty($eyebrow),
            ])>
                {{ $slot }}
            </h1>
            @isset($subtitle)
                <p class="text-body-prose mx-auto mt-5 max-w-[560px] text-bg/80">
                    {{ $subtitle }}
                </p>
            @endisset
            @isset($actions)
                <div class="mt-8 flex justify-center">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </div>
</section>

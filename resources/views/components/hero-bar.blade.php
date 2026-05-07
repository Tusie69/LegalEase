@props([
    'photo' => '',
    'eyebrow' => null,
])

<section class="relative -mt-18 flex min-h-screen flex-col overflow-hidden">
    <div class="relative flex-1 overflow-hidden min-h-[65vh] md:h-[55vh] md:min-h-0 md:flex-none">
        <img src="{{ $photo }}" alt="" class="absolute inset-0 h-full w-full object-cover">
    </div>

    <div class="bg-accent md:flex md:min-h-[45vh] md:items-center">
        <div class="container-page py-14 text-center md:py-0">
            @if (!empty($eyebrow))
                <p class="text-eyebrow text-bg/65">{{ $eyebrow }}</p>
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

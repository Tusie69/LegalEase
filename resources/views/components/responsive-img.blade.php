@props([
    'src',
    'alt' => '',
    'sizes' => '100vw',
    'widths' => [400, 800, 1200, 1600],
    'loading' => 'lazy',
])

@php
    $base = strtok($src, '?');
    $cdn = null;
    if (str_contains($src, 'images.unsplash.com')) {
        $cdn = 'unsplash';
    } elseif (str_contains($src, 'images.pexels.com')) {
        $cdn = 'pexels';
    }

    $srcset = null;
    $defaultSrc = $src;

    if ($cdn === 'unsplash') {
        // Note: we deliberately don't use auto=format. Imgix's AVIF output
        // is much smaller per-byte than JPEG but software-decoded on Chrome
        // desktop, which causes a noticeable lag on pages with many images
        // (e.g. lawyer cards). JPEG decodes hardware-accelerated → instant.
        $params = 'fit=crop&q=80';
        $srcset = collect($widths)
            ->map(fn ($w) => "{$base}?{$params}&w={$w} {$w}w")
            ->implode(', ');
        $defaultSrc = "{$base}?{$params}&w=" . max($widths);
    } elseif ($cdn === 'pexels') {
        $params = 'auto=compress&cs=tinysrgb';
        $srcset = collect($widths)
            ->map(fn ($w) => "{$base}?{$params}&w={$w} {$w}w")
            ->implode(', ');
        $defaultSrc = "{$base}?{$params}&w=" . max($widths);
    }
@endphp

@if ($srcset)
    <img src="{{ $defaultSrc }}"
         srcset="{{ $srcset }}"
         sizes="{{ $sizes }}"
         alt="{{ $alt }}"
         loading="{{ $loading }}"
         {{ $attributes }}>
@else
    <img src="{{ $src }}"
         alt="{{ $alt }}"
         loading="{{ $loading }}"
         {{ $attributes }}>
@endif

@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center rounded-full px-6 py-3 text-[14px] font-medium transition-all duration-200';

    $styles = match ($variant) {
        'primary'   => 'bg-gold text-bg shadow-[0_0_0_0_rgba(212,162,76,0)] hover:shadow-[0_0_18px_1px_rgba(212,162,76,0.22)]',
        'secondary' => 'border border-muted text-text hover:border-accent hover:text-accent',
        'ghost'     => 'text-muted hover:text-accent hover:underline underline-offset-4',
        default     => '',
    };

    $classes = trim($base . ' ' . $styles);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif

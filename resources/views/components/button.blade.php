@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center rounded-full border px-6 py-3 text-caption font-semibold transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';

    $styles = match ($variant) {
        'primary' => 'border-accent bg-accent text-bg hover:text-gold focus-visible:ring-accent',
        'secondary' => 'border-text/20 bg-bg text-text hover:border-accent hover:text-accent focus-visible:ring-accent',
        'ghost' => 'border-transparent bg-transparent text-text hover:border-text/20 hover:bg-text/5 focus-visible:ring-accent',
        'gold' => 'border-gold bg-gold text-accent hover:bg-bg hover:border-bg focus-visible:ring-gold',
        'on-dark-ghost' => 'border-bg/40 bg-transparent text-bg hover:bg-bg hover:border-bg hover:text-accent focus-visible:ring-bg',
        default => 'border-text/20 bg-bg text-text',
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

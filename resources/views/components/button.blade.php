@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center rounded-full border px-6 py-3 text-[14px] font-semibold transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';

    $styles = match ($variant) {
        'primary' => 'border-[#0F2747] bg-[#0F2747] text-white shadow-sm hover:bg-[#12315a] hover:border-[#12315a] focus-visible:ring-[#0F2747]',
        'secondary' => 'border-text/20 bg-surface text-text hover:border-accent hover:text-accent focus-visible:ring-accent',
        'ghost' => 'border-transparent bg-transparent text-text hover:border-text/20 hover:bg-surface focus-visible:ring-accent',
        default => 'border-text/20 bg-surface text-text',
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

@props([
    'rating' => 0,
    'reviewCount' => null,
    'size' => 'md',
    'compact' => false,
])

@php
    $filled = (int) round($rating);
    $sizeClass = $size === 'sm' ? 'h-4 w-4' : 'h-5 w-5';
    $textClass = 'text-caption';
@endphp

@if ($compact)
    <div {{ $attributes->class('inline-flex items-center gap-1.5') }}>
        <svg class="{{ $sizeClass }} text-gold-bright" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
        </svg>
        <span class="{{ $textClass }} font-medium text-text">{{ number_format($rating, 1) }}</span>
        @if ($reviewCount !== null)
            <span class="{{ $textClass }} text-text/60">({{ number_format($reviewCount) }} đánh giá)</span>
        @endif
    </div>
@else
    <div {{ $attributes->class('inline-flex items-center gap-2') }}>
        <div class="inline-flex items-center gap-0.5">
            @for ($i = 1; $i <= 5; $i++)
                <svg class="{{ $sizeClass }} {{ $i <= $filled ? 'text-gold-bright' : 'text-text/20' }}"
                     viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
                </svg>
            @endfor
        </div>
        @if ($reviewCount !== null)
            <span class="{{ $textClass }}">({{ number_format($reviewCount) }} đánh giá)</span>
        @endif
    </div>
@endif


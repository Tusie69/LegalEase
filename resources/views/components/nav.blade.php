@php
    $links = [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Lawyers', 'url' => '/lawyers'],
        ['label' => 'Legal Services', 'url' => '#'],
        ['label' => 'Contact', 'url' => '/contact'],
    ];
@endphp

<nav class="fixed inset-x-0 top-0 z-50 h-[72px] border-b border-text/10 bg-bg/80 backdrop-blur-md">
    <div class="mx-auto flex h-full max-w-[1280px] items-center justify-between px-8">
        <a href="/" class="inline-flex items-center gap-2 font-display text-xl font-medium tracking-tight text-text">
            <img src="{{ asset('images/logo2.png') }}" alt="" class="h-8 w-8 object-contain brightness-0 invert">
            <span>LegalEase</span>
        </a>

        <div class="hidden items-center gap-8 md:flex">
            @foreach ($links as $link)
                @php $active = request()->path() === ltrim($link['url'], '/'); @endphp
                <a href="{{ $link['url'] }}"
                   class="text-[15px] font-medium text-muted transition-colors duration-250 hover:text-text
                          {{ $active ? 'text-text underline decoration-accent underline-offset-8' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <a href="{{ route('login') }}"
           class="inline-flex items-center rounded-full border border-muted px-6 py-3 text-[14px] font-medium text-text transition-colors duration-200 hover:border-accent hover:text-accent">
            Sign in
        </a>
    </div>
</nav>

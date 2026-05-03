@php
    $links = [
        ['label' => 'Trang chủ', 'url' => '/'],
        ['label' => 'Đặt Lịch', 'url' => '/lawyers'],
        ['label' => 'Dịch vụ pháp lý', 'url' => '/legal-services'],
        ['label' => 'Liên hệ', 'url' => '/contact'],
    ];
@endphp

<nav class="fixed inset-x-0 top-0 z-50 h-[72px] border-b border-text/10 bg-bg/80 backdrop-blur-md">
    <div class="mx-auto flex h-full max-w-[1280px] items-center justify-between px-8">
        <a href="/" class="inline-flex items-center gap-3 font-display text-xl font-medium tracking-tight text-text">
            <img src="{{ asset('images/logo2.png') }}" alt="LegalEase logo" class="h-10 w-10 shrink-0 object-contain">
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

        @auth
            @php $firstName = explode(' ', trim(auth()->user()->name))[0]; @endphp
            <div x-data="{ open: false }"
                 @click.window="if (!$el.contains($event.target)) open = false"
                 @keydown.escape.window="open = false"
                 class="relative">
                <button type="button" @click="open = !open"
                        class="inline-flex items-center gap-2 rounded-full border border-muted px-5 py-3 text-[14px] font-medium text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                    <span>{{ $firstName }}</span>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div x-show="open" x-transition x-cloak style="display:none;"
                     class="absolute right-0 mt-2 w-52 origin-top-right rounded-2xl border border-text/10 bg-surface py-2 shadow-lg">
                    <div class="px-4 py-2">
                        <p class="font-display text-[15px] font-medium text-text">{{ auth()->user()->name }}</p>
                        <p class="truncate text-[12px] text-muted">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="my-1 h-px bg-text/10"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                @click="open = false"
                                class="block w-full px-4 py-2 text-left text-[14px] text-text transition-colors hover:bg-text/5 hover:text-accent">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}"
               class="inline-flex items-center rounded-full bg-[#0F2747] px-6 py-3 text-[14px] font-semibold text-white shadow-sm transition-colors duration-200 hover:bg-[#12315a]">
                Đăng nhập
            </a>
        @endauth
    </div>
</nav>

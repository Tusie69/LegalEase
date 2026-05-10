@php
    $links = [
        ['label' => 'Trang chủ', 'url' => '/'],
        ['label' => 'Luật sư', 'url' => '/lawyers'],
        ['label' => 'Tin tức', 'url' => '/news'],
        ['label' => 'Dịch vụ pháp lý', 'url' => '/legal-services'],
        ['label' => 'Liên hệ', 'url' => '/contact'],
    ];
@endphp

<nav x-data="{ menuOpen: false }"
     @keydown.escape.window="menuOpen = false">
    <div class="fixed inset-x-0 top-0 z-50 h-18 border-b border-text/15 bg-bg">
        <div class="mx-auto flex h-full max-w-[1280px] items-center justify-between px-8">
            <a href="/" class="inline-flex items-center gap-3 font-display text-xl font-medium tracking-tight text-text">
                <img src="{{ asset('images/logo.svg') }}" alt="LegalEase logo" class="h-10 w-10 shrink-0 object-contain">
                <span>LegalEase</span>
            </a>

            <div class="hidden items-center gap-8 lg:ml-auto lg:mr-6 lg:flex">
                @foreach ($links as $link)
                    @php $active = request()->path() === ltrim($link['url'], '/'); @endphp
                    <a href="{{ $link['url'] }}"
                       class="group relative text-[16px] font-medium">
                        {{ $link['label'] }}
                        <span aria-hidden="true"
                              class="pointer-events-none absolute inset-x-0 -bottom-2 h-px origin-left bg-accent transition-transform duration-300 ease-out
                                     {{ $active ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                @endforeach
            </div>

            <div class="hidden items-center gap-3 lg:flex">
                @auth
                    @php $firstName = explode(' ', trim(auth()->user()->name))[0]; @endphp
                    <div x-data="{ dropdownOpen: false }"
                         @click.window="if (!$el.contains($event.target)) dropdownOpen = false"
                         class="relative">
                        <button type="button" @click="dropdownOpen = !dropdownOpen"
                                class="inline-flex items-center gap-2 rounded-full border border-text/30 px-5 py-3 text-[14px] font-medium text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            <span>{{ $firstName }}</span>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" x-transition x-cloak style="display:none;"
                             class="absolute right-0 mt-2 w-52 origin-top-right rounded-2xl border border-text/15 bg-bg py-2">
                            <div class="px-4 py-2">
                                <p class="font-display text-[16px] font-medium text-text">{{ auth()->user()->name }}</p>
                                <p class="truncate text-[12px]">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="my-1 h-px bg-text/10"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        @click="dropdownOpen = false"
                                        class="block w-full px-4 py-2 text-left text-[14px] text-text transition-colors hover:bg-text/5 hover:text-accent">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <x-button variant="primary" :href="route('login')">
                        Đăng nhập
                    </x-button>
                @endauth
            </div>

            <button type="button"
                    @click="menuOpen = true"
                    :aria-expanded="menuOpen"
                    aria-label="Mở điều hướng"
                    class="inline-flex h-10 w-10 items-center justify-center text-text transition-colors hover:text-accent lg:hidden">
                <x-icon name="menu" :size="24" />
            </button>
        </div>
    </div>

    <div x-show="menuOpen"
         x-cloak
         x-transition:enter="transition-opacity duration-200 ease-out"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-150 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] flex flex-col bg-bg lg:hidden">

        <div class="flex h-18 flex-none items-center justify-between border-b border-text/15 px-8">
            <a href="/" class="inline-flex items-center gap-3 font-display text-xl font-medium tracking-tight text-text" @click="menuOpen = false">
                <img src="{{ asset('images/logo.svg') }}" alt="LegalEase logo" class="h-10 w-10 shrink-0 object-contain">
                <span>LegalEase</span>
            </a>
            <button type="button"
                    @click="menuOpen = false"
                    aria-label="Đóng điều hướng"
                    class="inline-flex h-10 w-10 items-center justify-center text-text transition-colors hover:text-accent">
                <x-icon name="x" :size="24" />
            </button>
        </div>

        <div class="flex flex-1 flex-col items-center justify-center gap-10 px-8">
            @foreach ($links as $link)
                @php $active = request()->path() === ltrim($link['url'], '/'); @endphp
                <a href="{{ $link['url'] }}"
                   @click="menuOpen = false"
                   class="font-display text-[36px] font-medium leading-snug tracking-tight {{ $active ? 'text-accent' : 'text-text' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex-none border-t border-text/15 px-8 py-8">
            @auth
                <div class="space-y-4">
                    <div>
                        <p class="font-display text-[18px] font-medium text-text">{{ auth()->user()->name }}</p>
                        <p class="truncate text-[14px]">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                @click="menuOpen = false"
                                class="inline-flex w-full items-center justify-center rounded-full border border-text/30 px-6 py-3 text-[14px] font-medium text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            @else
                <x-button variant="primary" :href="route('login')" @click="menuOpen = false" class="w-full">
                    Đăng nhập
                </x-button>
            @endauth
        </div>
    </div>
</nav>

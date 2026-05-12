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
                       class="relative text-body font-medium text-text transition-colors hover:text-text/60">
                        {{ $link['label'] }}
                        @if ($active)
                            <span aria-hidden="true" class="pointer-events-none absolute inset-x-0 -bottom-2 h-px bg-accent"></span>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- Desktop auth area --}}
            <div class="hidden items-center gap-3 lg:flex">
                @auth
                    @php
                        $fullName = trim(auth()->user()->name);
                        $firstName = explode(' ', $fullName)[0];
                        $tokens = array_values(array_filter(preg_split('/\s+/', $fullName)));
                        $initials = mb_strtoupper(
                            mb_substr($tokens[0] ?? '?', 0, 1) . mb_substr($tokens[count($tokens) - 1] ?? '', 0, 1)
                        );
                        $isLawyer = (int) auth()->user()->role_id === 2;
                    @endphp
                    <div x-data="{ dropdownOpen: false }"
                         @click.window="if (!$el.contains($event.target)) dropdownOpen = false"
                         class="relative">
                        <button type="button" @click="dropdownOpen = !dropdownOpen"
                                class="inline-flex items-center gap-2 rounded-full border border-text/30 py-1.5 pl-1.5 pr-4 text-form-label text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            <span class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-accent/10 text-form-hint font-semibold text-accent">{{ $initials }}</span>
                            <span>{{ $firstName }}</span>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" x-transition x-cloak style="display:none;"
                             class="absolute right-0 mt-2 w-52 origin-top-right rounded-2xl border border-text/15 bg-bg py-2">
                            <div class="px-4 py-2">
                                <p class="font-display text-body font-medium text-text">{{ auth()->user()->name }}</p>
                                <p class="truncate text-form-hint">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="my-1 h-px bg-text/10"></div>
                            @if ($isLawyer)
                                <a href="{{ route('lawyer.dashboard') }}"
                                   @click="dropdownOpen = false"
                                   class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-text/5 hover:text-accent">
                                    Bảng điều khiển
                                </a>
                                <a href="{{ route('lawyer.profile') }}"
                                   @click="dropdownOpen = false"
                                   class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-text/5 hover:text-accent">
                                    Hồ sơ
                                </a>
                            @else
                                <a href="{{ route('consultations.index') }}"
                                   @click="dropdownOpen = false"
                                   class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-text/5 hover:text-accent">
                                    Tư vấn của tôi
                                </a>
                                <a href="{{ route('account') }}"
                                   @click="dropdownOpen = false"
                                   class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-text/5 hover:text-accent">
                                    Tài khoản
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        @click="dropdownOpen = false"
                                        class="block w-full px-4 py-2 text-left text-caption text-text transition-colors hover:bg-text/5 hover:text-accent">
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

            {{-- Mobile menu toggle --}}
            <button type="button"
                    @click="menuOpen = true"
                    :aria-expanded="menuOpen"
                    aria-label="Mở điều hướng"
                    class="inline-flex h-10 w-10 items-center justify-center text-text transition-colors hover:text-text/60 lg:hidden">
                <x-icon name="menu" :size="24" />
            </button>
        </div>
    </div>

    {{-- Mobile full-screen menu --}}
    <div x-show="menuOpen"
         x-cloak
         x-transition:enter="transition-opacity duration-200 ease-out"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-150 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] flex flex-col overflow-y-auto bg-bg lg:hidden">

        <div class="sticky top-0 z-10 flex h-18 flex-none items-center justify-between border-b border-text/15 bg-bg px-8">
            <a href="/" class="inline-flex items-center gap-3 font-display text-xl font-medium tracking-tight text-text" @click="menuOpen = false">
                <img src="{{ asset('images/logo.svg') }}" alt="LegalEase logo" class="h-10 w-10 shrink-0 object-contain">
                <span>LegalEase</span>
            </a>
            <button type="button"
                    @click="menuOpen = false"
                    aria-label="Đóng điều hướng"
                    class="inline-flex h-10 w-10 items-center justify-center text-text transition-colors hover:text-text/60">
                <x-icon name="x" :size="24" />
            </button>
        </div>

        <div class="flex flex-col items-center gap-8 px-8 py-12">
            @foreach ($links as $link)
                @php $active = request()->path() === ltrim($link['url'], '/'); @endphp
                <a href="{{ $link['url'] }}"
                   @click="menuOpen = false"
                   class="text-section-h2 {{ $active ? 'text-accent' : 'text-text' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Auth area --}}
        <div class="mt-auto border-t border-text/15 px-8 py-8">
            @auth
                @php
                    $mobileFullName = trim(auth()->user()->name);
                    $mobileTokens = array_values(array_filter(preg_split('/\s+/', $mobileFullName)));
                    $mobileInitials = mb_strtoupper(
                        mb_substr($mobileTokens[0] ?? '?', 0, 1) . mb_substr($mobileTokens[count($mobileTokens) - 1] ?? '', 0, 1)
                    );
                    $mobileIsLawyer = (int) auth()->user()->role_id === 2;
                @endphp
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <span class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-accent/10 text-card-h6 font-semibold text-accent">{{ $mobileInitials }}</span>
                        <div class="min-w-0">
                            <p class="text-card-h5 text-text">{{ auth()->user()->name }}</p>
                            <p class="truncate text-caption">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    @if ($mobileIsLawyer)
                        <a href="{{ route('lawyer.dashboard') }}"
                           @click="menuOpen = false"
                           class="inline-flex w-full items-center justify-center rounded-full border border-text/30 px-6 py-3 text-form-label text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            Bảng điều khiển
                        </a>
                        <a href="{{ route('lawyer.profile') }}"
                           @click="menuOpen = false"
                           class="inline-flex w-full items-center justify-center rounded-full border border-text/30 px-6 py-3 text-form-label text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            Hồ sơ
                        </a>
                    @else
                        <a href="{{ route('consultations.index') }}"
                           @click="menuOpen = false"
                           class="inline-flex w-full items-center justify-center rounded-full border border-text/30 px-6 py-3 text-form-label text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            Tư vấn của tôi
                        </a>
                        <a href="{{ route('account') }}"
                           @click="menuOpen = false"
                           class="inline-flex w-full items-center justify-center rounded-full border border-text/30 px-6 py-3 text-form-label text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                            Tài khoản
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                @click="menuOpen = false"
                                class="inline-flex w-full items-center justify-center rounded-full border border-text/30 px-6 py-3 text-form-label text-text transition-colors duration-200 hover:border-accent hover:text-accent">
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

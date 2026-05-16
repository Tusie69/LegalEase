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
                        $menuItems = $isLawyer
                            ? [
                                ['label' => 'Bảng điều khiển', 'route' => 'lawyer.dashboard', 'icon' => 'grid', 'active' => request()->routeIs('lawyer.dashboard')],
                                ['label' => 'Hồ sơ', 'route' => 'lawyer.profile', 'icon' => 'user', 'active' => request()->routeIs('lawyer.profile')],
                            ]
                            : [
                                ['label' => 'Tư vấn của tôi', 'route' => 'consultations.index', 'icon' => 'briefcase', 'active' => request()->routeIs('consultations.*')],
                                ['label' => 'Tài khoản', 'route' => 'account', 'icon' => 'settings', 'active' => request()->routeIs('account')],
                            ];
                    @endphp
                    <div x-data="{ dropdownOpen: false }"
                         @click.window="if (!$el.contains($event.target)) dropdownOpen = false"
                         class="relative">
                        <button type="button" @click="dropdownOpen = !dropdownOpen"
                                class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white py-1.5 pl-1.5 pr-4 text-form-label text-slate-700 transition-colors duration-200 hover:border-slate-400 hover:text-slate-900">
                            <span class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-sky-100 text-form-hint font-semibold text-sky-700">{{ $initials }}</span>
                            <span>{{ $firstName }}</span>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                             x-cloak style="display:none;"
                             class="absolute right-0 mt-3 w-80 origin-top-right rounded-3xl border border-slate-200 bg-white p-3 text-slate-700 shadow-[0_16px_48px_rgba(15,23,42,0.18)]">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="truncate text-base font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                                        <p class="truncate text-sm text-slate-500">{{ auth()->user()->email }}</p>
                                    </div>
                                    <span class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-gradient-to-br from-sky-400 via-cyan-400 to-blue-500 text-sm font-semibold text-white ring-2 ring-cyan-100">
                                        {{ $initials }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-2 space-y-1">
                                @foreach ($menuItems as $item)
                                    <a href="{{ route($item['route']) }}"
                                       @click="dropdownOpen = false"
                                       class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-[15px] transition {{ $item['active'] ? 'bg-slate-100 text-slate-900' : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}">
                                        <span class="flex items-center gap-3">
                                            <span class="inline-flex h-5 w-5 items-center justify-center text-slate-500">
                                                @if ($item['icon'] === 'grid')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-5 w-5">
                                                        <rect x="3" y="3" width="7" height="7" rx="1.6"></rect>
                                                        <rect x="14" y="3" width="7" height="7" rx="1.6"></rect>
                                                        <rect x="3" y="14" width="7" height="7" rx="1.6"></rect>
                                                        <rect x="14" y="14" width="7" height="7" rx="1.6"></rect>
                                                    </svg>
                                                @elseif ($item['icon'] === 'briefcase')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-5 w-5">
                                                        <path d="M9 7V6a3 3 0 0 1 3-3h0a3 3 0 0 1 3 3v1"></path>
                                                        <rect x="3" y="7" width="18" height="13" rx="2.5"></rect>
                                                        <path d="M3 12h18"></path>
                                                    </svg>
                                                @elseif ($item['icon'] === 'settings')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-5 w-5">
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                        <path d="M19.4 15a1.75 1.75 0 0 0 .35 1.93l.03.03a2 2 0 1 1-2.83 2.83l-.03-.03A1.75 1.75 0 0 0 15 19.4a1.75 1.75 0 0 0-1 .16 1.75 1.75 0 0 0-.9 1.55V21a2 2 0 1 1-4 0v-.05a1.75 1.75 0 0 0-.9-1.55 1.75 1.75 0 0 0-1-.16 1.75 1.75 0 0 0-1.93.35l-.03.03a2 2 0 1 1-2.83-2.83l.03-.03A1.75 1.75 0 0 0 4.6 15a1.75 1.75 0 0 0-.16-1 1.75 1.75 0 0 0-1.55-.9H2.84a2 2 0 1 1 0-4h.05a1.75 1.75 0 0 0 1.55-.9 1.75 1.75 0 0 0 .16-1 1.75 1.75 0 0 0-.35-1.93l-.03-.03A2 2 0 1 1 7.05 2.4l.03.03A1.75 1.75 0 0 0 9 4.6a1.75 1.75 0 0 0 1-.16 1.75 1.75 0 0 0 .9-1.55V2.84a2 2 0 1 1 4 0v.05a1.75 1.75 0 0 0 .9 1.55 1.75 1.75 0 0 0 1 .16 1.75 1.75 0 0 0 1.93-.35l.03-.03a2 2 0 1 1 2.83 2.83l-.03.03A1.75 1.75 0 0 0 19.4 9c.08.32.13.66.13 1s-.05.68-.13 1Z"></path>
                                                    </svg>
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-5 w-5">
                                                        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
                                                        <path d="M4 20a8 8 0 0 1 16 0"></path>
                                                    </svg>
                                                @endif
                                            </span>
                                            <span>{{ $item['label'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>

                            <div class="my-2 h-px bg-slate-200"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        @click="dropdownOpen = false"
                                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-[15px] text-slate-700 transition hover:bg-slate-100 hover:text-slate-900">
                                    <span class="inline-flex h-5 w-5 items-center justify-center text-slate-500">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-5 w-5">
                                            <path d="M9 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3"></path>
                                            <path d="M16 17l5-5-5-5"></path>
                                            <path d="M21 12H9"></path>
                                        </svg>
                                    </span>
                                    <span>Đăng xuất</span>
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

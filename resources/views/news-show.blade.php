@extends('layouts.app', ['title' => $article['title'] . ' · LegalEase'])

@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $author = \App\Data\Lawyers::findBySlug($article['author_slug']);
    $authorInitials = mb_strtoupper(mb_substr($article['author_name'], 0, 1));

    // External author (e.g. partner law firm) — has a custom avatar and external URL.
    $isExternalAuthor = !empty($article['author_avatar_url']);
    $authorLink = !empty($article['author_url'])
        ? $article['author_url']
        : route('lawyers.show', $article['author_slug']);

    $related = collect(\App\Data\News::all())
        ->reject(fn ($a) => $a['slug'] === $article['slug'])
        ->take(4)
        ->all();

    $shareUrl = url()->current();
    $shareTitle = rawurlencode($article['title']);
@endphp

@section('content')
<article class="mx-auto max-w-[1200px] px-6 pt-12 pb-24 lg:px-10">

    {{-- Breadcrumb --}}
    <nav class="text-caption">
        <a href="/" class="transition-colors hover:text-text/60">Trang chủ</a>
        <span class="px-1 text-text/40">/</span>
        <a href="{{ route('news') }}" class="transition-colors hover:text-text/60">Tin tức</a>
        <span class="px-1 text-text/40">/</span>
        <span class="text-text/60">{{ Str::limit($article['title'], 40) }}</span>
    </nav>

    <div class="mt-10 grid gap-12 lg:grid-cols-[minmax(0,1fr)_320px] lg:gap-20">

        {{-- LEFT: article column --}}
        <div class="min-w-0">

            {{-- Category eyebrow --}}
            <p class="text-eyebrow text-accent">{{ $article['category'] }}</p>

            {{-- Title --}}
            <h1 class="text-flow-h1 mt-4">
                {{ $article['title'] }}
            </h1>

            {{-- Subtitle --}}
            <p class="text-flow-intro mt-6 max-w-[680px] text-text/75">
                {{ $article['lead'] }}
            </p>

            {{-- Author + share row (desktop only; mobile shows the same info in the sidebar card below) --}}
            <div class="mt-10 hidden md:flex flex-wrap items-center justify-between gap-6 border-y border-text/15 py-5">
                <a href="{{ $authorLink }}"
                   @if ($isExternalAuthor) target="_blank" rel="noopener noreferrer" @endif
                   class="group flex items-center gap-3">
                    @if ($isExternalAuthor)
                        <img src="{{ asset($article['author_avatar_url']) }}"
                             alt="{{ $article['author_name'] }}"
                             class="h-12 w-12 flex-none rounded-full bg-bg object-contain p-1.5 ring-1 ring-text/15">
                    @elseif ($author && !empty($author['portrait_url']))
                        <x-responsive-img :src="$author['portrait_url']"
                                          :alt="$article['author_name']"
                                          sizes="48px"
                                          :widths="[100, 200]"
                                          class="h-12 w-12 flex-none rounded-full object-cover object-top" />
                    @else
                        <span class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-accent/10 text-form-label font-semibold text-accent">{{ $authorInitials }}</span>
                    @endif
                    <div class="min-w-0">
                        <p class="text-form-label text-text transition-colors group-hover:text-text/70">
                            {{ $article['author_name'] }}
                        </p>
                        <p class="text-caption">
                            {{ Carbon::parse($article['date'])->translatedFormat('d/m/Y') }}
                            <span class="mx-1 text-text/40">·</span>
                            {{ $article['read_time'] }}
                        </p>
                    </div>
                </a>

                {{-- Author social links (when external author has socials) — else share buttons --}}
                @if (!empty($article['author_socials']))
                    <div class="flex items-center gap-4">
                        @if (!empty($article['author_socials']['facebook']))
                            <a href="{{ $article['author_socials']['facebook'] }}"
                               target="_blank" rel="noopener noreferrer"
                               aria-label="Facebook của {{ $article['author_name'] }}"
                               class="text-accent transition-opacity hover:opacity-75">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.62.77-1.62 1.56V12h2.76l-.44 2.89h-2.32v6.99A10 10 0 0 0 22 12z"/></svg>
                            </a>
                        @endif
                        @if (!empty($article['author_socials']['linkedin']))
                            <a href="{{ $article['author_socials']['linkedin'] }}"
                               target="_blank" rel="noopener noreferrer"
                               aria-label="LinkedIn của {{ $article['author_name'] }}"
                               class="text-accent transition-opacity hover:opacity-75">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05a3.74 3.74 0 0 1 3.37-1.85c3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.44a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0z"/></svg>
                            </a>
                        @endif
                        @if (!empty($article['author_socials']['x']))
                            <a href="{{ $article['author_socials']['x'] }}"
                               target="_blank" rel="noopener noreferrer"
                               aria-label="X (Twitter) của {{ $article['author_name'] }}"
                               class="text-accent transition-opacity hover:opacity-75">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        @endif
                        @if (!empty($article['author_socials']['whatsapp']))
                            <a href="{{ $article['author_socials']['whatsapp'] }}"
                               target="_blank" rel="noopener noreferrer"
                               aria-label="WhatsApp của {{ $article['author_name'] }}"
                               class="text-accent transition-opacity hover:opacity-75">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413"/></svg>
                            </a>
                        @endif
                    </div>
                @else
                {{-- Share buttons (icons copied from <x-footer />) --}}
                <div class="flex items-center gap-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($shareUrl) }}"
                       target="_blank" rel="noopener noreferrer"
                       aria-label="Chia sẻ qua Facebook"
                       class="text-accent transition-opacity hover:opacity-75">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.62.77-1.62 1.56V12h2.76l-.44 2.89h-2.32v6.99A10 10 0 0 0 22 12z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ rawurlencode($shareUrl) }}"
                       target="_blank" rel="noopener noreferrer"
                       aria-label="Chia sẻ qua LinkedIn"
                       class="text-accent transition-opacity hover:opacity-75">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05a3.74 3.74 0 0 1 3.37-1.85c3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.44a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0z"/></svg>
                    </a>
                    <a href="https://zalo.me/share/link?url={{ rawurlencode($shareUrl) }}"
                       target="_blank" rel="noopener noreferrer"
                       aria-label="Chia sẻ qua Zalo"
                       class="transition-opacity hover:opacity-75">
                        <svg class="h-5 w-5" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M22.782 0.166016H27.199C33.2653 0.166016 36.8103 1.05701 39.9572 2.74421C43.1041 4.4314 45.5875 6.89585 47.2557 10.0428C48.9429 13.1897 49.8339 16.7347 49.8339 22.801V27.1991C49.8339 33.2654 48.9429 36.8104 47.2557 39.9573C45.5685 43.1042 43.1041 45.5877 39.9572 47.2559C36.8103 48.9431 33.2653 49.8341 27.199 49.8341H22.8009C16.7346 49.8341 13.1896 48.9431 10.0427 47.2559C6.89583 45.5687 4.41243 43.1042 2.7442 39.9573C1.057 36.8104 0.166016 33.2654 0.166016 27.1991V22.801C0.166016 16.7347 1.057 13.1897 2.7442 10.0428C4.43139 6.89585 6.89583 4.41245 10.0427 2.74421C13.1707 1.05701 16.7346 0.166016 22.782 0.166016Z" fill="#0068FF"/>
                            <path opacity="0.12" fill-rule="evenodd" clip-rule="evenodd" d="M49.8336 26.4736V27.1994C49.8336 33.2657 48.9427 36.8107 47.2555 39.9576C45.5683 43.1045 43.1038 45.5879 39.9569 47.2562C36.81 48.9434 33.265 49.8344 27.1987 49.8344H22.8007C17.8369 49.8344 14.5612 49.2378 11.8104 48.0966L7.27539 43.4267L49.8336 26.4736Z" fill="#001A33"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.779 43.5892C10.1019 43.846 13.0061 43.1836 15.0682 42.1825C24.0225 47.1318 38.0197 46.8954 46.4923 41.4732C46.8209 40.9803 47.1279 40.4677 47.4128 39.9363C49.1062 36.7779 50.0004 33.22 50.0004 27.1316V22.7175C50.0004 16.629 49.1062 13.0711 47.4128 9.91273C45.7385 6.75436 43.2461 4.28093 40.0877 2.58758C36.9293 0.894239 33.3714 0 27.283 0H22.8499C17.6644 0 14.2982 0.652754 11.4699 1.89893C11.3153 2.03737 11.1636 2.17818 11.0151 2.32135C2.71734 10.3203 2.08658 27.6593 9.12279 37.0782C9.13064 37.0921 9.13933 37.1061 9.14889 37.1203C10.2334 38.7185 9.18694 41.5154 7.55068 43.1516C7.28431 43.399 7.37944 43.5512 7.779 43.5892Z" fill="white"/>
                            <path d="M20.5632 17H10.8382V19.0853H17.5869L10.9329 27.3317C10.7244 27.635 10.5728 27.9194 10.5728 28.5639V29.0947H19.748C20.203 29.0947 20.5822 28.7156 20.5822 28.2606V27.1421H13.4922L19.748 19.2938C19.8428 19.1801 20.0134 18.9716 20.0893 18.8768L20.1272 18.8199C20.4874 18.2891 20.5632 17.8341 20.5632 17.2844V17Z" fill="#0068FF"/>
                            <path d="M32.9416 29.0947H34.3255V17H32.2402V28.3933C32.2402 28.7725 32.5435 29.0947 32.9416 29.0947Z" fill="#0068FF"/>
                            <path d="M25.814 19.6924C23.1979 19.6924 21.0747 21.8156 21.0747 24.4317C21.0747 27.0478 23.1979 29.171 25.814 29.171C28.4301 29.171 30.5533 27.0478 30.5533 24.4317C30.5723 21.8156 28.4491 19.6924 25.814 19.6924ZM25.814 27.2184C24.2785 27.2184 23.0273 25.9672 23.0273 24.4317C23.0273 22.8962 24.2785 21.645 25.814 21.645C27.3495 21.645 28.6007 22.8962 28.6007 24.4317C28.6007 25.9672 27.3685 27.2184 25.814 27.2184Z" fill="#0068FF"/>
                            <path d="M40.4867 19.6162C37.8516 19.6162 35.7095 21.7584 35.7095 24.3934C35.7095 27.0285 37.8516 29.1707 40.4867 29.1707C43.1217 29.1707 45.2639 27.0285 45.2639 24.3934C45.2639 21.7584 43.1217 19.6162 40.4867 19.6162ZM40.4867 27.2181C38.9322 27.2181 37.681 25.9669 37.681 24.4124C37.681 22.8579 38.9322 21.6067 40.4867 21.6067C42.0412 21.6067 43.2924 22.8579 43.2924 24.4124C43.2924 25.9669 42.0412 27.2181 40.4867 27.2181Z" fill="#0068FF"/>
                            <path d="M29.4562 29.0944H30.5747V19.957H28.6221V28.2793C28.6221 28.7153 29.0012 29.0944 29.4562 29.0944Z" fill="#0068FF"/>
                        </svg>
                    </a>
                </div>
                @endif
            </div>

            {{-- Hero image --}}
            <figure class="mt-12">
                <x-responsive-img :src="$article['image_url']"
                                  alt=""
                                  loading="eager"
                                  sizes="(min-width: 1024px) 800px, calc(100vw - 48px)"
                                  :widths="[600, 900, 1200, 1600]"
                                  class="aspect-[4/3] md:aspect-[16/9] w-full rounded-2xl object-cover" />
                @if (!empty($article['image_credit']))
                    <figcaption class="text-form-hint mt-3 text-center text-text/55">
                        {{ $article['image_credit'] }}
                    </figcaption>
                @endif
            </figure>

            {{-- Body --}}
            <div class="mt-12 max-w-[680px]">
                @forelse ($article['body'] as $block)
                    @switch($block['type'] ?? 'p')
                        @case('h2')
                            <h2 class="text-card-h3 mt-12 mb-4 text-text">{{ $block['text'] }}</h2>
                            @break

                        @case('h3')
                            <h3 class="text-card-h4 mt-10 mb-3 text-text">{{ $block['text'] }}</h3>
                            @break

                        @case('quote')
                            <blockquote class="text-card-h5 my-10 border-l-2 border-accent pl-6 italic text-text/85">
                                "{{ $block['text'] }}"
                            </blockquote>
                            @break

                        @case('ul')
                            <ul class="my-6 list-disc space-y-2 pl-6 text-body-prose text-text/85">
                                @foreach ($block['items'] ?? [] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                            @break

                        @case('ol')
                            <ol class="my-6 list-decimal space-y-2 pl-6 text-body-prose text-text/85">
                                @foreach ($block['items'] ?? [] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ol>
                            @break

                        @default
                            @php
                                // Auto-linkify URLs in body paragraphs
                                $linkified = preg_replace(
                                    '/(https?:\/\/[^\s<>"]+)/u',
                                    '<a href="$1" target="_blank" rel="noopener noreferrer" class="break-words text-text underline underline-offset-4 transition-colors hover:text-gold">$1</a>',
                                    e($block['text'])
                                );
                            @endphp
                            <p class="text-body-prose mt-6 text-text/85">{!! $linkified !!}</p>
                    @endswitch
                @empty
                    <p class="text-body text-text/60">
                        Bài viết đang được biên tập. Vui lòng quay lại sau.
                    </p>
                @endforelse
            </div>

            {{-- Footer: back to news --}}
            <div class="mt-16 border-t border-text/15 pt-6">
                <a href="{{ route('news') }}"
                   class="text-form-label text-text transition-colors hover:text-text/60">
                    ← Tất cả bài viết
                </a>
            </div>
        </div>

        {{-- RIGHT: sidebar --}}
        <aside class="lg:sticky lg:top-24 lg:self-start">

            {{-- Author card --}}
            <div class="card-base">
                <div class="flex items-center gap-3">
                    @if ($isExternalAuthor)
                        <img src="{{ asset($article['author_avatar_url']) }}"
                             alt="{{ $article['author_name'] }}"
                             class="h-14 w-14 flex-none rounded-full bg-bg object-contain p-2 ring-1 ring-text/15">
                    @elseif ($author && !empty($author['portrait_url']))
                        <x-responsive-img :src="$author['portrait_url']"
                                          :alt="$article['author_name']"
                                          sizes="56px"
                                          :widths="[100, 200]"
                                          class="h-14 w-14 flex-none rounded-full object-cover object-top" />
                    @else
                        <span class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-accent/10 text-card-h6 font-semibold text-accent">{{ $authorInitials }}</span>
                    @endif
                    <div class="min-w-0">
                        <p class="text-card-h5 text-text">{{ $article['author_name'] }}</p>
                        @if ($isExternalAuthor)
                            <p class="text-caption text-text/70">Hãng luật đối tác</p>
                        @elseif ($author)
                            <p class="text-caption text-text/70">{{ $author['primary_specialty'] }}</p>
                        @endif
                    </div>
                </div>

                @if ($isExternalAuthor && !empty($article['author_bio']))
                    <p class="text-caption mt-4 text-text/75 leading-relaxed">
                        {{ $article['author_bio'] }}
                    </p>
                @elseif (!$isExternalAuthor && $author && !empty($author['bio'][0]))
                    <p class="text-caption mt-4 text-text/75 leading-relaxed">
                        {{ Str::limit($author['bio'][0], 220) }}
                    </p>
                @endif

                <div class="mt-5 flex items-center justify-between gap-4">
                    <a href="{{ $authorLink }}"
                       @if ($isExternalAuthor) target="_blank" rel="noopener noreferrer" @endif
                       class="text-form-label inline-flex items-center gap-1 text-text transition-colors hover:text-text/70">
                        {{ $isExternalAuthor ? 'Xem website' : 'Xem hồ sơ luật sư' }}
                        <span aria-hidden="true">→</span>
                    </a>
                    @if ($isExternalAuthor && !empty($article['author_socials']))
                        {{-- Mobile-only social icons (desktop has them in the top author row) --}}
                        <div class="flex items-center gap-3 md:hidden">
                            @if (!empty($article['author_socials']['facebook']))
                                <a href="{{ $article['author_socials']['facebook'] }}"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="Facebook của {{ $article['author_name'] }}"
                                   class="text-accent transition-opacity hover:opacity-75">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.62.77-1.62 1.56V12h2.76l-.44 2.89h-2.32v6.99A10 10 0 0 0 22 12z"/></svg>
                                </a>
                            @endif
                            @if (!empty($article['author_socials']['linkedin']))
                                <a href="{{ $article['author_socials']['linkedin'] }}"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="LinkedIn của {{ $article['author_name'] }}"
                                   class="text-accent transition-opacity hover:opacity-75">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05a3.74 3.74 0 0 1 3.37-1.85c3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.44a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0z"/></svg>
                                </a>
                            @endif
                            @if (!empty($article['author_socials']['x']))
                                <a href="{{ $article['author_socials']['x'] }}"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="X (Twitter) của {{ $article['author_name'] }}"
                                   class="text-accent transition-opacity hover:opacity-75">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if (!empty($article['author_socials']['whatsapp']))
                                <a href="{{ $article['author_socials']['whatsapp'] }}"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="WhatsApp của {{ $article['author_name'] }}"
                                   class="text-accent transition-opacity hover:opacity-75">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413"/></svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Related articles --}}
            @if (count($related) > 0)
                <div class="mt-10">
                    <p class="text-eyebrow">Bài viết khác</p>
                    <ul class="mt-6 space-y-6">
                        @foreach ($related as $rel)
                            <li>
                                <a href="{{ route('news.show', $rel['slug']) }}"
                                   class="group flex items-start gap-4">
                                    <x-responsive-img :src="$rel['image_url']"
                                                      alt=""
                                                      sizes="80px"
                                                      :widths="[200, 400]"
                                                      class="aspect-square h-20 w-20 flex-none rounded-lg object-cover" />
                                    <div class="min-w-0">
                                        <p class="text-form-hint text-accent">{{ $rel['category'] }}</p>
                                        <p class="text-card-h6 mt-1 line-clamp-3 text-text transition-colors group-hover:text-text/70">
                                            {{ $rel['title'] }}
                                        </p>
                                        <p class="text-form-hint mt-2 text-text/55">
                                            {{ $rel['read_time'] }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </div>
</article>
@endsection

@extends('layouts.app', ['title' => $article['title'] . ' · LegalEase'])

@php
    use Carbon\Carbon;
    $author = \App\Data\Lawyers::findBySlug($article['author_slug']);
@endphp

@section('content')
    <section class="container-narrow pt-20 pb-12">
        <nav class="text-caption">
            <a href="/" class="transition-colors hover:text-text/60">Trang chủ</a>
            <span class="px-1">/</span>
            <a href="{{ route('news') }}" class="transition-colors hover:text-text/60">Tin tức</a>
            <span class="px-1">/</span>
            <span class="text-text">{{ $article['title'] }}</span>
        </nav>

        <p class="text-eyebrow mt-10 text-text/70">{{ $article['category'] }}</p>

        <h1 class="text-flow-h1 mt-5 leading-tight">
            {{ $article['title'] }}
        </h1>

        <p class="text-flow-intro mt-6 max-w-[620px]">
            {{ $article['lead'] }}
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-x-3 gap-y-1 text-caption">
            <a href="{{ route('lawyers.show', $article['author_slug']) }}"
               class="font-medium text-text transition-colors hover:text-text/60">
                {{ $article['author_name'] }}
            </a>
            <span class="text-text/40">·</span>
            <span>{{ Carbon::parse($article['date'])->translatedFormat('d/m/Y') }}</span>
            <span class="text-text/40">·</span>
            <span>{{ $article['read_time'] }}</span>
        </div>
    </section>

    <section class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-2xl">
            <x-responsive-img :src="$article['image_url']"
                              alt=""
                              loading="eager"
                              sizes="(min-width: 1440px) 1376px, (min-width: 1024px) calc(100vw - 64px), (min-width: 640px) calc(100vw - 48px), calc(100vw - 32px)"
                              :widths="[600, 900, 1200, 1600, 2000]"
                              class="aspect-[21/9] w-full object-cover" />
        </div>
    </section>

    <section class="container-narrow pt-16 pb-24">
        <div class="text-body-prose space-y-6">
            [Contents here]
        </div>
    </section>

    <section class="container-narrow pb-24">
        <div class="border-t border-text/15 pt-12">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:gap-8">
                @if ($author && !empty($author['portrait_url']))
                    <div class="flex-none">
                        <x-responsive-img :src="$author['portrait_url']"
                                          :alt="$author['name']"
                                          sizes="96px"
                                          :widths="[200, 400]"
                                          class="h-20 w-20 rounded-full object-cover object-top sm:h-24 sm:w-24" />
                    </div>
                @endif

                <div class="min-w-0 flex-1">
                    <p class="text-eyebrow text-text/70">Tác giả</p>
                    <p class="text-card-h4 mt-2">{{ $article['author_name'] }}</p>
                    @if ($author)
                        <p class="text-caption text-text/70 mt-1">
                            Chuyên môn · {{ $author['primary_specialty'] }}
                        </p>
                        @if (!empty($author['bio'][0]))
                            <p class="text-body mt-4 max-w-[560px]">
                                {{ $author['bio'][0] }}
                            </p>
                        @endif
                    @else
                        <p class="text-caption text-text/70 mt-1">
                            Chuyên môn · {{ $article['category'] }}
                        </p>
                    @endif
                    <a href="{{ route('lawyers.show', $article['author_slug']) }}"
                       class="text-link-action mt-5 inline-flex items-center gap-2 text-text transition-colors hover:text-gold">
                        Xem hồ sơ luật sư
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>

            <p class="mt-10 text-form-hint uppercase tracking-wide text-text/50">
                Nguồn · LegalEase Editorial · Đăng ngày {{ Carbon::parse($article['date'])->translatedFormat('d/m/Y') }}
            </p>
        </div>
    </section>

@endsection

@extends('layouts.app', ['title' => 'Tư vấn của tôi · LegalEase'])

@php
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $hasUpcoming = $completed && $lawyer;

    $past = collect(\App\Data\PastConsultations::withSessionReviews())
        ->map(fn ($c) => $c + ['status' => 'past']);

    $cancelled = collect(session('cancelled_consultations', []))
        ->map(fn ($c, $code) => $c + ['booking_code' => $code, 'status' => 'cancelled', 'rated' => false])
        ->values();

    $pastConsultations = $past
        ->concat($cancelled)
        ->map(fn ($c) => $c + ['lawyer' => \App\Data\Lawyers::findBySlug($c['lawyer_slug'])])
        ->sortByDesc('date')
        ->values()
        ->all();

    $hasAny = $hasUpcoming || count($pastConsultations) > 0;
@endphp

@section('content')
<section class="container-page pb-24 pt-24">
    @if (session('status'))
        <div class="mb-12 rounded-2xl border border-success/40 bg-bg px-6 py-4">
            <p class="text-caption text-success">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <h1 class="text-page-h1">Tư vấn của tôi.</h1>
    <p class="text-body-prose mt-6 max-w-[560px]">
        Quản lý các buổi tư vấn sắp tới và xem lại lịch sử tư vấn của bạn.
    </p>

    {{-- Empty state --}}
    @unless ($hasAny)
        <div class="mt-16 flex flex-col items-center justify-center rounded-2xl border border-text/20 px-8 py-24 text-center">
            <h3 class="text-chapter-h2">Bạn chưa có buổi tư vấn nào.</h3>
            <p class="text-body mt-3 max-w-md">
                Khi bạn đặt lịch với một luật sư, buổi tư vấn sẽ xuất hiện ở đây.
            </p>
            <x-button variant="primary" href="{{ route('lawyers.index') }}" class="mt-8">
                Tìm luật sư →
            </x-button>
        </div>
    @endunless

    {{-- Upcoming --}}
    @if ($hasUpcoming)
        <div class="mt-16">
            <h2 class="text-section-h2">Tư vấn sắp tới</h2>

            <a href="{{ route('consultations.show', $completed['booking_code']) }}"
               class="group mt-12 block rounded-2xl bg-accent p-8 transition-colors hover:bg-accent/90 md:p-10">
                <div class="grid gap-8 md:grid-cols-[260px_1fr_auto] md:items-center">
                    {{-- Lawyer --}}
                    <div class="flex items-center gap-4">
                        <x-responsive-img :src="$lawyer['portrait_url']"
                                          alt=""
                                          sizes="64px"
                                          :widths="[200, 400]"
                                          class="h-16 w-16 flex-none rounded-full object-cover object-top ring-1 ring-bg/15" />
                        <div class="min-w-0">
                            <p class="text-card-h4 text-bg">{{ $lawyer['name'] }}</p>
                            <p class="text-caption text-bg/75">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    <div class="h-px bg-bg/15 md:hidden"></div>

                    {{-- When + Where --}}
                    <div class="md:flex md:h-32 md:flex-col md:justify-center md:border-l md:border-bg/20 md:pl-8">
                        <p class="text-eyebrow text-bg/65">Thời gian</p>
                        <p class="mt-2 text-card-h5 text-bg">
                            {{ \Carbon\Carbon::parse($completed['date'])->format('d/m/Y') }}
                        </p>
                        <p class="text-caption text-bg/85">
                            {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('H:i') }}
                        </p>
                        <p class="mt-3 text-caption text-bg/85">
                            {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                        </p>
                    </div>

                    <div class="h-px bg-bg/15 md:hidden"></div>

                    {{-- Booking code --}}
                    <div class="md:text-right">
                        <p class="text-eyebrow text-bg/65">Mã đặt chỗ</p>
                        <p class="mt-2 text-card-h5 text-bg">{{ $completed['booking_code'] }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endif

    {{-- Recent --}}
    @if (count($pastConsultations) > 0)
        <div class="mt-24">
            <h2 class="text-section-h2">Tư vấn gần đây</h2>

            <div class="mt-12 space-y-4">
                @foreach ($pastConsultations as $past)
                    <a href="{{ route('consultations.show', $past['booking_code']) }}"
                       class="group block card-base transition-colors hover:border-accent">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Lawyer --}}
                            <div class="flex items-center gap-4">
                                <x-responsive-img :src="$past['lawyer']['portrait_url']"
                                                  alt=""
                                                  sizes="56px"
                                                  :widths="[200, 400]"
                                                  class="h-14 w-14 flex-none rounded-full object-cover object-top" />
                                <div class="min-w-0">
                                    <p class="text-card-h5">{{ $past['lawyer']['name'] }}</p>
                                    <p class="text-caption">{{ $past['lawyer']['primary_specialty'] }}</p>
                                </div>
                            </div>

                            <div class="h-px bg-text/10 md:hidden"></div>

                            {{-- Date + booking code --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-eyebrow">Thời gian</p>
                                <p class="text-card-h6 mt-1">
                                    {{ \Carbon\Carbon::parse($past['date'])->format('d/m/Y') }}
                                </p>
                                <p class="text-caption">
                                    {{ \Carbon\Carbon::createFromFormat('H:i', $past['time'])->format('H:i') }}
                                </p>
                                <p class="text-form-hint mt-1">{{ $past['booking_code'] }}</p>
                            </div>

                            <div class="h-px bg-text/10 md:hidden"></div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                @if ($past['status'] === 'cancelled')
                                    <div class="inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-3 py-1">
                                        <span class="block h-1.5 w-1.5 rounded-full bg-error"></span>
                                        <span class="text-status-pill text-error">Đã hủy</span>
                                    </div>
                                @elseif ($past['rated'])
                                    <div class="md:inline-flex md:flex-col md:items-end">
                                        <x-rating-stars :rating="$past['stars']" size="sm" />
                                        <p class="mt-2 text-form-hint">Đã đánh giá</p>
                                    </div>
                                @else
                                    <p class="text-form-label text-text transition-colors group-hover:text-accent">
                                        Để lại đánh giá →
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection

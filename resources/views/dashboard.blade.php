@extends('layouts.app', ['title' => 'Bảng điều khiển · LegalEase'])

@php
    $user = auth()->user();
    $firstName = explode(' ', trim($user->name))[0];
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $hasUpcoming = $completed && $lawyer;
    $featuredLawyers = \App\Data\Lawyers::featured(3);

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
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
    @if (session('status'))
        <div class="mb-12 rounded-2xl border border-success/40 bg-surface px-6 py-4">
            <p class="text-[14px] text-success">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Chào mừng trở lại</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Xin chào, {{ $firstName }}.
    </h1>
    @unless ($hasUpcoming)
        <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
            Chọn một luật sư bên dưới để đặt lịch tư vấn.
        </p>
    @endunless

    {{-- Upcoming consultations --}}
    @if ($hasUpcoming)
        <div class="mt-16">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Tư vấn sắp tới</h2>

            <a href="{{ route('consultations.show', $completed['booking_code']) }}"
               class="group mt-8 block rounded-2xl border border-text/10 bg-surface p-8 transition-colors hover:border-accent">
                <div class="grid gap-8 md:grid-cols-[260px_1fr_auto] md:items-center">
                    {{-- Lawyer --}}
                    <div class="flex items-center gap-4">
                        <img src="{{ $lawyer['portrait_url'] }}" alt=""
                             class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                            <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    {{-- When + Where --}}
                    <div class="md:flex md:h-32 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-8">
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Thời gian</p>
                        <p class="mt-2 font-display text-[18px] font-medium tracking-tight">
                            {{ \Carbon\Carbon::parse($completed['date'])->format('M j, Y') }}
                        </p>
                        <p class="text-[14px] text-secondary">
                            {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('g:i A') }}
                        </p>
                        <p class="mt-3 text-[13px] text-muted">
                            {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                        </p>
                    </div>

                    {{-- Booking code --}}
                    <div class="md:text-right">
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Mã đặt chỗ</p>
                        <p class="mt-2 font-display text-[18px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endif

    {{-- Recent consultations --}}
    <div class="mt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Tham vấn gần đây</h2>

        <div class="mt-12 space-y-4">
            @foreach ($pastConsultations as $past)
                <a href="{{ route('consultations.show', $past['booking_code']) }}"
                   class="group block rounded-2xl border border-text/10 bg-surface p-6 transition-colors hover:border-accent">
                    <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                        {{-- Lawyer --}}
                        <div class="flex items-center gap-4">
                            <img src="{{ $past['lawyer']['portrait_url'] }}" alt=""
                                 class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
                            <div class="min-w-0">
                                <p class="font-display text-[18px] font-medium tracking-tight">{{ $past['lawyer']['name'] }}</p>
                                <p class="text-[13px] text-muted">{{ $past['lawyer']['primary_specialty'] }}</p>
                            </div>
                        </div>

                        {{-- Date + booking code --}}
                        <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Buổi tư vấn</p>
                            <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                {{ \Carbon\Carbon::parse($past['date'])->format('M j, Y') }}
                            </p>
                            <p class="text-[12px] text-muted">{{ $past['booking_code'] }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="md:text-right">
                            @if ($past['status'] === 'cancelled')
                                <div class="inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-3 py-1">
                                    <span class="block h-1.5 w-1.5 rounded-full bg-error"></span>
                                    <span class="text-[12px] font-medium text-error">Đã hủy</span>
                                </div>
                            @elseif ($past['rated'])
                                <div class="md:inline-flex md:flex-col md:items-end">
                                    <x-rating-stars :rating="$past['stars']" size="sm" />
                                    <p class="mt-2 text-[12px] text-muted">Đã đánh giá</p>
                                </div>
                            @else
                                <p class="text-[14px] font-medium text-text transition-colors group-hover:text-accent">
                                    Viết đánh giá →
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Lawyers we recommend --}}
    <div class="mt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Luật sư chúng tôi đề nghị</h2>
            <x-button variant="ghost" href="{{ route('lawyers.index') }}">Xem tất cả luật sư →</x-button>
        </div>

        <div class="mt-12 flex flex-wrap gap-6">
            @foreach ($featuredLawyers as $featured)
                <div class="w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]">
                    <x-lawyer-card :lawyer="$featured" class="h-full" />
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

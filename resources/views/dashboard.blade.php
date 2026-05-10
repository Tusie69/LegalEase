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
        <div class="mb-12 rounded-2xl border border-success/40 bg-bg px-6 py-4">
            <p class="text-[14px] text-success">{{ session('status') }}</p>
        </div>
    @endif

    <p class="text-eyebrow">Chào mừng trở lại</p>
    <h1 class="text-page-h1 mt-3">
        Xin chào, {{ $user->name }}.
    </h1>
    @unless ($hasUpcoming)
        <p class="text-flow-intro mt-4 max-w-[560px]">
            Chọn một luật sư dưới đây để đặt lịch tham vấn.
        </p>
    @endunless

    @if ($hasUpcoming)
        <div class="mt-24">
            <h2 class="text-section-h2">Tư vấn sắp tới</h2>

            <a href="{{ route('consultations.show', $completed['booking_code']) }}"
               class="group mt-8 block card-base-lg transition-colors hover:border-accent">
                <div class="grid gap-8 md:grid-cols-[260px_1fr_auto] md:items-center">
                    <div class="flex items-center gap-4">
                        <x-responsive-img :src="$lawyer['portrait_url']"
                                          alt=""
                                          sizes="64px"
                                          :widths="[200, 400]"
                                          class="h-16 w-16 flex-none rounded-full object-cover object-top" />
                        <div class="min-w-0">
                            <p class="text-card-h4">{{ $lawyer['name'] }}</p>
                            <p class="text-[14px]">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    <div class="md:flex md:h-32 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-8">
                        <p class="text-eyebrow">Thời gian</p>
                        <p class="mt-2 text-card-h5">
                            {{ \Carbon\Carbon::parse($completed['date'])->format('d/m/Y') }}
                        </p>
                        <p class="text-[14px]">
                            {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('H:i') }}
                        </p>
                        <p class="mt-3 text-[14px]">
                            {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                        </p>
                    </div>

                    <div class="md:text-right">
                        <p class="text-eyebrow">Mã đặt chỗ</p>
                        <p class="mt-2 text-card-h5">{{ $completed['booking_code'] }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endif

    <div class="mt-24">
        <div class="flex flex-col items-start gap-6 lg:flex-row lg:items-end lg:justify-between lg:gap-8">
            <h2 class="text-section-h2">Luật sư chúng tôi đề nghị</h2>
            <x-button variant="ghost" href="{{ route('lawyers.index') }}">Xem tất cả luật sư →</x-button>
        </div>

        <div class="mt-12 flex flex-wrap gap-6">
            @foreach ($featuredLawyers as $featured)
                <div class="w-full lg:w-[calc(33.333%-1rem)]">
                    <x-lawyer-card :lawyer="$featured" class="h-full" />
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-24">
        <h2 class="text-section-h2">Tham vấn gần đây</h2>

        <div class="mt-12 space-y-4">
            @foreach ($pastConsultations as $past)
                <a href="{{ route('consultations.show', $past['booking_code']) }}"
                   class="group block card-base transition-colors hover:border-accent">
                    <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                        <div class="flex items-center gap-4">
                            <x-responsive-img :src="$past['lawyer']['portrait_url']"
                                              alt=""
                                              sizes="56px"
                                              :widths="[200, 400]"
                                              class="h-14 w-14 flex-none rounded-full object-cover object-top" />
                            <div class="min-w-0">
                                <p class="text-card-h5">{{ $past['lawyer']['name'] }}</p>
                                <p class="text-[14px]">{{ $past['lawyer']['primary_specialty'] }}</p>
                            </div>
                        </div>

                        <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                            <p class="text-eyebrow">Buổi tư vấn</p>
                            <p class="text-card-h6 mt-1">
                                {{ \Carbon\Carbon::parse($past['date'])->format('d/m/Y') }}
                            </p>
                            <p class="text-[12px]">{{ $past['booking_code'] }}</p>
                        </div>

                        <div class="md:text-right">
                            @if ($past['status'] === 'cancelled')
                                <div class="inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-3 py-1">
                                    <span class="block h-1.5 w-1.5 rounded-full bg-error"></span>
                                    <span class="text-[12px] font-medium text-error">Đã hủy</span>
                                </div>
                            @elseif ($past['rated'])
                                <div class="md:inline-flex md:flex-col md:items-end">
                                    <x-rating-stars :rating="$past['stars']" size="sm" />
                                    <p class="mt-2 text-[12px]">Đã đánh giá</p>
                                </div>
                            @else
                                <p class="text-[14px] font-medium text-text transition-colors group-hover:text-accent">
                                    Để lại đánh giá →
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

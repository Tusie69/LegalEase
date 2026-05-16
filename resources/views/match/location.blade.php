@extends('layouts.app', ['title' => 'Tìm luật sư phù hợp · LegalEase'])

@php
    $intake = session('match', []);
    $options = [
        'Hà Nội'             => 'Thủ đô và khu vực miền Bắc',
        'TP. Hồ Chí Minh'    => 'TP.HCM và khu vực miền Nam',
        'Đà Nẵng'            => 'Khu vực miền Trung',
        '__any__'            => 'Không quan trọng. Cho tôi xem tất cả.',
    ];
    $current = '';
@endphp

@section('content')
<form method="POST" action="{{ route('match.location.store') }}"
      x-data="{ selected: @js($current) }"
      class="container-page pt-24 pb-32 md:pt-32">
    @csrf
    <input type="hidden" name="location" :value="selected">

    <div class="mx-auto max-w-[720px]">
        <div class="flex items-center justify-between">
            <a href="{{ route('match.specialty') }}"
               class="text-link-action inline-flex items-center gap-2 text-text/60 transition-colors hover:text-text">
                <span aria-hidden="true">←</span>
                <span>Quay lại</span>
            </a>
            <p class="text-eyebrow text-text/60" aria-label="Quiz progress">Bước 2 / 4</p>
        </div>
        <div class="mt-4 h-1 w-full overflow-hidden rounded-full bg-text/10">
            <div class="h-full w-2/4 bg-accent ease-soft transition-all duration-500"></div>
        </div>
    </div>

    <div class="mx-auto mt-16 max-w-[720px] text-center">
        <h1 class="text-page-h1">Bạn muốn gặp luật sư ở đâu?</h1>
        <p class="text-body-prose mt-6 text-text/70">
            Chọn thành phố thuận tiện nhất cho bạn. Phần lớn luật sư đều hỗ trợ tư vấn trực tuyến.
        </p>
    </div>

    <div class="mx-auto mt-12 grid max-w-[960px] gap-4 sm:grid-cols-2">
        @foreach ($options as $value => $description)
            @php $displayLabel = $value === '__any__' ? 'Cả ba thành phố' : $value; @endphp
            <button type="button"
                    @click="selected = @js($value)"
                    :aria-pressed="selected === @js($value)"
                    :class="selected === @js($value)
                        ? 'border-accent border-2 -m-px'
                        : 'border-text/20 hover:border-accent'"
                    class="group relative flex w-full items-start gap-4 rounded-2xl border bg-bg p-6 text-left transition-all duration-200">
                <span aria-hidden="true"
                      :class="selected === @js($value) ? 'bg-accent border-accent' : 'border-text/30'"
                      class="absolute right-6 top-6 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full border-2 transition-colors">
                    <svg x-show="selected === @js($value)"
                         class="h-3.5 w-3.5 text-bg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </span>
                <div class="flex-1 pr-10">
                    <p class="text-card-h4 text-text">{{ $displayLabel }}</p>
                    <p class="text-body-dense mt-2 text-text/70">{{ $description }}</p>
                </div>
            </button>
        @endforeach
    </div>

    <div class="mx-auto mt-16 max-w-[720px]">
        <button type="submit"
                :disabled="!selected"
                :class="selected ? 'bg-accent text-bg hover:text-gold' : 'cursor-not-allowed bg-text/20 text-text/40'"
                class="inline-flex w-full items-center justify-center rounded-full border border-accent px-8 py-4 text-caption font-semibold transition-all duration-200">
            <span>Tiếp theo</span>
            <span class="ml-2" aria-hidden="true">→</span>
        </button>
        <p x-show="!selected" x-cloak
           class="text-form-hint mt-4 text-center text-text/50">
            Vui lòng chọn ít nhất một lựa chọn để tiếp tục.
        </p>
        <div class="mt-8 text-center">
            <a href="{{ route('lawyers.index') }}"
               class="text-link-action inline-flex items-center gap-2 text-text/60 transition-colors hover:text-text">
                <span>Bỏ qua, tìm tất cả luật sư</span>
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</form>
@endsection

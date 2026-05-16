@extends('layouts.app', ['title' => 'Tìm luật sư phù hợp · LegalEase'])

@php
    $intake = session('match', []);
    $options = [
        'Luật Hôn nhân & Gia đình' => 'Ly hôn, quyền nuôi con, tranh chấp tài sản, hợp đồng tiền hôn nhân.',
        'Luật Doanh nghiệp'        => 'Thành lập, M&A, hợp đồng thương mại, đầu tư nước ngoài.',
        'Bất động sản'             => 'Mua bán nhà đất, chủ quyền, hợp đồng thuê thương mại.',
        'Bào chữa hình sự'         => 'Bào chữa các vụ án hình sự, tố tụng tại Tòa án.',
        'Luật Lao động'            => 'Hợp đồng lao động, sa thải trái pháp luật, bồi thường.',
        'Tố tụng dân sự'           => 'Tranh chấp hợp đồng, bồi thường thiệt hại, kiện dân sự.',
    ];
    $current = '';
@endphp

@section('content')
<form method="POST" action="{{ route('match.specialty.store') }}"
      x-data="{ selected: @js($current) }"
      class="container-page pt-24 pb-32 md:pt-32">
    @csrf
    <input type="hidden" name="specialty" :value="selected">

    {{-- Top: back + progress --}}
    <div class="mx-auto max-w-[720px]">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}"
               class="text-link-action inline-flex items-center gap-2 text-text/60 transition-colors hover:text-text">
                <span aria-hidden="true">←</span>
                <span>Thoát</span>
            </a>
            <p class="text-eyebrow text-text/60" aria-label="Quiz progress">Bước 1 / 4</p>
        </div>
        <div class="mt-4 h-1 w-full overflow-hidden rounded-full bg-text/10">
            <div class="h-full w-1/4 bg-accent ease-soft transition-all duration-500"></div>
        </div>
    </div>

    {{-- Heading --}}
    <div class="mx-auto mt-16 max-w-[720px] text-center">
        <h1 class="text-page-h1">Bạn cần tư vấn về vấn đề gì?</h1>
        <p class="text-body-prose mt-6 text-text/70">
            Chọn lĩnh vực gần nhất với tình huống của bạn.
        </p>
    </div>

    {{-- Option cards (click selects, doesn't submit) --}}
    <div class="mx-auto mt-12 grid max-w-[960px] gap-4 sm:grid-cols-2">
        @foreach ($options as $label => $description)
            <button type="button"
                    @click="selected = @js($label)"
                    :aria-pressed="selected === @js($label)"
                    :class="selected === @js($label)
                        ? 'border-accent border-2 -m-px'
                        : 'border-text/20 hover:border-accent'"
                    class="group relative flex w-full items-start gap-4 rounded-2xl border bg-bg p-6 text-left transition-all duration-200">
                {{-- Selection indicator (right-side check circle) --}}
                <span aria-hidden="true"
                      :class="selected === @js($label) ? 'bg-accent border-accent' : 'border-text/30'"
                      class="absolute right-6 top-6 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full border-2 transition-colors">
                    <svg x-show="selected === @js($label)"
                         class="h-3.5 w-3.5 text-bg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </span>
                <div class="flex-1 pr-10">
                    <p class="text-card-h4 text-text">{{ $label }}</p>
                    <p class="text-body-dense mt-2 text-text/70">{{ $description }}</p>
                </div>
            </button>
        @endforeach
    </div>

    {{-- Bottom action bar --}}
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
        {{-- Skip-to-browse escape hatch for users who'd rather see all lawyers --}}
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

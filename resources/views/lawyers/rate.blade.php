@extends('layouts.app', ['title' => 'Đánh giá sự tư vấn của bạn · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <h1 class="text-flow-h1">
        Buổi tư vấn thế nào?
    </h1>
    <p class="text-flow-intro mt-4">
        Phản hồi trung thực giúp khách hàng khác chọn được luật sư phù hợp.
    </p>

    {{-- Dossier (archival, matches past consultation detail) --}}
    <div class="mt-12 card-base">
        <div class="flex items-center gap-5">
            <x-responsive-img :src="$lawyer['portrait_url']"
                              alt=""
                              sizes="80px"
                              :widths="[200, 400]"
                              class="h-20 w-20 flex-none rounded-full object-cover object-top" />
            <div class="min-w-0">
                <p class="text-card-h3">{{ $lawyer['name'] }}</p>
                <p class="text-caption">
                    {{ $lawyer['primary_specialty'] }}@if (!empty($lawyer['bar_association'])) · {{ $lawyer['bar_association'] }}@endif
                </p>
            </div>
        </div>

        <div class="my-8 h-px bg-text/10"></div>

        <div class="grid gap-8 md:grid-cols-2">
            <div>
                <p class="text-eyebrow">Thời gian</p>
                <p class="text-card-h4 mt-2">
                    {{ \Illuminate\Support\Str::title(\Carbon\Carbon::parse($consultation['date'])->translatedFormat('l, d/m/Y')) }}
                </p>
                <p class="text-caption">
                    {{ \Carbon\Carbon::createFromFormat('H:i', $consultation['time'])->format('H:i') }} · 60 phút
                </p>
            </div>
            <div>
                <p class="text-eyebrow">Địa điểm</p>
                <p class="mt-2 text-body text-text">{{ $lawyer['address']['street_address'] }}</p>
                <p class="text-caption">{{ $lawyer['address']['province'] }}</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('consultations.rate.store', $consultation['booking_code']) }}"
          class="mt-10 space-y-8" novalidate
          x-data="{ stars: {{ (int) old('stars', 0) }}, hover: 0 }"
          @submit="if (!stars) { $event.preventDefault(); }">
        @csrf

        {{-- Stars --}}
        <div>
            <p class="text-form-label">
                Bạn đánh giá trải nghiệm của mình thế nào?
            </p>
            <div class="mt-4 flex items-center gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button"
                            @click="stars = {{ $i }}"
                            @mouseover="hover = {{ $i }}"
                            @mouseleave="hover = 0"
                            aria-label="{{ $i }} sao"
                            class="transition-transform duration-150 hover:scale-110 focus:outline-none">
                        <svg class="h-10 w-10 transition-colors duration-150"
                             :class="(hover || stars) >= {{ $i }} ? 'text-gold-bright' : 'text-text/20'"
                             viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
                        </svg>
                    </button>
                @endfor
            </div>
            <input type="hidden" name="stars" :value="stars">
            <p x-show="!stars && {{ $errors->has('stars') ? 'true' : 'false' }}" x-cloak
               class="mt-3 text-caption text-error">Vui lòng chọn một đánh giá.</p>
            @error('stars') <p class="mt-3 text-caption text-error">{{ $message }}</p> @enderror
        </div>

        {{-- Review text --}}
        <div>
            <label for="review_text" class="block text-form-label">
                Thêm nhận xét <span class="text-text/60">(không bắt buộc)</span>
            </label>
            <textarea id="review_text" name="review_text" rows="6" maxlength="2000"
                      placeholder="Điều gì nổi bật? Có gì có thể tốt hơn?"
                      class="mt-3 block w-full resize-y rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('review_text') }}</textarea>
            @error('review_text') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-6">
            <x-button variant="primary" type="submit">Gửi đánh giá</x-button>
            <a href="{{ route('consultations.show', $consultation['booking_code']) }}" class="text-caption transition-colors hover:text-text/60">
                Để sau
            </a>
        </div>
    </form>
</section>
@endsection

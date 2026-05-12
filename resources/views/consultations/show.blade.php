@extends('layouts.app', ['title' => 'Tư vấn · LegalEase'])

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('consultations.index') }}" class="text-caption transition-colors hover:text-text/60">
        ← Quay lại tư vấn của tôi
    </a>

    <h1 class="text-flow-h1 mt-10">
        Buổi tư vấn của bạn với {{ $lawyer['name'] }}
    </h1>
    <p class="mt-4 text-caption">{{ $consultation['booking_code'] }}</p>

    @php $isUpcoming = $consultation['status'] === 'upcoming'; @endphp

    {{-- Dossier (navy when upcoming, light otherwise) --}}
    <div class="mt-12 {{ $isUpcoming ? 'rounded-2xl bg-accent p-6 md:p-8' : 'card-base' }}">
        <div class="flex items-center gap-5">
            <x-responsive-img :src="$lawyer['portrait_url']"
                              alt=""
                              sizes="80px"
                              :widths="[200, 400]"
                              class="h-20 w-20 flex-none rounded-full object-cover object-top" />
            <div class="min-w-0">
                <p class="text-card-h3 {{ $isUpcoming ? 'text-bg' : '' }}">{{ $lawyer['name'] }}</p>
                <p class="text-caption {{ $isUpcoming ? 'text-bg/75' : '' }}">
                    {{ $lawyer['primary_specialty'] }} · {{ $lawyer['bar_association'] }}
                </p>
            </div>
        </div>

        <div class="my-8 h-px {{ $isUpcoming ? 'bg-bg/15' : 'bg-text/10' }}"></div>

        <div class="grid gap-8 md:grid-cols-2">
            <div>
                <p class="text-eyebrow {{ $isUpcoming ? 'text-bg/65' : '' }}">Thời gian</p>
                <p class="text-card-h4 mt-2 {{ $isUpcoming ? 'text-bg' : '' }}">
                    {{ \Illuminate\Support\Str::title(\Carbon\Carbon::parse($consultation['date'])->translatedFormat('l, d/m/Y')) }}
                </p>
                <p class="text-caption {{ $isUpcoming ? 'text-bg/85' : '' }}">
                    {{ \Carbon\Carbon::createFromFormat('H:i', $consultation['time'])->format('H:i') }} · 60 phút
                </p>
            </div>
            <div>
                <p class="text-eyebrow {{ $isUpcoming ? 'text-bg/65' : '' }}">Địa điểm</p>
                <p class="mt-2 text-body {{ $isUpcoming ? 'text-bg' : 'text-text' }}">{{ $lawyer['address']['street_address'] }}</p>
                <p class="text-caption {{ $isUpcoming ? 'text-bg/85' : '' }}">{{ $lawyer['address']['province'] }}</p>
            </div>
        </div>
    </div>

    @if ($consultation['status'] === 'cancelled')
        {{-- Cancelled --}}
        <div class="mt-16 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Tình trạng</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-form-label text-error">Đã hủy</span>
            </div>
            <p class="mt-6 max-w-[520px] text-body">
                Bạn đã hủy buổi tư vấn này vào ngày {{ \Carbon\Carbon::parse($consultation['cancelled_at'])->format('d/m/Y') }}.
                @if ($consultation['refund_eligible'])
                    Khoản đặt cọc của bạn sẽ được hoàn lại trong 3 đến 5 ngày làm việc.
                @else
                    Hủy trong vòng 24 giờ trước cuộc hẹn không được hoàn tiền.
                @endif
            </p>
        </div>

        {{-- Book again --}}
        <div class="mt-12 border-t border-text/20 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-body font-medium text-text transition-colors hover:text-text/70">
                Đặt lịch lại với {{ $lawyer['name'] }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @elseif ($consultation['status'] === 'upcoming')
        {{-- Status (upcoming) --}}
        <div class="mt-16 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Tình trạng</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-form-label text-success">Đã xác nhận</span>
            </div>
            <p class="mt-6 max-w-[520px] text-body">
                Buổi tư vấn của bạn đã được đặt. Bạn sẽ nhận lời nhắc 24 giờ trước cuộc hẹn. Hủy trước hơn 24 giờ được hoàn tiền toàn bộ.
            </p>
        </div>

        {{-- Manage --}}
        <div class="mt-12 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Quản lý</p>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('consultations.cancel', $consultation['booking_code']) }}"
                   class="text-form-label text-error transition-colors hover:text-error/80">
                    Hủy buổi tư vấn
                </a>
                <a href="{{ route('contact') }}"
                   class="text-caption transition-colors hover:text-text/60">
                    Liên hệ đội ngũ của chúng tôi →
                </a>
            </div>
        </div>
    @else
        {{-- Review (past) --}}
        <div class="mt-16 border-t border-text/20 pt-12">
            @if ($consultation['rated'])
                <p class="text-eyebrow">Đánh giá của bạn</p>
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <x-rating-stars :rating="$consultation['stars']" size="md" />
                    <span class="text-caption">
                        Đã gửi {{ \Carbon\Carbon::parse($consultation['reviewed_at'])->format('d/m/Y') }}
                    </span>
                </div>
                @if (!empty($consultation['review_text']))
                    <blockquote class="mt-6 text-body-prose">
                        “{{ $consultation['review_text'] }}”
                    </blockquote>
                @endif
            @else
                <p class="text-eyebrow">Nó thế nào?</p>
                <h2 class="text-chapter-h2 mt-3">
                    Chia sẻ với khách hàng khác.
                </h2>
                <p class="mt-3 max-w-[520px] text-body">
                    Đánh giá trung thực giúp khách hàng khác chọn được luật sư phù hợp.
                </p>
                <div class="mt-8">
                    <x-button variant="primary" :href="route('consultations.rate', $consultation['booking_code'])">
                        Để lại đánh giá
                    </x-button>
                </div>
            @endif
        </div>

        {{-- Book again --}}
        <div class="mt-16 border-t border-text/20 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-body font-medium text-text transition-colors hover:text-text/70">
                Đặt lịch lại với {{ $lawyer['name'] }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @endif
</section>
@endsection

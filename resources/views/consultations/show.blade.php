@extends('layouts.app', ['title' => 'Tư vấn · LegalEase'])

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('home') }}" class="text-[14px] transition-colors hover:text-accent">
        ← Quay lại bảng điều khiển
    </a>

    <p class="mt-10 text-eyebrow">Buổi tư vấn</p>
    <h1 class="text-flow-h1 mt-3">
        Buổi tư vấn của bạn với {{ $lawyer['name'] }}
    </h1>
    <p class="mt-4 text-[14px]">{{ $consultation['booking_code'] }}</p>

    <div class="mt-12 card-base">
        <div class="flex items-center gap-5">
            <x-responsive-img :src="$lawyer['portrait_url']"
                              alt=""
                              sizes="80px"
                              :widths="[200, 400]"
                              class="h-20 w-20 flex-none rounded-full object-cover object-top" />
            <div class="min-w-0">
                <p class="text-card-h3">{{ $lawyer['name'] }}</p>
                <p class="text-[14px]">
                    {{ $lawyer['primary_specialty'] }} · {{ $lawyer['bar_association'] }}
                </p>
            </div>
        </div>
    </div>

    <div class="mt-10 grid gap-10 md:grid-cols-2">
        <div>
            <p class="text-eyebrow">Thời gian</p>
            <p class="text-card-h4 mt-2">
                {{ \Illuminate\Support\Str::title(\Carbon\Carbon::parse($consultation['date'])->translatedFormat('l, d/m/Y')) }}
            </p>
            <p class="text-[14px]">
                {{ \Carbon\Carbon::createFromFormat('H:i', $consultation['time'])->format('H:i') }} · 60 phút
            </p>
        </div>
        <div>
            <p class="text-eyebrow">Địa điểm</p>
            <p class="mt-2 text-[16px] text-text">{{ $lawyer['address']['street_address'] }}</p>
            <p class="text-[14px]">{{ $lawyer['address']['province'] }}</p>
        </div>
    </div>

    @if ($consultation['status'] === 'cancelled')
        <div class="mt-16 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Tình trạng</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-[14px] font-medium text-error">Đã hủy</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[16px]">
                Bạn đã hủy buổi tư vấn này vào ngày {{ \Carbon\Carbon::parse($consultation['cancelled_at'])->format('d/m/Y') }}.
                @if ($consultation['refund_eligible'])
                    Khoản đặt cọc của bạn sẽ được hoàn lại trong 3 đến 5 ngày làm việc.
                @else
                    Hủy trong vòng 24 giờ trước cuộc hẹn không được hoàn tiền.
                @endif
            </p>
        </div>

        <div class="mt-12 border-t border-text/20 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-[16px] font-medium text-text transition-colors hover:text-text/70">
                Đặt lịch lại với {{ $lawyer['name'] }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @elseif ($consultation['status'] === 'upcoming')
        <div class="mt-16 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Tình trạng</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[14px] font-medium text-success">Đã xác nhận</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[16px]">
                Buổi tư vấn của bạn đã được đặt. Bạn sẽ nhận lời nhắc 24 giờ trước cuộc hẹn. Hủy trước hơn 24 giờ được hoàn tiền toàn bộ.
            </p>
        </div>

        <div class="mt-12 border-t border-text/20 pt-12">
            <p class="text-eyebrow">Quản lý</p>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('consultations.cancel', $consultation['booking_code']) }}"
                   class="text-[14px] font-medium text-error transition-colors hover:text-error/80">
                    Hủy buổi tư vấn
                </a>
                <a href="{{ route('contact') }}"
                   class="text-[14px] transition-colors hover:text-accent">
                    Liên hệ đội ngũ của chúng tôi →
                </a>
            </div>
        </div>
    @else
        <div class="mt-16 border-t border-text/20 pt-12">
            @if ($consultation['rated'])
                <p class="text-eyebrow">Đánh giá của bạn</p>
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <x-rating-stars :rating="$consultation['stars']" size="md" />
                    <span class="text-[14px]">
                        Đã gửi {{ \Carbon\Carbon::parse($consultation['reviewed_at'])->format('d/m/Y') }}
                    </span>
                </div>
                @if (!empty($consultation['review_text']))
                    <blockquote class="mt-6 border-l-2 border-text/10 pl-5 text-[18px] leading-relaxed">
                        “{{ $consultation['review_text'] }}”
                    </blockquote>
                @endif
            @else
                <p class="text-eyebrow">Nó thế nào?</p>
                <h2 class="text-chapter-h2 mt-3">
                    Chia sẻ với khách hàng khác.
                </h2>
                <p class="mt-3 max-w-[520px] text-[16px]">
                    Đánh giá trung thực giúp khách hàng khác chọn được luật sư phù hợp.
                </p>
                <div class="mt-8">
                    <x-button variant="primary" :href="route('consultations.rate', $consultation['booking_code'])">
                        Để lại đánh giá
                    </x-button>
                </div>
            @endif
        </div>

        <div class="mt-16 border-t border-text/20 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-[16px] font-medium text-text transition-colors hover:text-text/70">
                Đặt lịch lại với {{ $lawyer['name'] }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @endif
</section>
@endsection

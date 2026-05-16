@extends('layouts.app', ['title' => 'Đã xác nhận đặt chỗ · LegalEase'])

@php
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lawyers::findBySlug($completed['lawyer_slug']) : null;
    $user = auth()->user();
    $firstName = $user ? explode(' ', trim($user->name))[0] : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$completed || !$lawyer)
        <div class="card-base-lg">
            <p class="text-body">Không tìm thấy đặt phòng. Tìm luật sư để làm một cái mới.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-form-label text-text transition-colors hover:text-text/70">
                Tìm luật sư
                <span aria-hidden="true">→</span>
            </a>
        </div>
    @else
        <h1 class="text-flow-h1">
            Hoàn tất{{ $firstName ? ', ' . $firstName : '' }}.
        </h1>
        <p class="text-flow-intro mt-4">
            Chúng tôi đã gửi chi tiết tới email của bạn. {{ $lawyer['name'] }} đã được thông báo.
        </p>

        {{-- Booking card --}}
        <div class="mt-12 card-base-lg">
            <p class="text-eyebrow">Mã đặt chỗ</p>
            <p class="text-chapter-h2 mt-2">{{ $completed['booking_code'] }}</p>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-center gap-4">
                <x-responsive-img :src="$lawyer['portrait_url']"
                                  alt=""
                                  sizes="64px"
                                  :widths="[200, 400]"
                                  class="h-16 w-16 flex-none rounded-full object-cover object-top" />
                <div class="min-w-0">
                    <p class="text-card-h4">{{ $lawyer['name'] }}</p>
                    <p class="text-caption">{{ $lawyer['primary_specialty'] }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-4">
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-eyebrow flex-none">Thời gian</span>
                    <span class="text-right text-body text-text">
                        {{ \Carbon\Carbon::parse($completed['date'])->format('d/m/Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('H:i') }}
                    </span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-eyebrow flex-none">Địa điểm</span>
                    <span class="text-right text-body text-text">
                        {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- What happens next --}}
        <div class="mt-12">
            <p class="text-eyebrow">Điều gì xảy ra tiếp theo</p>
            <ul class="mt-6 space-y-4 text-body">
                <li>Bạn sẽ nhận nhắc nhở qua {{ $completed['contact_preference'] === 'phone' ? 'điện thoại' : 'email' }} 24 giờ trước cuộc hẹn.</li>
                <li>Đến văn phòng sớm vài phút. Mang theo bất kỳ tài liệu nào bạn muốn luật sư xem xét.</li>
                <li>Cần hủy? Hủy trước hơn 24 giờ sẽ được hoàn lại toàn bộ số tiền.</li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="mt-12">
            <x-button variant="primary" href="{{ route('consultations.index') }}" class="w-full">
                Xem tư vấn của tôi
            </x-button>
            <p class="mt-4 text-center text-caption">
                <a href="{{ route('lawyers.index') }}" class="transition-colors hover:text-text/60">
                    Tìm thêm luật sư →
                </a>
            </p>
        </div>
    @endif
</section>
@endsection

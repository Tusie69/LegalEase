@extends('layouts.app', ['title' => ($heading ?? 'Something went wrong') . ' · LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen items-center justify-center overflow-hidden">
    {{-- Photo --}}
    <img src="{{ $photo }}"
         alt=""
         class="absolute inset-0 h-full w-full object-cover grayscale brightness-[0.55]">

    {{-- Scrim --}}
    <div class="absolute inset-0 bg-gradient-to-b from-bg/40 via-bg/20 to-bg"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-[640px] px-6 text-center">
        @if (!empty($code))
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $code }}</p>
        @endif
        <h1 class="@if (!empty($code)) mt-4 @endif font-display text-[44px] font-medium tracking-[-0.02em] md:text-[64px]">{{ $heading }}</h1>
        <p class="mt-6 text-[16px] text-secondary md:text-[17px]">{{ $body }}</p>

        @hasSection('actions')
            <div class="mt-10 flex justify-center">
                @yield('actions')
            </div>
        @endif
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Đăng nhập · LegalEase'])

@section('content')
<section class="container-page pt-24 pb-24 md:pt-32 md:pb-32">
    <div class="mx-auto max-w-[640px]">
        <h1 class="text-page-h1 text-center md:text-left">
            Chào mừng trở lại.
            Đăng nhập với tư cách...
        </h1>

        <div class="mt-12 flex flex-col gap-4">
            {{-- Customer login --}}
            <a href="{{ route('login') }}"
               class="group flex items-center justify-between rounded-2xl border-2 border-text/20 bg-bg p-8 transition-all duration-200 hover:-translate-y-0.5 hover:border-accent">
                <span class="text-card-h3 text-text">Tôi là khách hàng</span>
                <span class="text-text/40 transition-colors group-hover:text-accent">
                    <x-icon name="users" :size="28" />
                </span>
            </a>

            {{-- Lawyer login --}}
            <a href="{{ route('lawyer.login') }}"
               class="group flex items-center justify-between rounded-2xl border-2 border-text/20 bg-bg p-8 transition-all duration-200 hover:-translate-y-0.5 hover:border-accent">
                <span class="text-card-h3 text-text">Tôi là luật sư</span>
                <span class="text-text/40 transition-colors group-hover:text-accent">
                    <x-icon name="briefcase" :size="28" />
                </span>
            </a>
        </div>
    </div>
</section>
@endsection

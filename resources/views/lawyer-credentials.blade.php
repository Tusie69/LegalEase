@extends('layouts.app', ['title' => 'Verify your credentials · LegalEase'])

@php
    $documents = [
        [
            'id'    => 'bar_card',
            'name'  => 'bar_card',
            'label' => 'Bar card scan',
            'desc'  => 'A clear scan or photo of your current bar membership card.',
        ],
        [
            'id'    => 'identity_document',
            'name'  => 'identity_document',
            'label' => 'Identity document',
            'desc'  => 'Vietnamese national ID or passport. Photo or PDF.',
        ],
        [
            'id'    => 'education_certificate',
            'name'  => 'education_certificate',
            'label' => 'Education certificate',
            'desc'  => 'Your law school degree or equivalent qualification.',
        ],
    ];
@endphp

@section('content')
{{-- Visual strip --}}
<div class="relative -mt-[72px] h-[280px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80"
         alt=""
         class="absolute inset-0 h-full w-full object-cover grayscale brightness-[0.55]">
    <div class="absolute inset-0 bg-gradient-to-b from-bg/40 via-bg/20 to-bg"></div>
</div>

<section class="mx-auto max-w-[760px] px-8 pt-24 pb-24">
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Lawyer onboarding</p>
    <h1 class="mt-3 font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
        Submit your documents
    </h1>
    <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
        We need three documents to verify your bar membership and identity. Reviewed within 2 to 3 business days. Your information is held securely and only seen by our verification team.
    </p>

    <form method="POST" action="{{ route('lawyer.credentials.store') }}" enctype="multipart/form-data" class="mt-12 space-y-6" novalidate>
        @csrf

        @foreach ($documents as $doc)
            <div class="rounded-2xl border border-text/10 bg-surface p-6" x-data="{ filename: '' }">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="min-w-0">
                        <label for="{{ $doc['id'] }}" class="block text-[15px] font-medium text-text">
                            {{ $doc['label'] }} <span class="text-gold">*</span>
                        </label>
                        <p class="mt-1 text-[13px] text-muted">{{ $doc['desc'] }}</p>
                        <p class="mt-2 truncate text-[13px] text-secondary" x-show="filename" x-cloak>
                            <span x-text="filename"></span>
                        </p>
                    </div>
                    <div class="flex-none">
                        <input id="{{ $doc['id'] }}" type="file" name="{{ $doc['name'] }}"
                               accept="image/*,.pdf" required
                               class="hidden"
                               x-on:change="filename = $event.target.files[0]?.name || ''">
                        <label for="{{ $doc['id'] }}"
                               class="inline-flex cursor-pointer items-center rounded-full border border-muted px-6 py-3 text-[14px] font-medium text-text transition-colors hover:border-accent hover:text-accent">
                            <span x-text="filename ? 'Change file' : 'Choose file'">Choose file</span>
                        </label>
                    </div>
                </div>
                <p class="mt-3 text-[12px] text-muted">PDF, JPG, or PNG. Max 10MB.</p>
            </div>
        @endforeach

        <div class="pt-4">
            <x-button variant="primary" type="submit" class="w-full">Submit for review</x-button>
        </div>

        <p class="text-center text-[14px]">
            <a href="{{ route('lawyer.dashboard') }}" class="text-muted transition-colors hover:text-accent">
                Back to dashboard
            </a>
        </p>
    </form>
</section>
@endsection

@extends('layouts.app', ['title' => 'Dashboard · LegalEase'])

@section('content')
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Dashboard</p>
        <h1 class="mt-3 font-display text-5xl font-medium tracking-tight">
            Welcome, {{ auth()->user()->name }}
        </h1>
        <p class="mt-4 max-w-2xl text-[17px] leading-relaxed text-muted">
            Your LegalEase account is active. Use the navigation to find a lawyer or manage your consultations.
        </p>

        <form method="POST" action="{{ route('logout') }}" class="mt-10">
            @csrf
            <button type="submit"
                    class="inline-flex items-center rounded-full border border-muted px-6 py-3 text-[14px] font-medium text-text transition-colors hover:border-accent hover:text-accent">
                Log out
            </button>
        </form>
    </section>
@endsection

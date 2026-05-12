@extends('layouts.app', ['title' => ($heading ?? 'Something went wrong') . ' · LegalEase'])

@section('content')
    <x-hero-bar :photo="$photo ?? ''" :eyebrow="$code ?? null">
        {{ $heading }}

        <x-slot:subtitle>{{ $body }}</x-slot:subtitle>

        @hasSection('actions')
            <x-slot:actions>@yield('actions')</x-slot:actions>
        @endif
    </x-hero-bar>
@endsection

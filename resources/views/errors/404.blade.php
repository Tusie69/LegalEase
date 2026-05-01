@extends('errors._layout', [
    'code'    => 'Error 404',
    'heading' => "We couldn't find that page",
    'body'    => 'The link may be broken or the page may have moved.',
    'photo'   => 'https://images.unsplash.com/photo-1433574466251-fe1be0d9b3d2?q=80',
])

@section('actions')
    <x-button variant="primary" :href="route('home')">Back to home</x-button>
@endsection

@extends('errors._layout', [
    'code'    => 'Lỗi 404',
    'heading' => "We couldn't find that page",
    'body'    => 'Liên kết có thể bị hỏng hoặc trang có thể đã được di chuyển.',
    'photo'   => 'https://images.unsplash.com/photo-1433574466251-fe1be0d9b3d2?q=80',
])

@section('actions')
    <x-button variant="primary" :href="route('home')">Trở về nhà</x-button>
@endsection

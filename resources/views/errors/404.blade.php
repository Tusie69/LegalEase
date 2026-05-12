@extends('errors._layout', [
    'heading' => "Không tìm thấy trang này",
    'body'    => 'Liên kết có thể bị hỏng hoặc trang có thể đã được di chuyển.',
])

@section('actions')
    <a href="{{ route('home') }}"
       class="inline-flex items-center justify-center rounded-full border border-bg bg-bg px-6 py-3 text-caption font-semibold text-accent transition-colors hover:border-accent">
        Trở về trang chủ
    </a>
@endsection

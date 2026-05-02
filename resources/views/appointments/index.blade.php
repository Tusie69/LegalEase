<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch hẹn của tôi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                <a class="btn brand" href="{{ route('dashboard') }}">Đặt lịch mới</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn light" type="submit">Đăng xuất</button>
                </form>
            </div>
        </header>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <section class="section">
            <div class="section-head">
                <h2>Lịch hẹn của tôi</h2>
                <span class="muted">Tổng: {{ $appointments->total() }}</span>
            </div>

            @if($appointments->isEmpty())
                <div class="empty">Bạn chưa có lịch hẹn nào. Quay lại trang chính để đặt lịch đầu tiên.</div>
            @else
                <div class="appointment-list">
                    @foreach($appointments as $appointment)
                        <article class="appointment-item">
                            <div>
                                <strong>{{ $appointment->lawyer->display_name }}</strong>
                                <div class="muted">{{ $appointment->lawyer->specialty }} - {{ $appointment->lawyer->location }}</div>
                                <div>
                                    {{ $appointment->appointment_start_at->format('d/m/Y H:i') }}
                                    -
                                    {{ $appointment->appointment_end_at->format('H:i') }}
                                </div>
                                <div class="muted">Mã lịch hẹn: {{ $appointment->booking_code }}</div>
                            </div>

                            <div class="actions">
                                <span class="status-pill {{ $appointment->status === 'CANCELLED' ? 'status-cancelled' : 'status-confirmed' }}">
                                    {{ $appointment->status_label }}
                                </span>

                                <a class="btn light" href="{{ route('appointments.confirmation', $appointment) }}">Chi tiết</a>

                                @if($appointment->status !== 'CANCELLED' && $appointment->appointment_start_at->là Tương lai())
                                    <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" onsubmit="return confirm('Bạn có chắc muốn hủy lịch hẹn này?')">
                                        @csrf
                                        <button class="btn danger" type="submit">Hủy lịch</button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="pagination">{{ $appointments->links() }}</div>
            @endif
        </section>
    </div>
</body>
</html>

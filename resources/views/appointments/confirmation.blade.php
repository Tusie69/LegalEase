<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận lịch hẹn</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                <a class="btn light" href="{{ route('appointments.index') }}">Lịch hẹn của tôi</a>
                <a class="btn light" href="{{ route('dashboard') }}">Đặt lịch khác</a>
            </div>
        </header>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <section class="panel">
            <h2>Lịch hẹn đã được xác nhận</h2>
            <p class="muted">Lịch của bạn đã được ghi nhận. Vui lòng lưu mã lịch hẹn để tiện hỗ trợ khi cần.</p>

            <div class="appointment-list">
                <article class="appointment-item">
                    <div>
                        <strong>Mã lịch hẹn</strong>
                        <div>{{ $appointment->booking_code }}</div>
                    </div>
                    <span class="status-pill status-confirmed">{{ $appointment->status_label }}</span>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Luật sư</strong>
                        <div>{{ $appointment->lawyer->display_name }} - {{ $appointment->lawyer->specialty }}</div>
                    </div>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Thời gian hẹn</strong>
                        <div>
                            {{ $appointment->appointment_start_at->format('d/m/Y H:i') }}
                            -
                            {{ $appointment->appointment_end_at->format('H:i') }}
                        </div>
                    </div>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Thông tin liên hệ</strong>
                        <div>{{ $appointment->customer_name }} - {{ $appointment->customer_phone }}</div>
                        <div>{{ $appointment->customer_email }}</div>
                    </div>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Tóm tắt vấn đề</strong>
                        <div>{{ $appointment->issue_summary ?: 'Không có ghi chú bổ sung.' }}</div>
                    </div>
                </article>
            </div>

            <div class="actions" style="margin-top: 14px;">
                <a class="btn brand" href="{{ route('appointments.index') }}">Quản lý lịch hẹn</a>
                <a class="btn light" href="{{ route('dashboard') }}">Về trang chính</a>
            </div>
        </section>
    </div>
</body>
</html>

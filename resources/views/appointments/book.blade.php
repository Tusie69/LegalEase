<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch hẹn</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                <a class="btn light" href="{{ route('dashboard') }}">Quay lại trang chính</a>
                <a class="btn light" href="{{ route('appointments.index') }}">Lịch hẹn của tôi</a>
            </div>
        </header>

        <section class="section">
            <div class="panel">
                <div class="lawyer-top">
                    <div class="avatar">{{ $lawyer->avatar_initials ?: 'LS' }}</div>
                    <div>
                        <h2 style="margin:0;">{{ $lawyer->display_name }}</h2>
                        <p class="muted" style="margin:4px 0;">{{ $lawyer->specialty }} - {{ $lawyer->location }}</p>
                        <p class="muted" style="margin:0;">
                            {{ $lawyer->experience_years }} năm kinh nghiệm |
                            {{ number_format((float) $lawyer->consultation_fee, 0, ',', '.') }} VND/buổi
                        </p>
                    </div>
                </div>

                <p class="lawyer-bio">{{ $lawyer->bio }}</p>
            </div>
        </section>

        <section class="section">
            <form class="panel" method="POST" action="{{ route('appointments.store', $lawyer) }}">
                @csrf
                <h2>Hoàn tất đặt lịch</h2>

                @if($errors->any())
                    <div class="alert error">Vui lòng kiểm tra lại thông tin và thử lại.</div>
                @endif

                <div class="field">
                    <label>Chọn khung giờ</label>
                    @if($availableSlots->isEmpty())
                        <div class="empty">Luật sư này hiện chưa có khung giờ trống trong vài ngày tới.</div>
                    @else
                        <div class="slot-grid">
                            @foreach($availableSlots as $slot)
                                <label class="slot-radio">
                                    <input type="radio" name="slot_id" value="{{ $slot->id }}" @checked((int) old('slot_id') === $slot->id)>
                                    <span>
                                        {{ $slot->start_at->format('d/m H:i') }}<br>
                                        <small>đến {{ $slot->end_at->format('H:i') }}</small>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @endif
                    @error('slot_id')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-grid">
                    <div class="field">
                        <label>Họ và tên</label>
                        <input
                            type="text"
                            name="customer_name"
                            value="{{ old('customer_name', $user->name ?? '') }}"
                            placeholder="Nhập họ và tên"
                        >
                        @error('customer_name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input
                            type="email"
                            name="customer_email"
                            value="{{ old('customer_email', $user->email ?? '') }}"
                            placeholder="tenban@example.com"
                        >
                        @error('customer_email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label>Số điện thoại</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="09xxxxxxxx">
                    @error('customer_phone')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label>Tóm tắt vấn đề (không bắt buộc)</label>
                    <textarea name="issue_summary" placeholder="Mô tả ngắn gọn vấn đề pháp lý của bạn...">{{ old('issue_summary') }}</textarea>
                    @error('issue_summary')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="actions">
                    <button
                        class="btn brand"
                        type="submit"
                        @disabled($availableSlots->isEmpty())
                    >
                        Xác nhận đặt lịch
                    </button>
                    <a class="btn light" href="{{ route('dashboard') }}">Hủy</a>
                </div>
            </form>
        </section>
    </div>
</body>
</html>

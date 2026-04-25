<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển đặt lịch LegalEase</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                @if((int) auth()->user()->role_id === 1)
                    <a class="btn light" href="{{ route('admin.index') }}">Trang quản trị</a>
                @endif
                <a class="btn light" href="{{ route('appointments.index') }}">Lịch hẹn của tôi</a>
                <span class="hello">Xin chào, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn light" type="submit">Đăng xuất</button>
                </form>
            </div>
        </header>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <section class="hero">
            <h1>Đặt lịch tư vấn pháp lý chỉ trong vài phút</h1>
            <p>Tìm luật sư phù hợp theo lĩnh vực và khu vực, sau đó chọn khung giờ trống đúng với lịch của bạn.</p>

            <form class="search-box" method="GET" action="{{ route('dashboard') }}">
                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm theo tên luật sư, chủ đề hoặc từ khóa"
                    value="{{ $filters['keyword'] }}"
                >

                <select name="specialty">
                    <option value="">Tất cả chuyên môn</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty }}" @selected($filters['specialty'] === $specialty)>
                            {{ $specialty }}
                        </option>
                    @endforeach
                </select>

                <select name="location">
                    <option value="">Tất cả khu vực</option>
                    @foreach($locations as $location)
                        <option value="{{ $location }}" @selected($filters['location'] === $location)>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>

                <button class="btn" type="submit">Tìm kiếm</button>
            </form>
        </section>

        <section class="section">
            <div class="section-head">
                <h2>Lịch hẹn sắp tới</h2>
                <a class="muted" href="{{ route('appointments.index') }}">Xem tất cả</a>
            </div>

            @if($upcomingAppointments->isEmpty())
                <div class="empty">Bạn chưa có lịch hẹn sắp tới. Hãy chọn luật sư bên dưới để bắt đầu đặt lịch.</div>
            @else
                <div class="appointment-list">
                    @foreach($upcomingAppointments as $appointment)
                        <article class="appointment-item">
                            <div>
                                <strong>{{ $appointment->lawyer->display_name }}</strong>
                                <div class="muted">{{ $appointment->lawyer->specialty }} - {{ $appointment->lawyer->location }}</div>
                                <div>
                                    {{ $appointment->appointment_start_at->format('d/m/Y H:i') }}
                                    -
                                    {{ $appointment->appointment_end_at->format('H:i') }}
                                </div>
                            </div>
                            <div class="actions">
                                <span class="status-pill status-confirmed">{{ $appointment->status_label }}</span>
                                <a class="btn light" href="{{ route('appointments.confirmation', $appointment) }}">Chi tiết</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="section">
            <div class="section-head">
                <h2>Luật sư đang có lịch trống</h2>
                <span class="muted">{{ $lawyers->total() }} kết quả</span>
            </div>

            @if($lawyers->isEmpty())
                <div class="empty">Không tìm thấy luật sư theo bộ lọc hiện tại. Hãy thử mở rộng tiêu chí tìm kiếm.</div>
            @else
                <div class="grid cards">
                    @foreach($lawyers as $lawyer)
                        <article class="card">
                            <div class="lawyer-top">
                                <div class="avatar">{{ $lawyer->avatar_initials ?: 'LS' }}</div>
                                <div>
                                    <h3 class="lawyer-name">{{ $lawyer->display_name }}</h3>
                                    <p class="lawyer-meta">{{ $lawyer->specialty }}</p>
                                    <p class="lawyer-meta">{{ $lawyer->location }} - {{ $lawyer->experience_years }} năm kinh nghiệm</p>
                                </div>
                            </div>

                            <p class="lawyer-bio">{{ $lawyer->bio }}</p>

                            <div class="chips">
                                <span class="chip">Đánh giá {{ number_format((float) $lawyer->rating, 1) }}/5</span>
                                <span class="chip">Phí {{ number_format((float) $lawyer->consultation_fee, 0, ',', '.') }} VND</span>
                                <span class="chip">{{ $lawyer->available_slots_count }} khung giờ trống</span>
                            </div>

                            <div class="actions">
                                <a class="btn brand" href="{{ route('appointments.book', $lawyer) }}">Đặt lịch hẹn</a>
                                @if($lawyer->timeSlots->isNotEmpty())
                                    <span class="muted">Gần nhất: {{ $lawyer->timeSlots->first()->start_at->format('d/m H:i') }}</span>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="pagination">{{ $lawyers->links() }}</div>
            @endif
        </section>
    </div>
</body>
</html>

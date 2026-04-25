<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giới thiệu phong cách Zocdoc</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap');

        :root {
            --bg: #f5f9ff;
            --surface: #ffffff;
            --ink: #10325d;
            --muted: #4a6588;
            --brand: #2d7ff9;
            --brand-strong: #145fd1;
            --lime: #d6fa5d;
            --border: #d8e5ff;
            --shadow: 0 18px 40px rgba(24, 70, 138, 0.12);
            --radius-lg: 26px;
            --radius-md: 16px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Manrope", "Segoe UI", sans-serif;
            background: radial-gradient(circle at 85% 10%, #e2efff 0%, var(--bg) 45%, #f7fbff 100%);
            color: var(--ink);
            line-height: 1.5;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .wrapper {
            width: min(1120px, 92vw);
            margin: 0 auto;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 0;
            gap: 20px;
        }

        .brand {
            font-family: "Space Grotesk", sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .brand span {
            color: var(--brand);
        }

        .nav-links {
            display: flex;
            gap: 22px;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .nav-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            border-radius: 999px;
            border: 1.5px solid transparent;
            padding: 11px 18px;
            font-weight: 700;
            font-size: 0.92rem;
            transition: transform .22s ease, box-shadow .22s ease, background-color .22s ease;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-light {
            border-color: var(--border);
            background: var(--surface);
            color: var(--ink);
        }

        .btn-brand {
            background: var(--brand);
            color: #fff;
            box-shadow: 0 10px 24px rgba(45, 127, 249, 0.3);
        }

        .hero {
            background: linear-gradient(135deg, #3188ff 0%, #2b6ce8 58%, #1c58c8 100%);
            border-radius: var(--radius-lg);
            padding: clamp(32px, 6vw, 56px);
            color: #f4f8ff;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            margin-top: 12px;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            opacity: .16;
            pointer-events: none;
        }

        .hero::before {
            width: 390px;
            height: 390px;
            background: #dce8ff;
            top: -160px;
            right: -130px;
        }

        .hero::after {
            width: 260px;
            height: 260px;
            background: #8ce5ff;
            left: -100px;
            bottom: -130px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        h1 {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(2rem, 5vw, 3.2rem);
            line-height: 1.08;
            letter-spacing: -0.02em;
            margin-bottom: 14px;
        }

        .hero p {
            color: #e4eeff;
            max-width: 48ch;
            margin-bottom: 26px;
        }

        .search-box {
            background: #fff;
            border-radius: 20px;
            padding: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 9px;
            max-width: 740px;
        }

        .search-box input {
            border: 1.5px solid #dde8fb;
            border-radius: 14px;
            padding: 13px 14px;
            font-family: inherit;
            outline: none;
            color: #12305b;
            font-weight: 600;
        }

        .search-box input:focus {
            border-color: #8cb7ff;
        }

        .search-box button {
            border: 0;
            border-radius: 14px;
            background: var(--lime);
            padding: 0 20px;
            font-weight: 800;
            color: #12325c;
            cursor: pointer;
        }

        .status-card {
            align-self: center;
            background: rgba(8, 37, 93, 0.33);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(196, 222, 255, 0.35);
            border-radius: 22px;
            padding: 20px;
        }

        .status-title {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #c8ddff;
            margin-bottom: 10px;
        }

        .stat-line {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            margin: 7px 0;
            border-bottom: 1px dashed rgba(206, 222, 255, 0.35);
            padding-bottom: 8px;
            color: #f6fbff;
        }

        .section {
            margin-top: 34px;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            gap: 20px;
        }

        .section-title {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(1.35rem, 2.8vw, 2rem);
            letter-spacing: -0.02em;
        }

        .subtle {
            color: var(--muted);
            font-weight: 600;
        }

        .chips {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .chip {
            border: 1.5px solid var(--border);
            background: var(--surface);
            border-radius: 999px;
            padding: 8px 13px;
            font-size: 0.88rem;
            font-weight: 700;
            color: #214c7f;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .card {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            padding: 18px;
            box-shadow: 0 8px 24px rgba(24, 70, 138, 0.06);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(24, 70, 138, 0.12);
        }

        .specialty-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eaf2ff;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .doctor-top {
            display: flex;
            gap: 11px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #3e90ff, #1d59cc);
            flex: 0 0 auto;
        }

        .doctor-meta {
            font-size: 0.88rem;
            color: var(--muted);
        }

        .doctor-meta strong {
            display: block;
            color: var(--ink);
            font-size: 1rem;
            margin-bottom: 2px;
        }

        .rating {
            font-weight: 800;
            color: #153a69;
            margin-bottom: 9px;
            font-size: 0.9rem;
        }

        .slot {
            border: 1.4px solid #bfdaff;
            background: #f4f8ff;
            color: #1c4b84;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 0.84rem;
            font-weight: 700;
            margin: 4px 0;
            display: inline-block;
        }

        .quote {
            font-size: 0.95rem;
            color: #204a7c;
            margin-bottom: 12px;
        }

        .author {
            font-size: 0.87rem;
            color: var(--muted);
            font-weight: 700;
        }

        .cta {
            margin: 34px 0 30px;
            background: linear-gradient(125deg, #0f3664 0%, #0a2c56 100%);
            color: #f2f8ff;
            border-radius: var(--radius-lg);
            padding: clamp(24px, 4vw, 38px);
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
        }

        .cta h2 {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(1.3rem, 3vw, 2rem);
            margin-bottom: 6px;
        }

        footer {
            padding: 8px 0 24px;
            color: #55739a;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .fade-up {
            animation: fadeUp .65s ease both;
        }

        .fade-up.delay {
            animation-delay: .14s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 960px) {
            .nav-links {
                display: none;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }

            .search-box {
                grid-template-columns: 1fr;
            }

            .grid-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-3 {
                grid-template-columns: 1fr 1fr;
            }

            .cta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 620px) {
            .nav-actions {
                display: none;
            }

            .grid-4,
            .grid-3 {
                grid-template-columns: 1fr;
            }

            .hero {
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="nav fade-up">
            <a href="#" class="brand">zoc<span>doc</span></a>
            <nav class="nav-links">
                <a href="#">Tìm bác sĩ</a>
                <a href="#">Chuyên khoa</a>
                <a href="#">Khám trực tuyến</a>
                <a href="#">Bảo hiểm</a>
            </nav>
            <div class="nav-actions">
                <a class="btn btn-light" href="#">Đăng nhập</a>
                <a class="btn btn-brand" href="#">Đăng ký</a>
            </div>
        </header>

        <section class="hero fade-up delay">
            <div class="hero-grid">
                <div>
                    <h1>Đặt lịch bác sĩ uy tín trực tuyến ngay lập tức</h1>
                    <p>Tìm theo chuyên khoa, bảo hiểm và khu vực để chọn lịch hẹn phù hợp với thời gian của bạn. Không cần chờ máy, không rườm rà giấy tờ.</p>
                    <form class="search-box">
                        <input type="text" placeholder="Chuyên khoa, triệu chứng, dịch vụ">
                        <input type="text" placeholder="Thành phố hoặc mã ZIP">
                        <button type="button">Tìm khám</button>
                    </form>
                </div>

                <aside class="status-card">
                    <div class="status-title">Hôm nay trên nền tảng</div>
                    <div class="stat-line"><span>Bác sĩ đang trực</span><span>12,300+</span></div>
                    <div class="stat-line"><span>Lịch đã đặt</span><span>48,901</span></div>
                    <div class="stat-line"><span>Thời gian chờ trung bình</span><span>&lt; 24h</span></div>
                    <div class="stat-line" style="border-bottom:0;padding-bottom:0;"><span>Mức hài lòng bệnh nhân</span><span>4.8/5</span></div>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Chuyên khoa phổ biến</h2>
                <p class="subtle">Duyệt bác sĩ theo nhóm chăm sóc được tìm nhiều</p>
            </div>
            <div class="grid grid-4">
                <article class="card">
                    <div class="specialty-icon">NK</div>
                    <h3>Nha khoa</h3>
                    <p class="subtle">2,100+ bác sĩ đã xác minh</p>
                </article>
                <article class="card">
                    <div class="specialty-icon">QT</div>
                    <h3>Nội tổng quát</h3>
                    <p class="subtle">Khám trong ngày và cuối tuần</p>
                </article>
                <article class="card">
                    <div class="specialty-icon">MT</div>
                    <h3>Mắt</h3>
                    <p class="subtle">Khám thị lực và tư vấn kính áp tròng</p>
                </article>
                <article class="card">
                    <div class="specialty-icon">TL</div>
                    <h3>Tâm lý trị liệu</h3>
                    <p class="subtle">Tư vấn trực tiếp hoặc qua video</p>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Lịch trống trong tuần</h2>
                <div class="chips">
                    <span class="chip">Aetna</span>
                    <span class="chip">Blue Cross</span>
                    <span class="chip">Cigna</span>
                </div>
            </div>

            <div class="grid grid-3">
                <article class="card">
                    <div class="doctor-top">
                        <div class="avatar">AS</div>
                        <div class="doctor-meta">
                            <strong>Dr. Amy Stone</strong>
                            Y học gia đình
                        </div>
                    </div>
                    <div class="rating">★ 4.9 · 320 đánh giá</div>
                    <span class="slot">Hôm nay · 3:15 PM</span>
                    <span class="slot">Ngày mai · 10:30 AM</span>
                </article>
                <article class="card">
                    <div class="doctor-top">
                        <div class="avatar">JR</div>
                        <div class="doctor-meta">
                            <strong>Dr. John Reed</strong>
                            Da liễu
                        </div>
                    </div>
                    <div class="rating">★ 4.8 · 281 đánh giá</div>
                    <span class="slot">Hôm nay · 5:00 PM</span>
                    <span class="slot">Thứ 6 · 9:40 AM</span>
                </article>
                <article class="card">
                    <div class="doctor-top">
                        <div class="avatar">LM</div>
                        <div class="doctor-meta">
                            <strong>Dr. Lila Monroe</strong>
                            Tâm thần học
                        </div>
                    </div>
                    <div class="rating">★ 4.9 · 410 đánh giá</div>
                    <span class="slot">Ngày mai · 11:20 AM</span>
                    <span class="slot">Thứ 7 · 1:00 PM</span>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Khách hàng nói gì</h2>
            </div>
            <div class="grid grid-3">
                <article class="card">
                    <p class="quote">"Tôi đặt lịch chưa tới hai phút và được khám ngay trong chiều."</p>
                    <p class="author">- Melissa, New York</p>
                </article>
                <article class="card">
                    <p class="quote">"Bộ lọc bảo hiểm giúp tôi không phải gọi cho 6 phòng khám khác nhau."</p>
                    <p class="author">- David, Austin</p>
                </article>
                <article class="card">
                    <p class="quote">"Từ lúc đặt lịch tới khi check-in đều mượt mà và rõ ràng."</p>
                    <p class="author">- Alina, Seattle</p>
                </article>
            </div>
        </section>

        <section class="cta">
            <div>
                <h2>Hành trình chăm sóc sức khỏe bắt đầu từ đây</h2>
                <p>Tìm bác sĩ bạn tin tưởng và đặt lịch bất cứ lúc nào thuận tiện cho bạn.</p>
            </div>
            <a class="btn btn-brand" href="#">Bắt đầu ngay</a>
        </section>

        <footer>
            Lấy cảm hứng từ phong cách giao diện zocdoc.com, dựng lại bằng HTML/CSS thuần cho mục đích demo.
        </footer>
    </div>
</body>
</html>


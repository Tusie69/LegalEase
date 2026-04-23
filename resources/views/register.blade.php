<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-register">
    <main class="auth-shell">
        <section class="auth-grid auth-register-single">
            <section class="auth-form-wrap">
                <div class="brand">
                    <img class="logo-img" src="{{ asset('images/logo2.png') }}" alt="Logo">
                </div>

                <h1 class="auth-title">Đăng Ký</h1>
                <p class="auth-subtitle">Tiếp cận dịch vụ pháp lý chuyên nghiệp, đặt lịch tư vấn và quản lý nhu cầu pháp lý của bạn một cách dễ dàng.</p>

                <form method="POST" action="{{ route('register.store') }}" novalidate>
                    @csrf

                    <fieldset class="field {{ $errors->has('name') ? 'error' : '' }}">
                        <legend>Họ và tên</legend>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nguyen Van A">
                    </fieldset>
                    @error('name')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <fieldset class="field {{ $errors->has('email') ? 'error' : '' }}">
                        <legend>Email</legend>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nguyenvanA@gmail.com">
                    </fieldset>
                    @error('email')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <fieldset class="field {{ $errors->has('password') ? 'error' : '' }}">
                        <legend>Mật khẩu</legend>
                        <div class="password-wrap">
                            <input id="register-password" type="password" name="password" placeholder="************">
                            <button type="button" data-toggle-password="#register-password" aria-label="Toggle password">&#128065;</button>
                        </div>
                    </fieldset>
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <fieldset class="field">
                        <legend>Xác nhận Mật khẩu</legend>
                        <div class="password-wrap">
                            <input id="register-password-confirmation" type="password" name="password_confirmation" placeholder="************">
                            <button type="button" data-toggle-password="#register-password-confirmation" aria-label="Toggle confirm password">&#128065;</button>
                        </div>
                    </fieldset>

                    <div class="meta-row" style="justify-content:flex-start;">
                        <label class="checkbox">
                            <input type="checkbox" checked>
                            <span>Tôi đồng ý với mọi <a class="link-accent" href="#">Điều khoản</a> và <a class="link-accent" href="#">các chính sách bảo mật</a></span>
                        </label>
                    </div>

                    <button class="btn-primary" type="submit">Tạo tài khoản</button>

                    <p class="switch-text">
                        Đã có sẵn tài khoản?
                        <a class="link-accent" href="{{ route('login') }}">Đăng nhập</a>
                    </p>

                    <div class="divider">Hoặc đăng ký với</div>
                    <div class="social-row">
                        <a class="social-btn" href="{{'https://www.facebook.com/login/?locale=en_GB'}}" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a class="social-btn" href="{{'https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&dsh=S1191699130%3A1776422531923068&emr=1&ltmpl=default&ltmplcache=2&osid=1&passive=true&rm=false&scc=1&service=mail&ss=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin&ifkv=AT1y2_W85w6bmRvq0z6L5t0OlVJBIauAHwzqLhtEC4JbK_bqLIRJvoEE33-pHBG5GFmQvbWj-_Fu4A'}}" aria-label="Google"><i class="fa-brands fa-google"></i></a>
                        <a class="social-btn" href="{{'https://account.apple.com/sign-in'}}" aria-label="Apple"><i class="fa-brands fa-apple"></i></a>
                    </div>
                </form>
            </section>
        </section>
    </main>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.querySelector(btn.dataset.togglePassword);
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });
    </script>
</body>
</html>

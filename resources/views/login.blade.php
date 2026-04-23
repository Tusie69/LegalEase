<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-login">
    <main class="auth-shell">
        <section class="auth-grid auth-login-single">
            <section class="auth-form-wrap">
                <div class="brand">
                    <img class="logo-img" src="{{ asset('images/logo2.png') }}" alt="Logo">
                </div>

                <h1 class="auth-title">Đăng Nhập</h1>
                <p class="auth-subtitle">Đăng nhập để truy cập tài khoản của bạn</p>

                <form method="POST" action="{{ route('login.store') }}" novalidate>
                    @csrf

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
                            <input id="password" type="password" name="password" placeholder="************">
                            <button type="button" data-toggle-password="#password" aria-label="Toggle password">&#128065;</button>
                        </div>
                    </fieldset>
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <div class="meta-row">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" value="1">
                            <span>Nhớ tài khoản</span>
                        </label>
                        <a class="link-accent" href="#">Quên mật khẩu</a>
                    </div>

                    <button class="btn-primary" type="submit">Đăng nhập</button>

                    <p class="switch-text">
                        Chưa có tài khoản?
                        <a class="link-accent" href="{{ route('register') }}">Đăng ký</a>
                    </p>

                    <div class="divider">Hoặc đăng nhập với</div>
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

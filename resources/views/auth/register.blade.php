<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <style>
        body {
            background: #f3f4f6;
            font-family: sans-serif;
            padding: 40px;
        }

        .form-box {
            max-width: 500px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .required {
            color: red;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        .error {
            font-size: 13px;
            height: 18px;
            margin-bottom: 10px;
        }

        .error.visible {
            color: red;
            visibility: visible;
        }

        .error.invisible {
            visibility: hidden;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        button {
            background: #2563eb;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input::placeholder {
            color: #999;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="form-box">
        <h2>Đăng ký tài khoản</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->has('register_error'))
            <div class="alert-error">
                {{-- {{ $errors->first('register_error') }} --}}
                {{-- sử dụng component alert --}}
                <x-alert-success :message="$errors->first('register_error')" />
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Họ --}}
            <div>
                <label for="first_name">Họ <span class="required">*</span></label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" maxlength="30"
                    placeholder="Họ">
                <div class="error {{ $errors->has('first_name') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('first_name') }}
                </div>
            </div>

            {{-- Tên --}}
            <div>
                <label for="last_name">Tên <span class="required">*</span></label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Tên">
                <div class="error {{ $errors->has('last_name') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('last_name') }}
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label for="email">Email <span class="required">*</span></label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                <div class="error {{ $errors->has('email') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('email') }}
                </div>
            </div>

            {{-- Mật khẩu --}}
            <div>
                <label for="password">Mật khẩu <span class="required">*</span></label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu">
                <div class="error {{ $errors->has('password') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('password') }}
                </div>
            </div>

            {{-- Xác nhận mật khẩu --}}
            <div>
                <label for="password_confirmation">Nhập lại mật khẩu <span class="required">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Nhập lại mật khẩu">
                <div class="error {{ $errors->has('password_confirmation') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('password_confirmation') }}
                </div>
            </div>

            <button type="submit">Đăng ký</button>
        </form>

        {{-- Link chuyển sang trang đăng nhập --}}
        <div class="login-link">
            <span>Bạn đã có tài khoản? </span>
            <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </div>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
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

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
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

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="form-box">
        <h2>Đăng nhập</h2>

        {{-- @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif --}}
        @if ($errors->has('account_status'))
            <div class="alert-error">
                {{ $errors->first('account_status') }}
            </div>
        @endif

        {{-- @if(session('success'))
        <div class="success">{{ session('success') }}</div>
        @endif --}}

        {{-- sử dụng blade component: --}}
        {{-- @if (session('success'))
        <x-alert-success :message="session('success')" />
        @endif --}}
        @if (session('success'))
            <x-alert-success :message="session('success')" />
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                <div class="error {{ $errors->has('email') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('email') }}
                </div>
            </div>

            <div>
                <label for="password">Mật khẩu <span class="required">*</span></label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu">
                <div class="error {{ $errors->has('password') ? 'visible' : 'invisible' }}">
                    {{ $errors->first('password') }}
                </div>
            </div>

            <button type="submit">Đăng nhập</button>
        </form>

        <div class="register-link">
            <span>Chưa có tài khoản? </span>
            <a href="{{ route('register') }}">Đăng ký ngay</a>
        </div>
    </div>
</body>

</html>
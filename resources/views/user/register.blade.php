<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>
    <link rel="icon" type="image/png" href="/image/Artboard 1.svg">
    <link rel="stylesheet" href="/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="/css/admin.css" />
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-box">
            <h2>ثبت نام کاربر جدید</h2>
            @session('fail')
                <div class="alert alert-danger">{{ $value }}</div>
            @endsession
            <form action="{{ route('submit.register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" placeholder="نام کامل" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="mobile" name="mobile" placeholder="شماره" value="{{ old('mobile') }}">
                    @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="رمز عبور">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور">
                </div>

                <button type="submit" class="btn-auth">ثبت نام</button>

                <p class="auth-link">
                    حساب دارید؟
                    <a href="{{ route('user.login') }}">ورود</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>

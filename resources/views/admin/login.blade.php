<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود ادمین</title>
    <link rel="icon" type="image/png" href="/image/Artboard 1.svg">
    <link rel="stylesheet" href="/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="/css/admin.css" />
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-box">
            <h2>ورود به پنل مدیریت</h2>
            @session('success')
                <div class="alert alert-success">{{ $value }}</div>
            @endsession
            @session('fail')
                <div class="alert alert-danger">{{ $value }}</div>
            @endsession
            <form action="{{ route('admin.submit.login') }}" method="POST">
                @csrf

               

                <div class="form-group">
                    <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="رمز عبور">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <small><a class="nav-link" href="">فراموشی رمز عبور</a></small>

                <button type="submit" class="btn-auth">ورود</button>

                
            </form>
        </div>
    </div>



</body>

</html>

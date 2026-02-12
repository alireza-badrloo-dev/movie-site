@extends('layouts.master')
@section('MyContent')
    <!-- محتوای درباره ما -->
    <div class="about-page-container">

        <!-- عنوان صفحه -->
        <div class="about-header">
            <h1>درباره ما</h1>
            <p>ویرا فیلم، مرجع دانلود سریال و فیلم‌های روز دنیا با دوبله و زیرنویس فارسی</p>
        </div>

        <!-- بخش معرفی -->
        <div class="about-content">

            <div class="">
                <img src="image/Artboard 1.svg" style="width: 100px; height: 100px;" alt="درباره ویرا فیلم">
            </div>
            <div class="about-text">
                <h2>ماموریت ما</h2>
                <p>ما در ویرا فیلم تلاش می‌کنیم بهترین تجربه تماشای فیلم و سریال را برای کاربران ایرانی فراهم کنیم.</p>

                <h2>چرا ویرا فیلم؟</h2>
                <p>ما اهمیت زیادی به کیفیت، دوبله فارسی و زیرنویس حرفه‌ای می‌دهیم و همیشه آخرین نسخه‌های BluRay و WebDL
                    را ارائه می‌کنیم.</p>


            </div>
        </div>

        <!-- فرم نظرات -->
        <div class="comment-section">
            <h2>نظرات و پیشنهادات</h2>

            <form action="{{ route('feedback.submit') }}" method="POST">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                @if (@session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (@session('fail'))
                    <div class="alert alert-danger">{{ session('fail') }}</div>
                @endif
                <input type="text" name="name" id="name" placeholder="نام و نام خانوادگی" required value="{{ old('name') }}">
                <input type="email" name="email" id="email" placeholder="ایمیل شما" required value="{{ old('email') }}">
                <textarea placeholder="نظر شما..." id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                @csrf
                <button type="submit">ارسال نظر</button>
            </form>
        </div>

    </div>
@endsection

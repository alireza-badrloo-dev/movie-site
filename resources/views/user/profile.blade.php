@extends('layouts.master')

@section('MyContent')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">اطلاعات کاربری</h5>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">نام کاربر</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شماره تلفن </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->mobile }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تاریخ عضویت</label>
                        <input type="text" class="form-control"
                               value="{{ jdate(auth()->user()->created_at)->format('Y/m/d') }}" disabled>
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('user.logout') }}" class="btn btn-outline-danger btn-sm">
                        خروج از حساب
                    </a>
                    <span class="text-muted small">
                        👤 حساب کاربری
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

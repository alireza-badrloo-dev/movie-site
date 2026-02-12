@extends('admin.layouts.master')
@section('Content')
    @session('fail')
        <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
    @endsession
    <div class="container p-4">
        <form action="{{ route('admin.store') }}" method="POST">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="mb-3">
                        <label for="name" class="form-lable">نام و نام خانوادگی</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                            placeholder="*" autocomplete="off" required>
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-lable">پست الکترونیکی</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                            placeholder="*" autocomplete="off" required>
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-lable">شماره تلفن</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobie') }}"
                            placeholder="*" autocomplete="off" required>
                        @error('mobile')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-lable">رمزعبور</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="*"
                            autocomplete="off" required>
                        @error('password')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-lable">رمزعبور</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                            placeholder="*" autocomplete="off" required>
                    </div>
                </div>
                <div class="card-footer d-md-block d-grid gap-2">
                    @csrf
                    <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ثبت">
                    <a class="btn btn-danger" href="{{ route('admin.admin') }}">بازگشت</a>
                </div>
            </div>
        </form>
    </div>


@endsection

@extends('admin.layouts.master')
@section('Content')
    @session('fail')
        <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
    @endsession
    <div class="container p-4">
        <div class="card shadow-sm">
            <div class="card-body">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label fw-bold">نام کاربری</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="*" disabled
                                value="{{ old('name') ?? $user->name }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label fw-bold">ایمیل کاربر</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="*"
                                disabled value="{{ old('email') ?? $user->email }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="ip" class="form-label fw-bold">ip کاربر</label>
                            <input type="text" class="form-control" name="ip" id="ip" placeholder="*"
                                disabled value="{{ old('ip') ?? $user->ip }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="mobile" class="form-label fw-bold">شماره تلفن کاربر</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="*"
                                disabled value="{{ old('mobile') ?? $user->mobile }}" autocomplete="off">
                        </div>
                    </div>












                    <div class="card-footer d-md-block d-grid gap-2">
                        <a class="btn btn-danger" href="{{ route('admin.users') }}">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.master')
@section('Content')
    <div class="container p-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.feedback.update', $feedback->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label fw-bold">نام کاربر</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="*" disabled
                                value="{{ old('name') ?? $feedback->name }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="ip" class="form-label fw-bold">ip کاربر</label>
                            <input type="text" class="form-control" name="ip" id="ip" placeholder="*"
                                disabled value="{{ old('name') ?? $feedback->ip }}" autocomplete="off">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label fw-bold">متن نظر</label>
                        <textarea class="form-control" name="message" id="message" rows="6" placeholder="*" autocomplete="off" disabled>{{ old('message') ?? $feedback->message }}</textarea>
                    </div>

                    
                    

                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="status" value="1"
                            {{ $feedback->status ? 'checked' : '' }}>

                        <label class="form-check-label">
                            تأیید بازدید
                        </label>
                    </div>

                    <div class="card-footer d-md-block d-grid gap-2">
                        @csrf
                        <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ثبت">
                        <a class="btn btn-danger" href="{{ route('admin.feedback') }}">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

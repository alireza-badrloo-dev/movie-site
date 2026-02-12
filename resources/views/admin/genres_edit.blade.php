@extends('admin.layouts.master')
@section('Content')
    @session('fail')
        <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
    @endsession
    <div class="container p-4">
        <form action="{{ route('admin.genre.update' , $genre->id) }}" method="POST">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="mb-3">
                        <label for="title" class="form-lable">عنوان ژانر</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ old('title') ?? $genre->title }}" placeholder="*" autocomplete="off" required>
                        @error('title')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-lable">ژانر</label>
                        <input type="text" class="form-control" name="slug" id="slug"
                            value="{{ old('slug') ?? $genre->slug }}" placeholder="*" autocomplete="off" required>
                        @error('slug')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1"
                        {{ old('status', $gentre->status ?? 0) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        نمایش در سایت
                    </label>
                </div>

                </div>
                <div class="card-footer d-md-block d-grid gap-2">
                    @csrf
                    <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ثبت">
                    <a class="btn btn-danger" href="{{ route('admin.genre') }}">بازگشت</a>
                </div>

                
            </div>
        </form>
    </div>


@endsection

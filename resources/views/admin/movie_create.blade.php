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
                <form action="{{ route('admin.movie.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="title_fa" class="form-label fw-bold">عنوان(فارسی):</label>
                            <input type="text" class="form-control" name="title_fa" id="title_fa" placeholder="*"
                                value="{{ old('title_fa') }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="title_en" class="form-label fw-bold">عنوان(اینگلیسی):</label>
                            <input type="text" class="form-control" name="title_en" id="title_en" placeholder="*"
                                value="{{ old('title_en') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label fw-bold">خلاصه:</label>
                        <textarea class="form-control" name="summary" id="summary" rows="6" placeholder="*" autocomplete="off" required>{{ old('summary') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="main_file" class="form-label">فایل اصلی فیلم</label>
                        <input type="file" class="form-control" name="main_file" id="main_file" accept="video/*">
                    </div>

                    <div class="mb-3">
                        <label for="poster" class="form-label fw-bold">تصویر</label>
                        <input type="file" class="form-control" name="poster" id="poster" accept=".png , .jpg"
                            required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-2">
                            <label for="year" class="form-label fw-bold">سال تولید</label>
                            <input type="text" class="form-control" name="year" id="year" placeholder="*"
                                value="{{ old('year') }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="country" class="form-label fw-bold">کشور سازنده</label>
                            <input type="text" class="form-control" name="country" id="country" placeholder="*"
                                value="{{ old('country') }}" autocomplete="off">
                        </div>

                        <div class="col-12 col-md-2">
                            <label for="type" class="form-label fw-bold">نوع</label>
                            <select class="form-select" name="type" id="type">
                                <option value="movie">movie</option>
                                <option value="series">series</option>
                                <option value="animation">animation</option>
                                <option value="documentary">documentary</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="imdb_rate" class="form-label fw-bold">نمره imdb</label>
                            <input type="text" class="form-control" name="imdb_rate" id="imdb_rate" placeholder="*"
                                value="{{ old('imdb_rate') }}" autocomplete="off">
                        </div>

                        <div class="col-12 col-md-3">
                            <label for="duration" class="form-label fw-bold">مدت زمان </label>
                            <input type="text" class="form-control" name="duration" id="duration" placeholder="*"
                                value="{{ old('duration') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-12 col-md-3">
                            <label for="director" class="form-label fw-bold">کارگردان</label>
                            <input type="text" class="form-control" name="director" id="director" placeholder="*"
                                value="{{ old('director') }}" autocomplete="off">
                        </div>

                        <div class="col-12 col-md-7">
                            <label for="actors" class="form-label fw-bold">بازیگران</label>
                            <input type="text" class="form-control" name="actors" id="actors" placeholder="*"
                                value="{{ old('actors') }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="is_special" class="form-label">آیا این فیلم ویژه باشد؟</label>
                            <select class="form-select" id="is_special" name="is_special">
                                <option value="0">خیر</option>
                                <option value="1">بله</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label fw-bold d-block">ژانرها</label>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_subtitle" value="1"
                                    {{ old('has_subtitle') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    دارای زیرنویس فارسی
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_dub" value="1"
                                    {{ old('has_dub') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    دارای دوبله فارسی
                                </label>
                            </div>
                        </div>
                    </div>



                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">ژانرها</label>

                        <div class="row">
                            @foreach ($genres as $genre)
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="genres[]"
                                            value="{{ $genre->id }}" id="genre_{{ $genre->id }}"
                                            {{ collect(old('genres'))->contains($genre->id) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="genre_{{ $genre->id }}">
                                            {{ $genre->slug }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <div class="card-footer d-md-block d-grid gap-2">
                        @csrf
                        <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ثبت">
                        <a class="btn btn-danger" href="{{ route('admin.movie') }}">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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
                            <label for="title_fa" class="form-label fw-bold">عنوان(فارسی):</label>
                            <input type="text" class="form-control" name="title_fa" id="title_fa" placeholder="*"
                                disabled value="{{ old('title_fa') ?? $movie->title_fa }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="title_en" class="form-label fw-bold">عنوان(اینگلیسی):</label>
                            <input type="text" class="form-control" name="title_en" id="title_en" placeholder="*"
                                disabled value="{{ old('title_en') ?? $movie->title_en }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label fw-bold">خلاصه:</label>
                        <textarea class="form-control" name="summary" id="summary" rows="6" placeholder="*" autocomplete="off" disabled>{{ old('summary') ?? $movie->summary }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label fw-bold">تصویر</label>
                        
                        @if (isset($movie) && $movie->poster)
                            <strong class="d-block mt-2 text-white">
                                تصویر فعلی: {{ $movie->poster }}
                            </strong>
                            
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">فایل فیلم</label>
                       

                        @if (isset($movie) && $movie->main_file)
                            <strong class="d-block mt-2 text-white">
                                فایل فعلی: {{ $movie->main_file }}
                            </strong>
                           
                        @endif
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-2">
                            <label for="year" class="form-label fw-bold">سال تولید</label>
                            <input type="text" class="form-control" name="year" id="year" placeholder="*"
                                disabled value="{{ old('year') ?? $movie->year }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="country" class="form-label fw-bold">کشور سازنده</label>
                            <input type="text" class="form-control" name="country" id="country" placeholder="*"
                                disabled value="{{ old('country') ?? $movie->country }}" autocomplete="off">
                        </div>

                        <div class="col-12 col-md-2">
                            <label for="type" class="form-label fw-bold">نوع</label>
                            <select class="form-select" name="type" id="type">
                                @php
                                    $selectedType = old('type', $movie->type);
                                @endphp

                                <option value="movie" {{ $selectedType == 'movie' ? 'selected' : '' }}>movie</option>
                                <option value="series" {{ $selectedType == 'series' ? 'selected' : '' }}>series</option>
                                <option value="animation" {{ $selectedType == 'animation' ? 'selected' : '' }}>animation
                                </option>
                                <option value="documentary" {{ $selectedType == 'documentary' ? 'selected' : '' }}>
                                    documentary</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="imdb_rate" class="form-label fw-bold">نمره imdb</label>
                            <input type="text" class="form-control" name="imdb_rate" id="imdb_rate" placeholder="*"
                                disabled value="{{ old('imdb_rate') ?? $movie->imdb_rate }}" autocomplete="off">
                        </div>

                        <div class="col-12 col-md-3">
                            <label for="duration" class="form-label fw-bold">مدت زمان </label>
                            <input type="text" class="form-control" name="duration" id="duration" placeholder="*"
                                disabled value="{{ old('duration') ?? $movie->duration }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-12 col-md-3">
                            <label for="director" class="form-label fw-bold">کارگردان</label>
                            <input type="text" class="form-control" name="director" id="director" placeholder="*"
                                disabled value="{{ old('director') ?? $movie->director }}" autocomplete="off">
                        </div>

                        <div class="col-12 col-md-7">
                            <label for="actors" class="form-label fw-bold">بازیگران</label>
                            <input type="text" class="form-control" name="actors" id="actors" placeholder="*"
                                disabled value="{{ old('actors') ?? $movie->actors }}" autocomplete="off">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="is_special" class="form-label">آیا این فیلم ویژه باشد؟</label>
                            <select class="form-select" id="is_special" name="is_special" disabled>
                                <option>{{ $movie->is_special ? 'بله' : 'خیر' }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">نسخه‌ها</label>

                        @if ($movie->has_subtitle || $movie->has_dub)
                            <ul class="list-unstyled mb-0">
                                @if ($movie->has_subtitle)
                                    <li>
                                        <span class="badge bg-secondary p-2">
                                            دارای زیرنویس فارسی
                                        </span>
                                    </li>
                                @endif

                                @if ($movie->has_dub)
                                    <li>
                                        <span class="badge bg-secondary p-2">
                                            دارای دوبله فارسی
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        @else
                            <span>نسخه‌ای برای این فیلم ثبت نشده</span>
                        @endif
                    </div>


                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">ژانرها</label>

                        @if ($movie->genres->count())
                            @foreach ($movie->genres as $genre)
                                <div class="d-inline">
                                    <span class="badge bg-secondary p-2">
                                        {{ $genre->slug }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <span>ژانری ثبت نشده</span>
                        @endif
                    </div>


                    <div class="card-footer d-md-block d-grid gap-2">
                        <a class="btn btn-danger" href="{{ route('admin.movie') }}">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

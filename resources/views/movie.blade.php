@extends('layouts.master')
@section('MyContent')
    <x-slider />
    <div class="col-12 col-lg-8  ">

        <article class="card shadow-sm  border-0">
            <div class="row p-4">

                <!-- تصویر -->
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <figure class="image-figure">
                        <img src="/image/{{ $data->poster }}" alt="" class="image-content w-100 img-fluid">
                    </figure>
                </div>


                <!-- اطلاعات -->
                <div class="col-12 col-md-8">
                    <div class="mb-4">
                        <h6>
                            <a href="" class="nav-link">
                                {{ $data->title_fa }}{{ $data->title_en }}
                            </a>
                        </h6>
                    </div>

                    <!-- نسخه‌ها -->
                    <div class="movie-versions mb-3">

                        @if ($data->has_subtitle)
                            <span class="version version-subtitle">
                                <img src="/image/svgexport-10.svg" width="22">
                                زیرنویس فارسی
                            </span>
                        @endif

                        @if ($data->has_dub)
                            <span class="version version-dub">
                                <img src="/image/svgexport-9.svg" width="22">
                                دوبله فارسی
                            </span>
                        @endif

                    </div>



                    {{-- سال انتشار --}}
                    @if (!empty($data->year))
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/calendar-event.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">سال انتشار :</span>
                            {{ $data->year }}
                        </p>
                        <br>
                    @endif

                    {{-- امتیاز IMDB --}}
                    @if (!empty($data->imdb_rate))
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/clipboard-data.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">IMDB امتیاز :</span>
                            {{ $data->imdb_rate }}
                        </p>
                        <br>
                    @endif

                    {{-- ژانر --}}
                    @if ($data->genres && $data->genres->count())
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/masks-theater-solid.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">ژانر :</span>

                            @foreach ($data->genres as $genre)
                                <a href="{{ route('genre.show', $genre->id) }}" class="me-1 text-decoration-none"
                                    style="color:#717171;font-size:13px;">
                                    {{ $genre->slug }}
                                </a>
                                @if (!$loop->last)
                                    ،
                                @endif
                            @endforeach
                        </p>
                        <br>
                    @endif

                    {{-- کشور --}}
                    @if (!empty($data->country))
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/geo-alt.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">محصول :</span>
                            {{ $data->country }}
                        </p>
                        <br>
                    @endif

                    {{-- کارگردان --}}
                    @if (!empty($data->director))
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/person-video.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">کارگردان :</span>
                            {{ $data->director }}
                        </p>
                        <br>
                    @endif

                    {{-- بازیگران --}}
                    @if (!empty($data->actors))
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/star.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">ستارگان :</span>
                            {{ $data->actors }}
                        </p>
                        <br>
                    @endif

                    {{-- مدت زمان --}}
                    @if (!empty($data->duration))
                        <p class="d-inline-block" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/stopwatch.svg" width="16">
                            <span class="me-1" style="font-size:14px;color:#212121;">مدت زمان :</span>
                            {{ $data->duration }}
                        </p>
                    @endif

                </div>
                <div class="col-12 mt-3">
                    <p style="font-size:12px;color:#212121;">
                        <img class="me-1" src="/image/newspaper-regular.svg" width="20">
                        {{ $data->summary }}
                    </p>
                </div>

                <!-- پایین کارت -->
                <div
                    class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mt-2">

                    <div>
                        <div class="d-flex align-items-center ">
                            <span class="d-flex align-items-center me-2" style="font-size:10px;font-weight:700;">
                                <img class="me-1" src="/image/calendar-event.svg">
                                {{ $date = jdate($data->created_at) }}
                            </span>
                            <span class="d-flex align-items-center me-2" style="font-size:10px;font-weight:700;">
                                <img class="me-1"
                                    src="/image/chat-left-dots.svg">{{ $data->comments->count() > 0 ? $data->comments->count() . ' دیدگاه' : 'بدون دیدگاه' }}
                            </span>
                        </div>


                    </div>





                </div>

                <div class="col-12 mt-4">

                    <h6 class="mb-3 fw-bold">لینک‌های دانلود</h6>


                    <a href="{{ route('movie.download', $data->id) }}">دانلود فیلم</a>





                    <!-- نظرات -->
                    <div class="col-12 mt-4">
                        <div class="comment-section">
                            <h6 class="section-title">نظرات کاربران</h6>

                            <form class="comment-form" action="{{ route('comment') }}" method="POST">
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
                                <input type="hidden" name="movie_id" value="{{ $data->id }}">
                                <input type="text" name="name" id="name" placeholder="نام شما">
                                <textarea placeholder="نظر شما..." name="message" id="message" rows="5"></textarea>
                                @csrf
                                <button type="submit">ثبت نظر</button>
                            </form>

                            @forelse ($data->comments as $comment)
                                <div class="comment-item">
                                    <strong>{{ $comment->name }}</strong>
                                    <p class="mt-2">{{ $comment->message }}</p>
                                </div>
                                @if ($comment->admin_reply)
                                    <div class="comment-item ">
                                        <div class="ms-3 px-2" style="border-right: solid 1px rgb(49, 49, 226)">
                                            <strong class="text-primary  ">پاسخ ادمین</strong>
                                            <p>{{ $comment->admin_reply }}</p>
                                        </div>

                                    </div>
                                @endif

                            @empty
                                <hr>
                                <p class="text-center text-muted mt-3">هیچ نظری ثبت نشده است.</p>
                            @endforelse


                        </div>
                    </div>



                </div>
        </article>


    </div>
    <x-leftside />
@endsection

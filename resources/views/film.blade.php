@extends('layouts.master')
@section('MyContent')
    <x-slider />
    <div class="col-12 col-lg-8 ">
        <div class="card  shadow-sm  rounded rounded-2 border-0 p-3">
            <h6 class="text-center my-2">{{ $title ?? 'دانلود فیلم' }}</h4>
        </div>

        @forelse ($film as $item)
            <article class="card shadow-sm mt-3 border-0 ">

                <div class="row p-4">

                    <!-- تصویر -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <figure class="image-figure">
                            <img src="/image/{{ $item->poster }}" alt="{{ $item->title_fa }}"
                                class="image-custom w-100 img-fluid">
                        </figure>
                    </div>

                    <!-- اطلاعات -->
                    <div class="col-12 col-md-8">

                        <div class="mb-4">
                            <h6>
                                <a href="{{ route('movie', $item->id) }}" class="nav-link">
                                    {{ $item->title_fa }}
                                    @if ($item->title_en)
                                        <small class="text-muted">({{ $item->title_en }})</small>
                                    @endif
                                </a>
                            </h6>
                        </div>

                        <!-- نسخه‌ها -->
                        <div class="movie-versions mb-3">

                            @if ($item->has_subtitle)
                                <span class="version version-subtitle">
                                    <img src="/image/svgexport-10.svg" width="22">
                                    زیرنویس فارسی
                                </span>
                            @endif

                            @if ($item->has_dub)
                                <span class="version version-dub">
                                    <img src="/image/svgexport-9.svg" width="22">
                                    دوبله فارسی
                                </span>
                            @endif

                        </div>


                        <!-- سال -->
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/calendar-event.svg" width="16">
                            <span style="font-size:14px;color:#212121;">سال انتشار:</span>
                            {{ $item->year }}
                        </p><br>

                        <!-- IMDB -->
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/clipboard-data.svg" width="16">
                            <span style="font-size:14px;color:#212121;">IMDB:</span>
                            {{ $item->imdb_rate ?? '-' }}
                        </p><br>

                        <!-- ژانر -->
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/masks-theater-solid.svg" width="16">
                            <span style="font-size:14px;color:#212121;">ژانر:</span>

                            @foreach ($item->genres as $g)
                                <a href="{{ route('genre.show', $g->slug) }}" class="me-1 text-decoration-none"
                                    style="color:#717171;font-size:13px;">
                                    {{ $g->title }}
                                </a>
                                @if (!$loop->last)
                                    ،
                                @endif
                            @endforeach
                        </p><br>

                        <!-- کشور -->
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/geo-alt.svg" width="16">
                            <span style="font-size:14px;color:#212121;">محصول:</span>
                            {{ $item->country }}
                        </p><br>

                        <!-- کارگردان -->
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/person-video.svg" width="16">
                            <span style="font-size:14px;color:#212121;">کارگردان:</span>
                            {{ $item->director }}
                        </p><br>

                        <!-- بازیگران -->
                        <p class="d-inline-block mb-2" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/star.svg" width="16">
                            <span style="font-size:14px;color:#212121;">ستارگان:</span>
                            {{ $item->actors }}
                        </p><br>

                        <!-- مدت -->
                        <p class="d-inline-block" style="font-size:12px;color:#717171;">
                            <img class="me-1" src="/image/stopwatch.svg" width="16">
                            <span style="font-size:14px;color:#212121;">مدت:</span>
                            {{ $item->duration }}
                        </p>
                    </div>

                    <!-- خلاصه -->
                    <div class="col-12 mt-3">
                        <p style="font-size:12px;color:#212121;">
                            <img class="me-1" src="/image/newspaper-regular.svg" width="20">
                            {{ $item->summary }}
                        </p>
                    </div>

                    <!-- پایین کارت -->
                    <div
                        class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-2">

                        <div class="d-flex align-items-center">
                            <span class="me-3" style="font-size:10px;font-weight:700;">
                                {{ jdate($item->created_at)->format('Y/m/d') }}
                            </span>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="bg-primary py-2 px-4 rounded-4">
                                <a class="text-white nav-link d-flex align-items-center justify-content-center"
                                    style="font-size:12px;" href="{{ route('movie', $item->id) }}">

                                    <span style="font-size: 14px; margin-left: 6px">ادامه و دانلود</span>

                                    <img src="/image/download-01-svgrepo-com.svg" alt="" width="20"
                                        height="20">
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

            </article>

        @empty
            <div class="alert alert-danger text-center mt-4">
                هیچ فیلمی برای نمایش وجود ندارد
            </div>
        @endforelse
        <div class="mt-4">
            {{ $film->links() }}
        </div>
    </div>


    <x-leftside />
@endsection

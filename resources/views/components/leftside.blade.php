<div class="col-12 col-lg-4 ">
    <a href="#" class="nav-link">
        <div class="d-flex align-items-center justify-content-between px-3 rounded rounded-2"
            style="background-color: #0489ef;">
            <div class="text-white mt-3">
                <h6>کانال تلگرام ما را دنبال کنید</h6>
                <p style="font-size: 12px;">ویرا فیلم</p>
            </div>
            <img src="/image/telegram-svgrepo-com.svg" style="width: 48px; height: 48px;" alt="">
        </div>
    </a>
    <a href="#" class="nav-link mt-2">
        <div class="d-flex align-items-center justify-content-between px-3 rounded rounded-2"
            style="background-color: #47ef04;">
            <div class="text-white mt-3">
                <h6>دانلود اپلیکیشن ویرا فیلم</h6>
                <p style="font-size: 12px;">ویرا فیلم</p>
            </div>
            <img src="/image/icons8-android (2).svg" alt="">
        </div>
    </a>

    <div class="right-side card shadow-sm mt-3 border-0 sidebar-box">

        <!-- هدر سایدبار -->
        <div class="sidebar-header d-flex align-items-center">
            <div class="sidebar-icon bg-success rounded-circle d-flex align-items-center justify-content-center"
                style="width: 50px; height:50px;">
                <img src="\image\movie-svgrepo-com.svg" alt="" width="32" height="32">
            </div>
            <h5 class="mb-0 ms-2">ژانر ها</h5>
        </div>

        <!-- لیست ژانرها -->
        <ul class="genre-grid fancy">
            @foreach ($genres as $genre)
                <li>
                    <a href="{{ route('genre.show', $genre->slug) }}">{{ $genre->title }}</a>
                    <span class="badge quality-web">{{ $genre->movies_count }}</span>
                </li>
            @endforeach
        </ul>


    </div>


    <div class="right-side card shadow-sm mt-3 border-0 sidebar-box">

        <!-- هدر -->
        <div class="sidebar-header d-flex align-items-center">
            <div class="sidebar-icon bg-success rounded-circle d-flex align-items-center justify-content-center"
                style="width: 50px; height:50px;">
                <img src="\image\theatre-masks-svgrepo-com (1).svg" alt="" width="32" height="32">
            </div>
            <h5 class="mb-0 ms-2">آخرین فیلم‌های خارجی</h5>
        </div>


        <!-- لیست -->
        <ul class="latest-movies fancy">
            @foreach ($latestForeign as $movie)
                <li>
                    <a href="{{ route('movie', $movie->id) }}">{{ $movie->title_fa }} </a>
                    <svg class="movie-icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">



                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                            stroke-width="0.192"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M3 3h18v18H3V3zm2 2v2h2V5H5zm4 0v6h6V5H9zm8 0v2h2V5h-2zm2 4h-2v2h2V9zm0 4h-2v2h2v-2zm0 4h-2v2h2v-2zm-4 2v-6H9v6h6zm-8 0v-2H5v2h2zm-2-4h2v-2H5v2zm0-4h2V9H5v2z"
                                ></path>
                        </g>



                        <path d="..." />
                    </svg>
                </li>
            @endforeach

        </ul>

    </div>

    <div class="right-side card shadow-sm mt-3 border-0 sidebar-box">

        <!-- هدر -->
        <div class="sidebar-header d-flex align-items-center">
            <div class="sidebar-icon bg-success rounded-circle d-flex align-items-center justify-content-center"
                style="width: 50px; height:50px;">
                <img src="\image\theatre-masks-svgrepo-com (1).svg" alt="" width="32" height="32">
            </div>
            <h5 class="mb-0 ms-2">آخرین فیلم‌های ایرانی</h5>
        </div>

        <!-- لیست -->
        <ul class="latest-movies fancy">

            @foreach ($latestIranian as $movie)
                <li class="latest-movie-item">
                    <a href="{{ route('movie', $movie->id) }}">
                        {{ $movie->title_fa }} {{ $movie->year }}
                    </a>

                    <svg class="movie-icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">



                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                            stroke-width="0.192"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M3 3h18v18H3V3zm2 2v2h2V5H5zm4 0v6h6V5H9zm8 0v2h2V5h-2zm2 4h-2v2h2V9zm0 4h-2v2h2v-2zm0 4h-2v2h2v-2zm-4 2v-6H9v6h6zm-8 0v-2H5v2h2zm-2-4h2v-2H5v2zm0-4h2V9H5v2z"
                                ></path>
                        </g>



                        <path d="..." />
                    </svg>
                </li>
            @endforeach




        </ul>

    </div>

</div>

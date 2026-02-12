<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'ویرا فیلم' }}</title>
    <link rel="icon" type="image/png" href="/image/Artboard 1.svg">
    <link rel="stylesheet" href="/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="/bootstrap-icons-v1.13.1/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/style.css" />


</head>

<body>

    <nav class="navbar navbar-expand-lg shadow " style="background-color: white;">
        <div class="container px-md-5">
            <!-- لوگو -->
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}" class="text-dark pe-2">
                    <img src="/image/Artboard 1.svg" alt="#" width="28px" height="28px">
                    <path
                        d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z" />
                    </svg>
                </a>
                <div style="font-size: 10px;">
                    <a class="text-dark nav-link" href="{{ route('home') }}"> <span
                            class="text-primary d-flex justify-content-center"
                            style="font-size: 14px; font-weight: 500;">ویرا
                            فیلم</span>

                        دانلود رایگان فیلم و سریال
                    </a>
                </div>
            </div>

            <!-- دکمه همبرگری -->
            <button class="navbar-toggler text-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="custom-toggler-icon">
                    <path d="M3 6h18M3 12h18M3 18h18" stroke="#0d6efd" stroke-width="2" />
                </svg>
            </button>

            <!-- آیتم‌های منو -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto" style="font-size: 14px">
                    <li class="nav-item dropdown mx-2 ">
                        <a href="#" class="nav-link dropdown-toggle custom-link no-arrow "
                            data-bs-toggle="dropdown">
                            دانلود فیلم
                        </a>

                        <ul class="dropdown-menu beautiful-dropdown">
                            <li><a class="dropdown-item" href="{{ route('ForeignShow') }}">دانلود فیلم خارجی</a></li>
                            <li><a class="dropdown-item" href="{{ route('IranianShow') }}">دانلود فیلم ایرانی</a></li>
                            <li><a class="dropdown-item" href="#">250 فیلم برتر IMDB</a></li>
                            <li><a class="dropdown-item" href="#">برترین کالکشن‌ها</a></li>
                        </ul>
                    </li>

                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a href="" class="nav-link dropdown-toggle custom-link no-arrow"
                            data-bs-toggle="dropdown">
                            دانلود سریال
                        </a>

                        <ul class="dropdown-menu beautiful-dropdown">
                            <li><a class="dropdown-item" href="{{ route('Foreignserials.show') }}">دانلود سریال
                                    خارجی</a></li>
                            <li><a class="dropdown-item" href="{{ route('Iranianserials.show') }}">دانلود سریال
                                    ایرانی</a></li>

                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ route('Animation.show') }}" class="nav-link custom-link">دانلود انیمیشن</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="{{ route('Documentary.show') }}" class="nav-link custom-link ">دانلود مستند</a>
                    </li>
                    <li class="nav-item mx-2 ">
                        <a href="{{ route('feedback') }}" class="nav-link custom-link ">درباره ما</a>
                    </li>

                </ul>



                <!-- فرم جستجو -->
                <form class="d-flex mt-3 mt-lg-0" role="search" method="GET" action="{{ route('search') }}">
                    <input class="form-control form-control-sm me-2" type="search" name="q"
                        placeholder="نام فیلم یا سریال..." value="{{ request('q') }}">
                    <button class="btn btn-sm btn-outline-primary" type="submit">
                        جستجو
                    </button>

                </form>

                <div class="d-flex align-items-center "> <a href="{{ route('user.login') }}"
                        class="nav-link custom-link ms-md-5 ">
                        @if (auth()->check())
                            <div class="dropdown m-2 ">
                                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center no-arrow"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <small class="custom-link">{{ auth()->user()->name }}<i
                                            class="bi bi-person-circle mx-1 "></i></small>

                                </a>

                                <ul class="dropdown-menu beautiful-dropdown ">


                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                                            <i class="bi bi-person ms-2"></i>
                                            اطلاعات کاربری
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-danger " href="{{ route('user.logout') }}">
                                            <i class="bi bi-box-arrow-right ms-2"></i>
                                            خروج
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class=" btn btn-primary btn-sm shadow text-white "> ورود / ثبت نام</div>
                        @endif


                    </a>
                </div>
            </div>



        </div>
    </nav>





    <div class="container mt-3 px-md-5">
        <div class="row g-4">
            @yield('MyContent')
        </div>
    </div>






    <footer class="site-footer mt-5">
        <div class="container px-md-5">
            <div class="row gy-4">

                <!-- درباره سایت -->
                <div class="col-12 col-md-4">
                    <h6 class="footer-title">درباره سایت</h6>
                    <p class="footer-text">
                        این سایت مرجع دانلود فیلم و سریال‌های روز دنیا با دوبله فارسی و کیفیت‌های متنوع می‌باشد.
                        هدف ما ارائه محتوای سالم و با کیفیت برای کاربران است.
                    </p>
                </div>

                <!-- لینک‌های سریع -->
                <div class="col-6 col-md-4">
                    <h6 class="footer-title">دسترسی سریع</h6>
                    <ul class="footer-links">
                        <li><a href="#">صفحه اصلی</a></li>
                        <li><a href="#">دانلود فیلم</a></li>
                        <li><a href="#">دانلود سریال</a></li>
                        <li><a href="#">تماس با ما</a></li>
                    </ul>
                </div>

                <!-- ژانرها -->
                <div class="col-6 col-md-4">
                    <h6 class="footer-title">ژانرها</h6>
                    <ul class="footer-links">
                        <li><a href="#">اکشن</a></li>
                        <li><a href="#">جنایی</a></li>
                        <li><a href="#">درام</a></li>
                        <li><a href="#">تخیلی</a></li>
                    </ul>
                </div>

            </div>
            <div class="footer-social mt-3">

                <!-- Telegram -->
                <a href="#" class="social-icon telegram" aria-label="Telegram">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M9.04 15.44 8.7 19.2c.49 0 .7-.21.96-.46l2.3-2.19 4.77 3.49c.87.48 1.5.23 1.72-.8L21.9 4.8c.29-1.28-.46-1.78-1.28-1.47L2.8 10.1c-1.21.47-1.19 1.15-.22 1.45l4.56 1.42L17.7 6.4c.5-.33.95-.15.58.18z" />
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="#" class="social-icon instagram" aria-label="Instagram">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 5a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm6.5-.9a1.1 1.1 0 1 0 1.1 1.1 1.1 1.1 0 0 0-1.1-1.1z" />
                    </svg>
                </a>

                <!-- Twitter (X) -->
                <a href="#" class="social-icon twitter" aria-label="Twitter">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M22.46 6c-.77.35-1.6.58-2.46.69a4.27 4.27 0 0 0 1.88-2.36 8.49 8.49 0 0 1-2.7 1.03A4.24 4.24 0 0 0 12 8.3a12 12 0 0 1-8.72-4.42 4.24 4.24 0 0 0 1.31 5.66 4.2 4.2 0 0 1-1.92-.53v.05a4.24 4.24 0 0 0 3.4 4.16 4.2 4.2 0 0 1-1.91.07 4.24 4.24 0 0 0 3.96 2.95A8.5 8.5 0 0 1 2 18.58 12 12 0 0 0 8.29 20c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.36-.01-.54A8.4 8.4 0 0 0 22.46 6z" />
                    </svg>
                </a>

                <!-- YouTube -->
                <a href="#" class="social-icon youtube" aria-label="YouTube">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6a3 3 0 0 0-2.1 2.1A31.3 31.3 0 0 0 0 12a31.3 31.3 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.3 31.3 0 0 0 24 12a31.3 31.3 0 0 0-.5-5.8zM9.5 15.5v-7l6 3.5z" />
                    </svg>
                </a>

            </div>

            <!-- کپی‌رایت -->
            <div class="footer-bottom mt-4">
                <span>© 2025 تمامی حقوق محفوظ است</span>
                <span class="footer-brand">ViraMovie</span>
            </div>
        </div>
    </footer>



    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll(".download-toggle").forEach(btn => {
            btn.addEventListener("click", () => {
                const box = btn.parentElement;
                box.classList.toggle("active");
            });
        });
    </script>
</body>

</html>

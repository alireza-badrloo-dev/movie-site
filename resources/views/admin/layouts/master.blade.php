<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? env('APP_TITLE') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="/bootstrap-icons-v1.13.1/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/admin.css" />
</head>

<body>

    <!-- نوار بالایی موبایل با دکمه همبرگری -->
    <nav class="d-md-none navbar  px-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
            aria-controls="mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-brand">پنل مدیریت</span>
    </nav>

    <!-- offcanvas منوی موبایل -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileSidebarLabel">پنل مدیریت</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="sidebar d-flex flex-column">
                <a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door me-2"></i>داشبورد</a>
                <a href="{{ route('admin.admin') }}"><i class="bi bi-person me-2"></i>مدیران سایت</a>
                <a href="{{ route('admin.users') }}"><i class="bi bi-people-fill me-2"></i>کاربران سایت</a>
                <a href="{{ route('admin.movie') }}" class="position-relative">
                    <i class="bi bi-camera-video me-2"></i>
                    فیلم ها
                    @if (isset($pendingMoviesCount) && $pendingMoviesCount > 0)
                        <span class="blink-dot"></span>
                    @endif
                </a>
                <a href="{{ route('admin.genre') }}"><i class="bi bi-film me-2"></i>ژانر ها</a>
                <a href="{{ route('admin.feedback') }}" class="position-relative">
                    <i class="bi bi-chat-dots me-2"></i>
                    پیشنهادات
                    @if (isset($pendingFeedbacksCount) && $pendingFeedbacksCount > 0)
                        <span class="blink-dot"></span>
                    @endif
                </a>
                <a href="{{ route('admin.comment') }}" class="position-relative">
                    <i class="bi bi-chat-dots me-2"></i>
                    نظرات
                    @if (isset($pendingCommentsCount) && $pendingCommentsCount > 0)
                        <span class="blink-dot"></span>
                    @endif
                </a>

                <a href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right me-2"></i>خروج</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- سایدبار ثابت برای دسکتاپ -->
            <div class="d-none d-md-block col-md-2 sidebar position-fixed h-100">
                <h5 class="mb-4 text-center" style="color: #ffffff;">پنل مدیریت</h5>
                <hr>
                <a href="{{ route('admin.dashboard') }}" class="@if (Route::currentRouteName() == 'admin.dashboard') active @endif"><i
                        class="bi bi-house-door me-2"></i>داشبورد</a>
                <a href="{{ route('admin.admin') }}" class="@if (Route::currentRouteName() == 'admin.admin') active @endif"><i
                        class="bi bi-person me-2"></i>مدیران سایت</a>
                <a href="{{ route('admin.users') }}" class="@if (Route::currentRouteName() == 'admin.users') active @endif"><i
                        class="bi bi-people-fill me-2"></i>کاربران سایت</a>
                <a href="{{ route('admin.movie') }}"
                    class="{{ Route::currentRouteName() == 'admin.movie' ? 'active' : '' }}">
                    <i class="bi bi-camera-video  me-2"></i>
                    فیلم ها
                    @if (isset($pendingMoviesCount) && $pendingMoviesCount > 0)
                        <span class="blink-dot"></span>
                    @endif
                </a>
                <a href="{{ route('admin.genre') }}" class="@if (Route::currentRouteName() == 'admin.genre') active @endif"><i
                        class="bi bi-film me-2"></i>ژانرها</a>
                <a href="{{ route('admin.feedback') }}"
                    class="{{ Route::currentRouteName() == 'admin.feedback' ? 'active' : '' }}">
                    <i class="bi bi-chat-quote me-2"></i>
                    پیشنهادات
                    @if (isset($pendingFeedbacksCount) && $pendingFeedbacksCount > 0)
                        <span class="blink-dot"></span>
                    @endif
                </a>
                <a href="{{ route('admin.comment') }}"
                    class="{{ Route::currentRouteName() == 'admin.comment' ? 'active' : '' }}">
                    <i class="bi bi-chat-dots me-2"></i>
                    نظرات
                    @if (isset($pendingCommentsCount) && $pendingCommentsCount > 0)
                        <span class="blink-dot"></span>
                    @endif
                </a>


                <a href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right me-2"></i>خروج</a>
            </div>

            <!-- محتوای اصلی، با فاصله از سایدبار در دسکتاپ -->
            <div class="col-12 col-md-10 ms-md-auto p-0">
                <div class="topbar d-flex justify-content-between align-items-center p-2  border-bottom">
                    <h4 class="m-0"><i class="{{ $icon ?? '' }} me-2"></i>{{ $title ?? '' }}</h4>
                    <span class="text-white">
                        مدیر: {{ auth()->user()->name ?? 'نامشخص' }}
                    </span>
                </div>


                @yield('Content')




            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>

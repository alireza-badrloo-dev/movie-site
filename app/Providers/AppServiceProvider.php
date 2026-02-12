<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Movie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('admin.*', function ($view) {
            $pendingCommentsCount = Comment::where('status', 0)->count();
            $pendingFeedbacksCount = Feedback::where('status', 0)->count();
            $pendingMoviesCount = Movie::where('status', 0)->count();

            $view->with([
                'pendingCommentsCount' => $pendingCommentsCount,
                'pendingFeedbacksCount' => $pendingFeedbacksCount,
                'pendingMoviesCount' => $pendingMoviesCount,
            ]);
        });
    }
}

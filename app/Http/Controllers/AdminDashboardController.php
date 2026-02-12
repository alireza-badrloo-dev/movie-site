<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        $user = User::all();
        $movie = Movie::all();
        $gener = Genre::all();
        $comment = Comment::all();

        $pendingCommentsCount = Comment::where('status', 0)->count();
         $pendingMoviesCount = Movie::where('status', 0)->count();
          $pendingFeedbacksCount = Feedback::where('status', 0)->count();
           $pendingCommentsCount = Comment::where('status', 0)->count();


        



        return view('admin.dashboard', compact('movie', 'gener', 'comment', 'user','pendingCommentsCount', 'pendingMoviesCount', 'pendingFeedbacksCount','pendingCommentsCount'), [
            'title' => 'داشبورد',
            'icon' => 'bi bi-house-door',

            'moviesCount'       => Movie::count(),
            'newMoviesThisMonth' => Movie::whereMonth('created_at', now()->month)->count(),
            'pendingComments' => Comment::where('status', 'pending')->get(),
            'latestComments' => Comment::with('movie')->latest()->limit(5)->get(),
            'topMovies' => Movie::withCount('comments')->orderBy('comments_count', 'desc')->limit(5)->get()
        ]);
    }
}

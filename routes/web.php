<?php

use App\Exports\AdminsExport;
use App\Exports\MoviesExport;
use App\Exports\UsersExport;
use App\Http\Controllers\AdminCommentsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\AdminGenresController;
use App\Http\Controllers\AdminMoviesController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AnimationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentaryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SerialsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [HomeController::class, "index"])->name('home');

Route::get('/feedback', [FeedbackController::class, "showfeedback"])->name('feedback');
Route::post('/feedback', [FeedbackController::class, "submitfeedback"])->name('feedback.submit');

Route::get('/movie/{id}', [MovieController::class, 'find'])->name('movie');
Route::post('/movie/comment', [MovieController::class, 'submitcomment'])->name('comment');
Route::get('/ForeignFilm', [MovieController::class, 'ForeignShow'])->name('ForeignShow');
Route::get('/IranianFilm', [MovieController::class, 'IranianShow'])->name('IranianShow');
Route::get('/movie/download/{id}', [MovieController::class, 'download'])->name('movie.download');



Route::get('/genre/{genre:slug}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/Foreignserials', [SerialsController::class, 'ForeignShow'])->name('Foreignserials.show');
Route::get('/Iranianserials', [SerialsController::class, 'IranianShow'])->name('Iranianserials.show');

Route::get('/Animation', AnimationController::class)->name('Animation.show');

Route::get('/Documentary', DocumentaryController::class)->name('Documentary.show');


Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/admin/login', [AuthController::class, 'login'])->middleware('guest:admin')->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'submit'])->name('admin.submit.login');


Route::get('/login', [UserController::class, 'index'])->name('user.login');
Route::post('/login', [UserController::class, 'submit'])->name('user.submit.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');


Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_submit'])->name('submit.register');




Route::prefix('/admin')->middleware('auth:admin')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', AdminDashboardController::class)->name('admin.dashboard');

    Route::get('/comments', [AdminCommentsController::class, 'index'])->name('admin.comment');
    Route::get('/comments/{id}/edit', [AdminCommentsController::class, 'edit'])->name('admin.comment.edit');
    Route::post('/comments/{id}/edit', [AdminCommentsController::class, 'update'])->name('admin.comment.update');
    Route::get('/comments/{id}/destroy', [AdminCommentsController::class, 'destroy'])->name('admin.comment.destroy');

    Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])->name('admin.feedback');
    Route::get('/feedbacks/{id}/edit', [AdminFeedbackController::class, 'edit'])->name('admin.feedback.edit');
    Route::post('/feedbacks/{id}/edit', [AdminFeedbackController::class, 'update'])->name('admin.feedback.update');
    Route::get('/feedbacks/{id}/destroy', [AdminFeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admin');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admins/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admins/{id}/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admins/{id}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/admins/export', function () {
        return Excel::download(new AdminsExport, 'admins.xlsx');
    })->name('admin.admins.export');


    Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/show', [AdminUsersController::class, 'show'])->name('admin.user.show');
    Route::get('/users/{id}/destroy', [AdminUsersController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/admin/users/export', function () {
        return Excel::download(new UsersExport, 'users.xlsx');
    })->name('admin.users.export');

    Route::get('/movies', [AdminMoviesController::class, 'index'])->name('admin.movie');
    Route::get('/movies/create', [AdminMoviesController::class, 'create'])->name('admin.movie.create');
    Route::post('/movies/create', [AdminMoviesController::class, 'store'])->name('admin.movie.store');
    Route::get('/movies/{id}/show', [AdminMoviesController::class, 'show'])->name('admin.movie.show');
    Route::get('/movies/{id}/edit', [AdminMoviesController::class, 'edit'])->name('admin.movie.edit');
    Route::post('/movies/{id}/edit', [AdminMoviesController::class, 'update'])->name('admin.movie.update');
    Route::get('/movies/{id}/destroy', [AdminMoviesController::class, 'destroy'])->name('admin.movie.destroy');
    Route::get('/admin/movies/export', function () {
        return Excel::download(new MoviesExport, 'movies.xlsx');
    })->name('admin.movies.export');

    Route::get('/genres', [AdminGenresController::class, 'index'])->name('admin.genre');
    Route::get('/genres/create', [AdminGenresController::class, 'create'])->name('admin.genre.create');
    Route::post('/genres/create', [AdminGenresController::class, 'store'])->name('admin.genre.store');
    Route::get('/genres/{id}/edit', [AdminGenresController::class, 'edit'])->name('admin.genre.edit');
    Route::post('/genres/{id}/edit', [AdminGenresController::class, 'update'])->name('admin.genre.update');
    Route::get('/genres/{id}/destroy', [AdminGenresController::class, 'destroy'])->name('admin.genre.destroy');
});

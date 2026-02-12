@extends('admin.layouts.master')
@section('Content')
    <div class="container-fluid p-3">
        <div class="row g-4 mb-4">
            <!-- کارت‌ها -->
            <div class="col-12 col-md-3">
                <div class="card shadow-sm p-3 bg-primary text-white">
                    <h6 class="card-title"><i class="bi bi-film"></i> تعداد فیلم‌ها</h6>
                    <p class="fs-4">{{ $moviesCount }}</p>
                    
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card shadow-sm p-3 bg-success text-white">
                    <h6 class="card-title"><i class="bi bi-collection"></i> تعداد ژانرها</h6>
                    <p class="fs-4">{{ $gener->count() }}</p>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card shadow-sm p-3 bg-warning text-dark">
                    <h6 class="card-title"><i class="bi bi-chat-left-text"></i> نظرات در انتظار تایید</h6>
                    <p class="fs-4">{{ $pendingComments->count() }}</p>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card shadow-sm p-3 bg-info text-white">
                    <h6 class="card-title"><i class="bi bi-people-fill"></i> کاربران</h6>
                    <p class="fs-4">{{ $user->count() }}</p>
                </div>
            </div>
        </div>

        <!-- آخرین نظرات -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card shadow-sm p-3">
                    <h6 class="card-title"><i class="bi bi-chat-dots"></i> آخرین نظرات</h6>
                    <ul class="list-group list-group-flush">
                        @foreach ($latestComments as $comment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $comment->user_name }} روی فیلم "{{ $comment->movie->title_fa }}"</span>
                                <span class="badge bg-{{ $comment->status == 'pending' ? 'warning' : 'success' }}">
                                    {{ $comment->status }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- محبوب‌ترین فیلم‌ها -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm p-3">
                    <h6 class="card-title"><i class="bi bi-star-fill"></i> محبوب‌ترین فیلم‌ها</h6>
                    <ol class="list-group list-group-numbered">
                        @foreach ($topMovies as $movie)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $movie->title_fa }}
                                <span class="badge bg-primary rounded-pill">{{ $movie->comments_count }} نظر</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        
    </div>
@endsection

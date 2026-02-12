@extends('admin.layouts.master')
@section('Content')
    @session('success')
        <div class="alert alert-success shadow-sm m-2">{{ session('success') }}</div>
    @endsession
    @session('fail')
        <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
    @endsession
    <div class="container-fluid p-3">
        <h5 class="mb-3"> لیست  نظرات</h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered shadow-sm">
                <thead>
                    <tr>
                        <th>نام</th>
                        <th>نظر</th>
                        <th>زمان</th>
                        <th>شناسه فیلم</th>
                        <th>وضعیت</th>
                        <th>توسط</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($comments as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->message }}</td>
                            <td>{{ $date = jdate($item->created_at) }}</td>
                            <td>
                                <a href="/movie/{{ $item->movie_id }}" class="text-info" target="_blank">
                                    {{ $item->movie->title_fa }}
                                </a>
                            </td>
                            <td>
                                <div class="{{ $item->status ? 'text-success' : 'text-danger' }}">
                                    {{ $item->status ? 'دیده شده' : 'بررسی شود' }}</div>
                            </td>
                            <td class="p-2">
                                @if ($item->admin)
                                <button class="btn btn-primary btn small">{{ $item->admin->name }}</button>
                                    
                                @else
                                    <span class="text-muted">بازدید نشده</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1"> <a href="{{ route('admin.comment.edit', $item->id) }}"
                                        class="btn btn-secondary btn-sm"><i class="bi bi-info-square"></i></a>
                                    <a href="{{ route('admin.comment.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('آیا از حذف این فیلم مطمئن هستید؟')"><i
                                            class="bi bi-trash"></i></a>
                                </div>

                            </td>
                        </tr>
                    @empty
                    @endforelse


                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $comments->links() }}
        </div>
    </div>
@endsection

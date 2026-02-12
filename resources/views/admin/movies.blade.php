@extends('admin.layouts.master')
@section('Content')
    <div class="container-fluid p-3">

        @session('success')
            <div class="alert alert-success shadow-sm m-2">{{ session('success') }}</div>
        @endsession
        @session('fail')
            <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
        @endsession

        <div class="mb-3">
            <a href="{{ route('admin.movie.create') }}" class="btn btn-primary">افزودن فیلم جدید</a>
        </div>

        <div class="table-responsive ">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">لیست فیلم ها</h5>

                <a href="{{ route('admin.movies.export') }}" class="text-success fs-5" title="خروجی اکسل">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                </a>
            </div>
            <table class="table table-hover table-striped table-bordered shadow-sm ">
                <thead>
                    <tr>
                        <th>شناسه فیلم</th>
                        <th>عنوان فیلم</th>
                        <th>ژانرها</th>
                        <th>تاریخ</th>
                        <th>وضعیت</th>
                        <th>توسط</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movies as $item)
                        <tr>
                            <td class="p-2">{{ $item->id }}</td>
                            <td class="p-2">{{ $item->title_fa }} {{ $item->title_en }}</td>
                            <td class="p-2">
                                @forelse ($item->genres as $genre)
                                    {{ $genre->slug }}@if (!$loop->last)
                                        ،
                                    @endif
                                @empty
                                    -
                                @endforelse
                            </td>
                            <td class="p-2">{{ jdate($item->created_at) }}</td>
                            <td class="p-2">
                                <div class="{{ $item->status ? 'text-success' : 'text-danger' }}">
                                    {{ $item->status ? 'قرار گرفته' : 'بررسی شود' }}</div>
                            </td>
                            <td class="p-2">
                                @if ($item->admin)
                                <button class="btn btn-primary btn small">{{ $item->admin->name }}</button>
                                    
                                @else
                                    <span class="text-muted">بازدید نشده</span>
                                @endif
                            </td>
                            <td class="p-2">
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('admin.movie.show', $item->id) }}"
                                        class="btn btn-secondary btn-sm "><i class="bi bi-info-square"></i></a>
                                    <a href="{{ route('admin.movie.edit', $item->id) }}" class="btn btn-primary btn-sm "><i
                                            class="bi bi-pencil-square "></i></a>
                                    <a href="{{ route('admin.movie.destroy', $item->id) }}" class="btn btn-danger  btn-sm"
                                        onclick="return confirm('آیا از حذف این فیلم مطمئن هستید؟')"><i
                                            class="bi bi-trash"></i></a>

                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">هیچ فیلمی موجود نیست</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $movies->links() }}
        </div>
    </div>

@endsection

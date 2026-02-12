@extends('admin.layouts.master')
@section('Content')
    @session('success')
        <div class="alert alert-success shadow-sm m-2">{{ session('success') }}</div>
    @endsession
    @session('fail')
        <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
    @endsession
    <div class="container-fluid p-3">
        <h5 class="mb-3"> لیست ژانر ها</h5>
         <div class="mb-3">
            <a href="{{ route('admin.genre.create') }}" class="btn btn-primary">افزودن ژانر جدید</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered shadow-sm">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>ژانر</th>
                        <th>عنوان</th>
                        <th>توسط</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($genres as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->title }}</td>


                            <td class="p-2">
                                @if ($item->admin_id)
                                <button class="btn btn-primary btn small">{{ $item->admin->name }}</button>
                                    
                                @else
                                    <span class="text-muted">بازدید نشده</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('admin.genre.edit', $item->id) }}" class="btn btn-primary btn-sm "><i
                                            class="bi bi-pencil-square "></i></a>
                                    <a href="{{ route('admin.genre.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('آیا از حذف این ژانر مطمئن هستید؟')"><i
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
            {{ $genres->links() }}
        </div>
    </div>
@endsection

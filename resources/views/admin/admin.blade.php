@extends('admin.layouts.master')
@section('Content')
    @session('success')
        <div class="alert alert-success shadow-sm m-2">{{ session('success') }}</div>
    @endsession
    @session('fail')
        <div class="alert alert-danger shadow-sm m-2">{{ session('fail') }}</div>
    @endsession
    <div class="container-fluid p-3">
        <div class="d-md-block d-grid mb-3"><a href="{{ route('admin.create') }}" class="btn btn-primary">افزودن مدیر جدید</a>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">مدیران سایت</h5>

            <a href="{{ route('admin.admins.export') }}" class="text-success fs-5" title="خروجی اکسل">
                <i class="bi bi-file-earmark-excel-fill"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered shadow-sm">
                <thead>
                    <tr>
                        <th>نام و نام خانوادگی</th>
                        <th>پست الکترونیکی</th>
                        <th>تاریخ ثبت</th>
                        <th>اخرین بروزرسانی</th>
                        <th>ip</th>
                        <th>اخرین ورود</th>
                        <th>اضافه شده توسط</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($admin)
                        @foreach ($admin as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $date = jdate($item->created_at) }}</td>
                                <td>{{ $date = jdate($item->updated_at) }}</td>
                                <td>{{ $item->ip ?? 'مشخص نشده' }}</td>

                                <td>{{ $item->last_login ? jdate($item->last_login) : 'تاکنون وارد نشده' }}
                                <td class="p-2">
                                    @if ($item->admin)
                                        <button class="btn btn-primary btn small">{{ $item->admin }}</button>
                                    @else
                                        <span class="text-muted "></span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1"> <a href="{{ route('admin.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm" title="ویرایش"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.destroy', $item->id) }}" class="btn btn-danger btn-sm "
                                            onclick="return confirm('آیا از حذف این مدیر مطمئن هستید؟')" title="حذف"><i
                                                class="bi bi-trash"></i></a>
                                    </div>


                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-danger fw-bold">آیتمی برای نمایش وجود ندارد</td>
                        </tr>
                    @endif





                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $admin->links() }}
        </div>
    </div>
@endsection

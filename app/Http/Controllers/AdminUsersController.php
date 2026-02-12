<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users', compact('user'), ['title' => 'کاربران سایت', 'icon' => 'bi bi-people-fill']); //
    }

    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "مشخصات کاربر";
        $user = User::find($id);

        return view('admin.user_show', compact('user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (User::find($id)) {
            if (User::find($id)->delete()) {
                return redirect()->route('admin.users')->with('success', 'کاربر با موفقیت حذف گردید');
            } else {
                return redirect()->back()->with('fail', 'خطا در حذف کاربر');
            }
        } else {
            return redirect()->back()->with('fail', 'کاربر با شناسه فوق یافت نشد');
        }
    }
}

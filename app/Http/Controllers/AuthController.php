<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function submit(Request $request)
{
    $admin = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('admin')->attempt($admin)) {

       
        $admin = AdminModel::find(Auth::guard('admin')->id());

        if ($admin) {
            $admin->update([
                'last_login' => now(),
                'ip' => $request->ip(),
            ]);
        }

        return redirect()->route('admin.dashboard');
    }

    return redirect()->back()->with('fail', 'کاربری با مشخصات فوق یافت نشد');
}

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

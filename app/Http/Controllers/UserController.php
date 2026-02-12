<?php

namespace App\Http\Controllers;

use Ipe\Sdk\Facades\SmsIr;
use App\Models\User;

use Illuminate\Support\Facades\Log;

use App\Services\SmsService;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->guard('web')->check()) {
            return redirect('/');
        }
        return view('user.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('home');
    }


    public function submit(Request $request)
    {
        $user = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'پست الکترونیکی الزامی است',
            'password.required' => 'گذرواژه الزامی است'
        ]);


        if (Auth::guard('web')->attempt($user)) {
            $request->user()->update([
                'last_login' => now(),
            ]);


            return redirect()->route('home');
        } else {
            return redirect()->back()->with('fail', 'کاربری با مشخصات فوق یافت نشد');
        }
    }

    public function register()
    {
        return view('user.register');
    }

    public function register_submit(Request $request)
    {
        try {
            // 1️⃣ ساخت کاربر
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile, // شماره موبایل کاربر
                'password' => Hash::make($request->password),
                'ip' => $request->ip(),
            ]);

            // 2️⃣ ورود خودکار
            Auth::guard('web')->login($user);

            // 3️⃣ ارسال پیامک خوش‌آمدگویی با cURL
            $curl = curl_init();

            $data = [
                "lineNumber" => "30002108015555", // شماره اختصاصی خط پنل SmsIr
                "messageTexts" => [
                    "سلام {$user->name} 👋 ثبت‌نام شما با موفقیت انجام شد 🌱"
                ],
                "mobiles" => [$user->mobile], // شماره موبایل گیرنده
                "senddatetime" => null
            ];

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.sms.ir/v1/send/likeToLike",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "Accept: text/plain",
                    "X-API-KEY: " . env('SMSIR_API_KEY')
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                Log::error("SmsIr cURL Error", ['error' => $err]);
            } else {
                Log::info("SmsIr welcome message", ['response' => $response]);
            }

            // 4️⃣ ریدایرکت موفق
            return redirect()->route('home')->with('success', 'ثبت نام با موفقیت انجام شد');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('fail', 'خطا در ثبت نام: ' . $e->getMessage())->withInput();
        }
    }
}

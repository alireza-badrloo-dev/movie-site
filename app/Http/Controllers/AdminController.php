<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $admin = AdminModel::orderBy('id', 'desc')->paginate(5);
        return view('admin.admin', compact('admin'), ['title' => 'مدیران سایت', 'icon' => 'bi bi-person']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ایجاد مدیر جدید";
        return view('admin.admin_create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email:rfc|unique:users',
        'password' => 'required|confirmed|min:8'
    ], [
        'name.required' => 'وارد کردن نام و نام خانوادگی الزامی است',
        'email.required' => 'وارد کردن پست الکترونیکی الزامی است',
        'email.email' => 'پست الکترونیکی نا معتبر است',
        'email.unique' => 'پست الکترونیکی در سایت موجود است',
        'password.required' => 'وارد کردن رمزعبور الزامی است',
        'password.confirmed' => 'رمزعبور و تکرار آن مطابقت ندارد',
        'password.min' => 'رمزعبور حداقل باید 8 کاراکتر باشد'
    ]);

    $admin = new AdminModel();
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->mobile = $request->mobile; // حتماً موبایل داشته باشه
    $admin->password = Hash::make($request->password);
    $admin->admin = auth()->guard('admin')->check()
        ? auth()->guard('admin')->user()->name
        : null;

    if ($admin->save()) {

        // 📩 ارسال پیامک با cURL (دقیقاً همون مدل قبلی)
        $curl = curl_init();

        $data = [
            "lineNumber" => "30002108015555",
            "messageTexts" => [
                "سلام {$admin->name} 👋\nاکانت ادمین شما با موفقیت ایجاد شد ✅"
            ],
            "mobiles" => [$admin->mobile],
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
            Log::error('Admin SMS Error', ['error' => $err]);
        } else {
            Log::info('Admin SMS Sent', ['response' => $response]);
        }

        return redirect()->route('admin.admin')
            ->with('success', 'مدیر جدید اضافه شد ');
    }

    return redirect()->back()->with('fail', 'خطا در ثبت مدیر جدید');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = AdminModel::find($id);
        if ($admin) {
            $title = 'ویرایش مدیر';
            return view('admin.admin_edit', compact('admin', 'title'));
        } else {
            return redirect()->back()->with('fail', 'مدیر با شناسه فوق یافت نشد');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc|unique:users,email,' . $id,
            'password' => 'confirmed'
        ], [
            'name.required' => 'وارد کردن نام و نام خانوادگی الزامی است',
            'email.required' => 'وارد کردن پست الکترونیکی الزامی است',
            'email.email' => 'پست الکترونیکی نا معتبر است',
            'email.unique' => 'پست الکترونیکی در سایت موجود است',
            'password.confirmed' => 'رمزعبور و تکرار آن مطابقت ندارد',

        ]);
        if ($request->password) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];
        } else {

            $data = [
                'name' => $request->name,
                'email' => $request->email
            ];
        }
        if (AdminModel::find($id)->update($data)) {
            return redirect()->route('admin.admin')->with('success', 'مدیر با موفقیت ویرایش گردید');
        } else {
            return redirect()->back()->with('fail', 'خطا در ویرایش مدیر');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (AdminModel::find($id)) {
            if (AdminModel::find($id)->delete()) {
                return redirect()->route('admin.admin')->with('success', 'مدیر با موفقیت حذف گردید');
            } else {
                return redirect()->back()->with('fail', 'خطا در حذف مدیر');
            }
        } else {
            return redirect()->back()->with('fail', 'مدیر با شناسه فوق یافت نشد');
        }
    }
}

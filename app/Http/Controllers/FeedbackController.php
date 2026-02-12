<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showfeedback()
    {
        $title = "درباره ما";
        return view("feedback",compact('title'));
    }
    public function submitfeedback(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'message' => 'required|min:20'
        ], [
            'name.required' => 'نام و نام خانوادگی الزامی است',
            'email.required' => 'پست الکترونیکی الزامی است ',
            'email.email' => 'پست الکترونیکی نا معتبر است',
            'message.required' => 'پیام الزامی است',
            'message.min' => 'حداقل طول پیام باید 20 کاراکتر باشد'
        ]);
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->message = $request->message;
        $feedback->ip = $request->ip();
        if ($feedback->save()) {
            return redirect()->route('feedback')->with('success', 'پیام شما با موفقیت ثبت گردید');
        } else {
            return redirect()->back()->with('fail', 'پیام شما با خطا مواجه شد');
        }
    }
}

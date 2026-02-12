<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::orderBy('id', 'desc')->paginate(10);

        return view('admin.feedbacks', compact('feedback'), [
            'title' => 'نظرات',
            'icon'  => 'bi bi-chat-quote'
        ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $feedback = Feedback::findOrFail($id);

        return view('admin.feedback_edit', compact('feedback'), [
            'title' => 'ویرایش نظر',
            'icon'  => 'bi bi-pencil-square'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $feedback = Feedback::findOrFail($id);
        
        
        $feedback->status = $request->has('status');

        if ($feedback->save()) {
            return redirect()
                ->route('admin.feedback')
                ->with('success', 'وضعیت نظر با موفقیت بروزرسانی شد');
        }

        return redirect()
            ->back()
            ->with('fail', 'خطا در بروزرسانی نظر');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->delete()) {
            return redirect()
                ->route('admin.feedback')
                ->with('success', 'نظر با موفقیت حذف شد');
        }

        return redirect()
            ->back()
            ->with('fail', 'خطا در حذف نظر');
    }
}

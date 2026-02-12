<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    /**
     * لیست نظرات
     */
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->paginate(5);

        return view('admin.comments', compact('comments'), [
            'title' => 'نظرات',
            'icon'  => 'bi bi-chat-dots'
        ]);
    }


    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('admin.comment_edit', compact('comment'), [
            'title' => 'ویرایش نظر',
            'icon'  => 'bi bi-pencil-square'
        ]);
    }


    public function update(Request $request, $id)
    {
        
        $comment = Comment::findOrFail($id);
        $comment->admin_reply = $request->admin_reply;
        $comment->admin_id = auth('admin')->id();
        $comment->status = $request->has('status');

        if ($comment->save()) {
            return redirect()
                ->route('admin.comment')
                ->with('success', 'وضعیت نظر با موفقیت بروزرسانی شد');
        }

        return redirect()
            ->back()
            ->with('fail', 'خطا در بروزرسانی نظر');
    }

    



    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->delete()) {
            return redirect()
                ->route('admin.comment')
                ->with('success', 'نظر با موفقیت حذف شد');
        }

        return redirect()
            ->back()
            ->with('fail', 'خطا در حذف نظر');
    }
}

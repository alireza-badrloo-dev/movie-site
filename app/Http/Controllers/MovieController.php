<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function find($id)
    {
        // پیدا کردن فیلم با ژانرها و کامنت‌ها
        $data = Movie::with('genres', 'comments')->where('status', 1)->findOrFail($id);

        // فیلم‌های پیشنهادی (غیر از خود فیلم، به صورت رندوم)
        $relatedMovies = Movie::where('status', 1)->where('id', '!=', $data->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('movie', compact('data', 'relatedMovies'));
    }


    public function ForeignShow()
    {
        $title = "دانلود فیلم های خارجی";
        $film = Movie::where('type', 'movie')->where('status', 1)->where('country', '!=', 'ایران')->paginate(5);
        return view('film', compact('film', 'title'));
    }

    public function IranianShow()
    {
        $title = "دانلود فیلم های ایرانی";
        $film = Movie::where('type', 'movie')->where('status', 1)->where('country', 'ایران')->paginate(5);
        return view('film', compact('film', 'title'));
    }

    public function showfeedback($id)
    {
        return view('movie');
    }
    public function submitcomment(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'message' => 'required|min:10'
        ], [
            'name.required' => 'نام و نام خانوادگی الزامی است',
            'message.required' => 'پیام الزامی است',
            'message.min' => 'حداقل طول پیام باید 10 کاراکتر باشد'
        ]);
        $comment = new Comment();
        $comment->movie_id = $request->movie_id;
        $comment->name = $request->name;
        $comment->message = $request->message;
        $comment->ip = $request->ip();
        if ($comment->save()) {
            return redirect()->route('movie', $request->movie_id)->with('success', 'پیام شما با موفقیت ثبت شد');
        } else {
            return redirect()->back()->with('fail', 'پیام شما با خطا مواجه شد');
        }
    }
    public function download($id)
    {
        $movie = Movie::findOrFail($id);

        // فقط نام فایل واقعی
        $fileName = basename($movie->main_file);

        // مسیر کامل روی سرور
        $filePath = public_path('movies/' . $fileName);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        // دانلود فایل با هدر درست
        return response()->download($filePath, $movie->title . '.mp4', [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'attachment; filename="' . $movie->title . '.mp4"',
        ]);
    }
}

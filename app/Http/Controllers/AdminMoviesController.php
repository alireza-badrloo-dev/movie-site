<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMoviesController extends Controller
{
    public function index()
    {
        $title = "فیلم ها";
        $icon = "bi bi-camera-video";
        $movies = Movie::orderBy('id', 'desc')->paginate(5);
        return view('admin.movies', compact('movies', 'title', 'icon'));
    }

    public function create()
    {
        $title = "افزودن فیلم";
        $genres = Genre::all();
        return view('admin.movie_create', compact('title', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_fa' => 'required',
            'title_en' => 'required',
            'summary' => 'required',
            'genres' => 'required|array',
            'type' => 'required',
            'poster' => 'required|max:500|mimes:png,jpg',
            'main_file' => 'required|mimes:mp4,mkv,avi|max:204800',
            'country' => 'required',
            'director' => 'required',
            'actors' => 'required',
            'imdb_rate' => 'required',
            'year' => 'required',
            'is_special' => 'required'
        ], [
            'title_fa.required' => 'عنوان فارسی فیلم الزامی است.',
            'title_en.required' => 'عنوان انگلیسی فیلم الزامی است.',
            'summary.required' => 'خلاصه فیلم الزامی است.',
            'genres.required' => 'انتخاب ژانر(ها) الزامی است.',
            'genres.array' => 'ژانرها باید به صورت یک آرایه انتخاب شوند.',
            'type.required' => 'نوع فیلم را انتخاب کنید.',
            'poster.required' => 'پوستر فیلم الزامی است.',
            'poster.max' => 'حجم پوستر نباید بیشتر از 500 کیلوبایت باشد.',
            'poster.mimes' => 'فرمت پوستر باید png یا jpg باشد.',
            'main_file.required' => 'فایل اصلی فیلم الزامی است.',
            'main_file.mimes' => 'فرمت فایل اصلی باید mp4، mkv یا avi باشد.',
            'main_file.max' => 'حجم فایل اصلی نباید بیشتر از 200 مگابایت باشد.',
            'country.required' => 'کشور سازنده فیلم الزامی است.',
            'director.required' => 'نام کارگردان الزامی است.',
            'actors.required' => 'اسامی بازیگران الزامی است.',
            'imdb_rate.required' => 'امتیاز IMDb الزامی است.',
            'year.required' => 'سال تولید فیلم الزامی است.',
            'is_special.required' => 'انتخاب ویژه بودن فیلم الزامی است.'
        ]);


        // ذخیره پوستر
        $posterFilename = time() . "." . $request->poster->extension();
        $request->file('poster')->storeAs('image', $posterFilename);

        // ذخیره فایل اصلی فیلم
        $mainFileName = time() . "_movie." . $request->main_file->extension();
        $request->file('main_file')->storeAs('movies', $mainFileName);

        $movie = new Movie();
        $movie->title_fa = $request->title_fa;
        $movie->title_en = $request->title_en;
        $movie->summary = $request->summary;
        $movie->duration = $request->duration;
        $movie->imdb_rate = $request->imdb_rate;
        $movie->year = $request->year;
        $movie->type = $request->type;
        $movie->poster = $posterFilename;
        $movie->main_file = $mainFileName;
        $movie->country = $request->country;
        $movie->director = $request->director;
        $movie->actors = $request->actors;
        $movie->is_special = $request->is_special;
        $movie->admin_id = auth('admin')->id();
        $movie->has_subtitle = $request->has('has_subtitle');
        $movie->has_dub = $request->has('has_dub');

        if ($movie->save()) {
            $movie->genres()->attach($request->genres);
            return redirect()->route('admin.movie')->with('success', 'فیلم با موفقیت ثبت شد');
        }

        return redirect()->back()->with('fail', 'خطا در ثبت فیلم');
    }

    public function edit(string $id)
    {
        $movie = Movie::find($id);
        $genres = Genre::all();
        if ($movie) {
            $title = 'ویرایش فیلم';
            return view('admin.movie_edit', compact('movie', 'title', 'genres'));
        } else {
            return redirect()->back()->with('fail', 'فیلم با شناسه فوق یافت نشد');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title_fa' => 'required',
            'title_en' => 'required',
            'summary' => 'required',
            'type' => 'required',
            'poster' => 'max:500|mimes:png,jpg',
            'main_file' => 'mimes:mp4,mkv,avi|max:200000',
            'country' => 'required',
            'director' => 'required',
            'actors' => 'required',
            'imdb_rate' => 'required',
            'year' => 'required',
            'genres' => 'nullable|array'
        ], [
            'title_fa.required' => 'عنوان فارسی فیلم الزامی است.',
            'title_en.required' => 'عنوان انگلیسی فیلم الزامی است.',
            'summary.required' => 'خلاصه فیلم الزامی است.',
            'type.required' => 'نوع فیلم را انتخاب کنید.',
            'poster.max' => 'حجم پوستر نباید بیشتر از 500 کیلوبایت باشد.',
            'poster.mimes' => 'فرمت پوستر باید png یا jpg باشد.',
            'main_file.mimes' => 'فرمت فایل اصلی باید mp4، mkv یا avi باشد.',
            'main_file.max' => 'حجم فایل اصلی نباید بیشتر از 200 مگابایت باشد.',
            'country.required' => 'کشور سازنده فیلم الزامی است.',
            'director.required' => 'نام کارگردان الزامی است.',
            'actors.required' => 'اسامی بازیگران الزامی است.',
            'imdb_rate.required' => 'امتیاز IMDb الزامی است.',
            'year.required' => 'سال تولید فیلم الزامی است.',
            'genres.array' => 'ژانرها باید به صورت یک آرایه انتخاب شوند.'
        ]);


        $movie = Movie::findOrFail($id);

        $movie->title_fa = $request->title_fa;
        $movie->title_en = $request->title_en;
        $movie->summary = $request->summary;
        $movie->type = $request->type;
        $movie->country = $request->country;
        $movie->director = $request->director;
        $movie->actors = $request->actors;
        $movie->imdb_rate = $request->imdb_rate;
        $movie->year = $request->year;
        $movie->is_special = $request->is_special;
        $movie->duration = $request->duration;
        $movie->admin_id = auth('admin')->id();
        $movie->status = $request->has('status');
        $movie->has_subtitle = $request->has('has_subtitle');
        $movie->has_dub = $request->has('has_dub');

        // آپلود پوستر جدید
        if ($request->hasFile('poster')) {
            $posterFilename = time() . "." . $request->poster->extension();
            $request->poster->storeAs('image', $posterFilename);

            if ($movie->poster && file_exists(public_path('image/' . $movie->poster))) {
                unlink(public_path('image/' . $movie->poster));
            }

            $movie->poster = $posterFilename;
        }

        // آپلود فایل اصلی جدید
        if ($request->hasFile('main_file')) {
            $mainFileName = time() . "_movie." . $request->main_file->extension();
            $request->main_file->storeAs('movies', $mainFileName);

            if ($movie->main_file && file_exists(public_path('movies/' . $movie->main_file))) {
                unlink(public_path('movies/' . $movie->main_file));
            }

            $movie->main_file = $mainFileName;
        }

        if ($movie->save()) {
            $movie->genres()->sync($request->genres ?? []);
            return redirect()->route('admin.movie')->with('success', 'فیلم با موفقیت ویرایش شد');
        }

        return redirect()->back()->with('fail', 'خطا در ویرایش فیلم');
    }

    public function show(string $id)
    {
        $title = "نمایش فیلم";
        $movie = Movie::find($id);
        $genres = Genre::all();
        return view('admin.movie_show', compact('movie', 'title', 'genres'));
    }

    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        if ($movie) {
            if ($movie->poster && file_exists(public_path('image/' . $movie->poster))) {
                unlink(public_path('image/' . $movie->poster));
            }
            if ($movie->main_file && file_exists(public_path('movies/' . $movie->main_file))) {
                unlink(public_path('movies/' . $movie->main_file));
            }
            $movie->delete();
            return redirect()->route('admin.movie')->with('success', 'فیلم با موفقیت حذف گردید');
        }

        return redirect()->route('admin.movie')->with('fail', 'فیلم با شناسه فوق یافت نشد');
    }
}

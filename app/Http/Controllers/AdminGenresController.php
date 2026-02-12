<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class AdminGenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::orderBy('id', 'desc')->paginate(10);

        return view('admin.genres', compact('genres'), [
            'title' => 'ژانر ها',
            'icon'  => 'bi bi-film'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ایجاد ژانر جدید";
        return view('admin.genres_create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'slug' => 'required'
        ]);

        $genre = new Genre();
        $genre->title = $request->title;
        $genre->slug = $request->title;
        $genre->status = $request->has('status');
        $genre->admin_id = auth('admin')->id();
        if ($genre->save()) {
            return redirect()->route('admin.genre')->with('success', 'ژانر با موفقیت ایجاد شد');
        }else{
            return redirect()->route('admin.genre')->with('fail', 'مشکل در ایجاد ژانر جدید');
        }
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
        $genre = Genre::findOrFail($id);

        return view('admin.genres_edit', compact('genre'), [
            'title' => 'ویرایش ژانر',
            'icon'  => 'bi bi-film'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request -> validate([
            'title' => 'required',
            'slug' => 'required'
        ]);

        $genre = Genre::findOrFail($id);
        $genre->title = $request->title;
        $genre->slug = $request->slug;
        $genre->status = $request->has('status');
        $genre->admin_id = auth('admin')->id();
        if ($genre->save()) {
            return redirect()->route('admin.genre')->with('success', 'ژانر با موفقیت ویرایش شد');
        }else{
            return redirect()->route('admin.genre')->with('fail', 'مشکل در ایجاد ژانر جدید');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);

        if ($genre->delete()) {
            return redirect()
                ->route('admin.genre')
                ->with('success', 'ژانر با موفقیت حذف شد');
        }

        return redirect()
            ->back()
            ->with('fail', 'خطا در حذف ژانر');
    }
}

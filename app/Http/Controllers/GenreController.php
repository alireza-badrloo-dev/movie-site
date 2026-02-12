<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
     public function show(Genre $genre)
    {
        $movies = $genre->movies()->where('status' , 1)->latest()->paginate(20);

        return view('genre', compact('genre', 'movies'));
    }
}

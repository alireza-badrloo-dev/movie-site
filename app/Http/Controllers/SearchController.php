<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
     public function index(Request $request)
    {
        $q = $request->q;

        $movies = Movie::where('status' , 1)->where('title_fa', 'LIKE', "%$q%")
            ->orWhere('title_en', 'LIKE', "%$q%")
            ->orWhere('actors', 'LIKE', "%$q%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('search', compact('movies', 'q'));
    }
}

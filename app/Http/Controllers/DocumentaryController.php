<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DocumentaryController extends Controller
{
    public function __invoke()
    {
        $title = "دانلود مستند";
        $documentaries = Movie::where('type' , 'documentary')->where('status' , 1)->paginate(5);

        return view('documentary', compact('documentaries','title'));
    }
}

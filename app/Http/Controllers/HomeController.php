<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genres')->orderBy('id', 'desc')->where('status' , 1)->paginate(10);
        return view('index', compact('movies'));
    }

    // public function ForeignShow(){
    //     $movies = Movie::where('type','movie')->where('status' , 1)->where('country' , '!=' , 'ایران')->paginate(5);
    //     return view('serals' , compact('serials'));
    // }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AnimationController extends Controller
{
    public function __invoke()
    {
        $title = "دانلود انیمیشن";
        $animations = Movie::where('type' , 'animation')->where('status' , 1)->paginate(5);

        return view('animation', compact('animations','title'));
    }
}
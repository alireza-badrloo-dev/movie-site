<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class SerialsController extends Controller
{
    public function ForeignShow(){
        $title = "دانلود سریال های خارجی";
        $serials = Movie::where('status' , 1)->where('type','series')->where('country' , '!=' , 'ایران')->paginate(5);
        return view('serials' , compact('serials','title'));
    }

    public function IranianShow(){
        $title = "دانلود سریال های ایرانی";
        $serials = Movie::where('status' , 1)->where('type','series')->where('country' , '==' , 'ایران')->paginate(5);
        return view('serials' , compact('serials','title'));
    }
}

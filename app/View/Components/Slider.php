<?php

namespace App\View\Components;

use App\Models\Movie;
use Illuminate\View\Component;

class Slider extends Component
{
    public $movies;
    
    public function __construct()
    {
        $this->movies = Movie::where('is_special', 1)->where('status' , 1)->latest()->take(6)->get();
        
    }

    public function render()
    {
        return view('components.slider');
    }
}

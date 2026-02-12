<?php

namespace App\View\Components;

use App\Models\Genre;
use App\Models\Movie;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class leftside extends Component
{
    public $genres;
    public $latestForeign;
    public $latestIranian;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->genres = Genre::withCount('movies')->get();
        $this->latestForeign = Movie::where('country', '!=', 'ایران')->where('status' , 1)->latest()->take(10)->get();

        $this->latestIranian = Movie::where('country', 'ایران')->where('status' , 1)->latest()->take(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.leftside');
    }
}

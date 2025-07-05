<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TopRated extends Component
{
    public $topRated = [];

    public function mount()
    {
        $this->fetchTopRated();
    }

    public function fetchTopRated()
    {
        $this->topRated = Cache::remember('top_rated', 3600, function () {
            $resTopRated = Http::get(env('TMDB_BASE_URL') . '');
        });
    }

    public function render()
    {
        return view('livewire.top-rated');
    }
}

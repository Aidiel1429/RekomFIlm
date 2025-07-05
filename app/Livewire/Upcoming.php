<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Upcoming extends Component
{
    public $upComings = [];

    public function mount()
    {
        $this->fetchUpcoming();
    }

    public function fetchUpcoming()
    {
        $this->upComings = Cache::remember('upcomings', 3600, function () {
            $res = Http::get(env('TMDB_BASE_URL') . '/movie/upcoming', [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            return collect($res->json()['results'] ?? []);
        });
    }

    public function render()
    {
        return view('livewire.upcoming', ['upcomings' => $this->upComings]);
    }
}

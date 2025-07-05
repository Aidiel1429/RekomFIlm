<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TrendingCelebrities extends Component
{
    public $trendingCelebrities = [];

    public function mount()
    {
        $this->fetchTrendingCelebrities();
    }

    public function fetchTrendingCelebrities()
    {
        $this->trendingCelebrities = Cache::remember('trending_celebrities', 3600, function () {
            $res = Http::get(env('TMDB_BASE_URL') . '/person/popular', [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            return $res->json()['results'] ?? [];
        });
    }

    public function render()
    {
        return view('livewire.trending-celebrities', ['trendingCelebrities' => $this->trendingCelebrities]);
    }
}

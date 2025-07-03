<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class MovieList extends Component
{
    public $movies = [];

    public function mount()
    {
        $this->fetchMovies();
    }

    public function fetchMovies()
    {
        $this->movies = Cache::remember('movies_list', 3600, function () {
            $response = Http::get(env('TMDB_BASE_URL') . '/discover/movie', [
                'api_key' => env('TMDB_API_KEY'),
            ]);
            return $response->json()['results'] ?? [];
        });
    }

    public function render()
    {
        return view('livewire.movie-list', ['movies' => $this->movies]);
    }
}

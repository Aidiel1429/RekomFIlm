<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TopRated extends Component
{
    public $topRateds = [];

    public function mount()
    {
        $this->fetchTopRated();
    }

    public function fetchTopRated()
    {
        $this->topRateds = Cache::remember('top_rated', 3600, function () {
            $resTopRated = Http::get(env('TMDB_BASE_URL') . '/movie/top_rated?language=en-US&page=1', [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            return $resTopRated->json()['results'] ?? [];

            // $resGenre = Http::get(env('TMDB_BASE_URL') . '/genre/movie/list', [
            //     'api_key' => env('TMDB_API_KEY'),
            // ]);

            // $genresMap = collect($resGenre->json('genres', []))->mapWithKeys(fn($genre) => [$genre['id'] => $genre['name']]);

            // $enriched = $topRateds->map(function ($movie) use ($genresMap) {
            //     $movie['genre'] = collect($movie['genre_ids'])->map(fn($id) => $genresMap[$id])->implode(', ');

            //     return $movie;
            // });

            // return $enriched->values()->all();
        });
    }

    public function render()
    {
        return view('livewire.top-rated');
    }
}

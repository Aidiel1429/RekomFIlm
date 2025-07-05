<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Carousel extends Component
{
    public $carousels = [];

    public function mount()
    {
        $this->fetchCarousel();
    }

    public function fetchCarousel()
    {
        $this->carousels = Cache::remember('movies_list', 3600, function () {
            $resDiscover = Http::get(env('TMDB_BASE_URL') . '/discover/movie', [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            $discover = collect($resDiscover->json()['results'] ?? [])->take(5);

            $resGenre = Http::get(env('TMDB_BASE_URL') . '/genre/movie/list', [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            $genresMap = collect($resGenre->json('genres', []))->mapWithKeys(fn($genre) => [$genre['id'] => $genre['name']]);

            $enriched = $discover->map(function ($movie) use ($genresMap) {
                $movie['genre'] = collect($movie['genre_ids'])->map(fn($id) => $genresMap[$id])->implode(', ');

                return $movie;
            });

            return $enriched->values()->all();
        });
    }

    public function render()
    {
        return view('livewire.carousel', ['carousels' => $this->carousels]);
    }
}

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

            $enriched = $discover->map(function ($movie) {
                $resGenre = Http::get(env('TMDB_BASE_URL') . '/movie/' . $movie['id'] . '?language=en-US', [
                    'api_key' => env('TMDB_API_KEY'),
                ]);

                $genres = $resGenre->json()['genres'] ?? [];

                $movie['genre'] = collect($genres)->pluck('name')->implode(', ');

                return $movie;
            });

            return $enriched;
        });
    }

    public function render()
    {
        return view('livewire.carousel', ['carousels' => $this->carousels]);
    }
}

<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NowPlaying extends Component
{
    public $listNowPlayings = [];

    public function mount()
    {
        $this->fetchNowPlaying();
    }

    public function fetchNowPlaying()
    {
        $this->listNowPlayings = Cache::remember('list_now_playing', 3600, function () {
            $resNowPlaying = Http::get(env('TMDB_BASE_URL') . '/movie/now_playing?language=en-US&page=1', [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            return $resNowPlaying->json()['results'] ?? [];

            // $resGenre = Http::get(env('TMDB_BASE_URL') . '/genre/movie/list', [
            //     'api_key' => env('TMDB_API_KEY'),
            // ]);

            // $genresMap = collect($resGenre->json('genres', []))->mapWithKeys(fn($genre) => [$genre['id'] => $genre['name']]);

            // $enriched = $nowPlaying->map(function ($movie) use ($genresMap) {
            //     $movie['genre'] = collect($movie['genre_ids'])->map(fn($id) => $genresMap[$id])->implode(', ');

            //     return $movie;
            // });

            // return $enriched->values()->all();
        });
    }

    public function render()
    {
        return view('livewire.now-playing', ['listNowPlayings' => $this->listNowPlayings]);
    }
}

<?php

namespace App\Livewire\Genre;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GenreList extends Component
{
    public $genres = [], $activeTab = 'movie';
    public $endpoint = [
        'movie' => '/genre/movie/list',
        'tv' => '/genre/tv/list',
    ];

    public function mount()
    {
        $this->fetchGenres();
    }

    public function fetchGenres()
    {
        $endpoint = $this->endpoint[$this->activeTab] ?? '/genre/movie/list';

        $res = Http::get(env('TMDB_BASE_URL') . $endpoint, [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        $result = $res->json('genres', []);

        $this->genres = $result;
    }

    public function updateFetchGenres($tab)
    {
        $this->activeTab = $tab;
        $this->genres = [];
        $this->fetchGenres();
    }

    public function render()
    {
        return view('livewire.genre.genre-list', ['genres' => $this->genres]);
    }
}

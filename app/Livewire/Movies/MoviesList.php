<?php

namespace App\Livewire\Movies;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MoviesList extends Component
{
    public $activeTab = 'all', $movies = [], $page = 1, $totalPages = 1, $totalResultInPage = 1, $loading = false;
    public $endpoint = [
        'all' => '/discover/movie',
        'now_playing' => '/movie/now_playing',
        'upcoming' => '/movie/upcoming',
        'top_rated' => '/movie/top_rated',
        'popular' => '/movie/popular',
    ];

    public function mount()
    {
        $this->fetchMovies();
    }

    public function fetchMovies()
    {
        $this->loading = true;

        $endpoint = $this->endpoint[$this->activeTab] ?? '/discover/movie';

        $res = Http::get(env('TMDB_BASE_URL') . $endpoint, [
            'api_key' => env('TMDB_API_KEY'),
            'page' => $this->page,
        ]);

        $json = $res->json();
        $this->movies = $json['results'] ?? [];
        $this->totalPages = $json['total_pages'] ?? 1;
        $this->totalResultInPage = $json['total_results'] ?? 1;

        $this->loading = false;
    }

    public function updateFetchMovies($tab)
    {
        $this->activeTab = $tab;
        $this->page = 1;
        $this->movies = [];
        $this->fetchMovies();
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchMovies();
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->fetchMovies();
        }
    }

    public function render()
    {
        return view('livewire.movies.movies-list', ['movies' => $this->movies]);
    }
}

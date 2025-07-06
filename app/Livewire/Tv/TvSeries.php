<?php

namespace App\Livewire\Tv;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TvSeries extends Component
{
    public $activeTab = 'all', $tvSeries = [], $page = 1, $totalPages = 1, $totalResultInPage = 1, $loading = false;
    public $endpoint = [
        'all' => '/discover/tv',
        'airing_today' => '/tv/airing_today',
        'on_the_air' => '/tv/on_the_air',
        'top_rated' => '/tv/top_rated',
        'popular' => '/tv/popular',
    ];

    public function mount()
    {
        $this->fetchTvSeries();
    }

    public function fetchTvSeries()
    {
        $this->loading = true;

        $endpoint = $this->endpoint[$this->activeTab] ?? '/discover/tv';

        $res = Http::get(env('TMDB_BASE_URL') . $endpoint, [
            'api_key' => env('TMDB_API_KEY'),
            'page' => $this->page,
        ]);

        $json = $res->json();
        $this->tvSeries = $json['results'] ?? [];
        $this->totalPages = $json['total_pages'] ?? 1;
        $this->totalResultInPage = $json['total_results'] ?? 1;

        $this->loading = false;
    }

    public function updatefetchTvSeries($tab)
    {
        $this->activeTab = $tab;
        $this->page = 1;
        $this->tvSeries = [];
        $this->fetchTvSeries();
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchTvSeries();
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->fetchTvSeries();
        }
    }

    public function render()
    {
        return view('livewire.tv.tv-series', ['tvSeries' => $this->tvSeries]);
    }
}

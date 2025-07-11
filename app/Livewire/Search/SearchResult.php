<?php

namespace App\Livewire\Search;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchResult extends Component
{
    public $activeTab = 'movie', $query = '', $searchs = [], $page = 1, $totalPages = 1, $totalResultInPage = 1, $loading = false;
    public $endpoint = [
        'movie' => '/search/movie',
        'tv' => '/search/tv',
        'celebrity' => '/search/person',
    ];

    public function mount($query)
    {
        $this->query = str_replace('-', ' ', $query);

        $this->fetchSearch();
    }

    public function fetchSearch()
    {
        $this->loading = true;

        $endpoint = $this->endpoint[$this->activeTab] ?? '/search/movie';

        $res = Http::get(env('TMDB_BASE_URL') . $endpoint, [
            'api_key' => env('TMDB_API_KEY'),
            'query' => $this->query,
            'page' => $this->page,
        ]);

        $result = $res->json();
        $rawResults = $result['results'] ?? [];

        $this->searchs = collect($rawResults)->map(function ($item) {
            switch ($this->activeTab) {
                case 'tv':
                    return [
                        'id' => $item['id'] ?? null,
                        'title' => $item['name'] ?? 'No Title',
                        'image' => $item['poster_path'] ?? null,
                        'year' => $item['first_air_date'] ?? '',
                        'type' => 'tv',
                        'known_for' => $item['known_for_department'] ?? '',
                    ];
                case 'celebrity':
                    return [
                        'id' => $item['id'] ?? null,
                        'title' => $item['name'] ?? 'No Name',
                        'image' => $item['profile_path'] ?? null,
                        'year' => '',
                        'type' => 'celebrity',
                        'known_for' => $item['known_for_department'] ?? '',
                    ];
                case 'movie':
                default:
                    return [
                        'id' => $item['id'] ?? null,
                        'title' => $item['title'] ?? 'No Title',
                        'image' => $item['poster_path'] ?? null,
                        'year' => $item['release_date'] ?? '',
                        'type' => 'movie',
                        'known_for' => $item['known_for_department'] ?? '',
                    ];
            }
        })->toArray();

        $this->totalPages = $result['total_pages'] ?? 1;
        $this->totalResultInPage = $result['total_results'] ?? 1;
        $this->loading = false;
    }

    public function updateFetchSearch($tab)
    {
        $this->activeTab = $tab;
        $this->page = 1;
        $this->searchs = [];
        $this->fetchSearch();
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchSearch();
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->fetchSearch();
        }
    }

    public function render()
    {
        return view('livewire.search.search-result', ['searchs' => $this->searchs]);
    }
}

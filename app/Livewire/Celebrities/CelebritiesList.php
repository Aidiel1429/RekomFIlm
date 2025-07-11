<?php

namespace App\Livewire\Celebrities;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CelebritiesList extends Component
{
    public $celebrities = [], $page = 1, $totalPages = 1, $totalResultInPage = 1, $loading = false;

    public function mount()
    {
        $this->fetchCelebrities();
    }

    public function fetchCelebrities()
    {
        $this->loading = true;

        $res = Http::get(env('TMDB_BASE_URL') . '/person/popular', [
            'api_key' => env('TMDB_API_KEY'),
            'page' => $this->page
        ]);

        $result = $res->json();
        $this->celebrities = $result['results'] ?? [];
        $this->totalPages = $result['total_pages'] ?? 1;
        $this->totalResultInPage = $result['total_results'] ?? 1;

        $this->loading = false;
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchCelebrities();
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->fetchCelebrities();
        }
    }

    public function render()
    {
        return view('livewire.celebrities.celebrities-list', ['celebrities' => $this->celebrities]);
    }
}

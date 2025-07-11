<?php

namespace App\Livewire\Genre;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class GenrePage extends Component
{
    public $datas = [], $slug, $type, $genre, $page = 1, $totalPages = 1, $totalResultInPage = 1, $loading = false;

    public function mount($type, $slug)
    {
        $this->slug = Str::title(str_replace('-', ' ', $slug));
        $this->type = $type;
        $this->fetch();
    }

    public function fetch()
    {
        $this->loading = true;

        $genres = Http::get(env('TMDB_BASE_URL') . '/genre/' . $this->type . '/list', [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        $this->genre = collect($genres->json('genres', []))->firstWhere('name', $this->slug);

        if (!$this->genre) {
            abort(404, 'Genre not found');
        }

        $res = Http::get(env('TMDB_BASE_URL') . '/discover/' . $this->type, [
            'api_key' => env('TMDB_API_KEY'),
            'with_genres' => $this->genre['id'],
            'page' => $this->page,
        ]);

        $json = $res->json();
        $this->totalPages = $json['total_pages'] ?? 1;
        $this->totalResultInPage = $json['total_results'] ?? 1;

        $this->datas = collect($json['results'] ?? [])->map(function ($item) {
            return [
                'id' => $item['id'],
                'title' => $item['title'] ?? $item['name'],
                'poster_path' => $item['poster_path'],
                'release_date' => $item['release_date'] ?? $item['first_air_date'],
            ];
        });

        $this->loading = false;
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetch();
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->fetch();
        }
    }

    public function render()
    {
        return view('livewire.genre.genre-page', ['datas' => $this->datas]);
    }
}

<?php

namespace App\Livewire\Tv;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DetailPage extends Component
{
    public $details = [], $type = 'tv', $slug, $seriesId, $trailerUrl = null;

    public function mount($slug, $id)
    {
        $this->slug = $slug;

        $this->seriesId = $id;

        $this->fetchSeries();
    }

    public function fetchSeries()
    {
        $res = Http::get(env('TMDB_BASE_URL') . '/tv/' . $this->seriesId, [
            'api_key' => env('TMDB_API_KEY'),
            'append_to_response' => 'videos,credits,recommendations,similar,reviews,external_ids',
        ]);

        $result = $res->json();

        $this->details = $result;

        $trailer = collect($result['videos']['results'])->firstWhere('type', 'Trailer');

        if ($trailer) {
            $this->trailerUrl = 'https://www.youtube.com/embed/' . $trailer['key'];
        } else {
            $this->trailerUrl = null;
        }
    }

    public function render()
    {
        return view('livewire.tv.detail-page');
    }
}

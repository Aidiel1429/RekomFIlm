<?php

namespace App\Livewire\Celebrities;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DetailPage extends Component
{
    public $details = [], $slug, $personId;

    public function mount($slug, $id)
    {
        $this->slug = $slug;

        $this->personId = $id;

        $this->fetchPersonDetails();
    }

    public function fetchPersonDetails()
    {
        $res = Http::get(env('TMDB_BASE_URL') . '/person/' . $this->personId, [
            'api_key' => env('TMDB_API_KEY'),
            'append_to_response' => 'combined_credits,external_ids,images,',
        ]);

        $result = $res->json();

        $this->details = $result;
    }

    public function render()
    {
        return view('livewire.celebrities.detail-page');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;


class Navbar extends Component
{
    public $query = '';

    public function search()
    {
        if (trim($this->query)) {
            return redirect(route('search', ['query' => \Illuminate\Support\Str::slug($this->query)]));
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}

<?php

use App\Livewire\MovieList;
use Illuminate\Support\Facades\Route;

Route::get('/', MovieList::class)->name('movies.index');

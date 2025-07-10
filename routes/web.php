<?php

use App\Livewire\Dashboard;
use App\Livewire\Genre\GenreList;
use App\Livewire\Movies\MoviesList;
use App\Livewire\Tv\TvSeries;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/movies', MoviesList::class)->name('movies');
Route::get('/tv-series', TvSeries::class)->name('tv-series');
Route::get('/genres', GenreList::class)->name('genre');

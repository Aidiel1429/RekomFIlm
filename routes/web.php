<?php

use App\Livewire\Celebrities\CelebritiesList;
use App\Livewire\Celebrities\DetailPage as CelebritiesDetailPage;
use App\Livewire\Dashboard;
use App\Livewire\Genre\GenreList;
use App\Livewire\Genre\GenrePage;
use App\Livewire\Movies\DetailPage;
use App\Livewire\Movies\MoviesList;
use App\Livewire\Search\SearchResult;
use App\Livewire\Tv\DetailPage as TvDetailPage;
use App\Livewire\Tv\TvSeries;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/movies', MoviesList::class)->name('movies');
Route::get('/tv-series', TvSeries::class)->name('tv-series');
Route::get('/genres', GenreList::class)->name('genres');
Route::get('/genres/{type}/{slug}', GenrePage::class);
Route::get('/movie/{id}/{slug}', DetailPage::class);
Route::get('/tv/{id}/{slug}', TvDetailPage::class);
Route::get('/celebrities', CelebritiesList::class)->name('celebrities');
Route::get('/celebrity/{id}/{slug}', CelebritiesDetailPage::class);
Route::get('/search/{query}', SearchResult::class)->name('search');

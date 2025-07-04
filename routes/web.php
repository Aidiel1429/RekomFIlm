<?php

use App\Livewire\Dashboard;
use App\Livewire\MovieList;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('movies.index');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController ;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\FavoritesController;

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
Route::post('/favorite', [FavoritesController::class, 'store'])->name('favorite.add');
Route::delete('/favorite/{id}', [FavoritesController::class, 'destroy'])->name('favorite.delete');


Route::get('/travel', [TravelController::class, 'index'])->name('travel');
Route::post('/travel/budget', [TravelController::class, 'budget'])->name('travel.budget');
Route::get('/travel/suggest', [TravelController::class, 'suggest'])->name('travel.suggest');

Route::get('/', function () { return view('main');})->name('main');

//Route::get('/travel', [PageController::class, 'travel'])->name('travel');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/search', [PageController::class, 'search'])->name('search');







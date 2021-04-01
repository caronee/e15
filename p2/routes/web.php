<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MineralController;
use Illuminate\Support\Facades\Log;

Route::get('/', [MineralController::class, 'welcome']);


Route::get('/search', [MineralController::class, 'search']);

Route::get('/minerals', [MineralController::class, 'index']);
Route::get('/minerals/{slug}', [MineralController::class, 'show']);

Route::get('/help', [MineralController::class, 'help']);




//Route::get('/books/{title}', ['App\Http\Controllers\BookController', 'show']);
//Route::get('/search/{category}/{subcategory}', [BookController::class, 'search']);

Route::get('/help', function () {
    return view('help');
});
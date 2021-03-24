<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Log;

Route::get('/', [PageController::class, 'index']);


Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{title}', [BookController::class, 'show']);

//Route::get('/books/{title}', ['App\Http\Controllers\BookController', 'show']);
Route::get('/search/{category}/{subcategory}', [BookController::class, 'search']);

Route::get('/example', function () {
    return view(blah);
});
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index']);
Route::get('/support', [PageController::class, 'support']);


Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{title}', [BookController::class, 'show']);
Route::get('/search/{category}/{subcategory}', [BookController::class, 'search']);
Route::get('/list', [BookController::class, 'list']);
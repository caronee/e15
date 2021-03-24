<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/books/{title}', [BookController::class, 'show']);


Route::get('/', function () {
    // return '<h1>Bookmark</h1>';
    $title = storage_path('temp');



    dump($title);
    return view('welcome');

    //return view('welcome');
});


Route::get('/example', function () {
    //return '<h1>example</h1>';
    //return view('welcome');


    $foo = [1,2,3];
    //dd($foo);


    Log::info($foo);
});
<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/minerals', function () {
    return "All dem bookies";
});


Route::get('/minerals/{title}', function ($title) {
    return $title;
});

Route::get('/search/{category}/{subcategory}', function ($category, $subcategory) {
    return $category . ' and '. $subcategory;
});
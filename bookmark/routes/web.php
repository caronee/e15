<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ListController;

Route::any('/practice/{n?}', [PracticeController::class, 'index']);

Route::get('/debug', function () {
    $debug = [
        'Environment' => App::environment(),
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});
    Route::get('/', [PageController::class, 'index']);
    Route::get('/support', [PageController::class, 'support']);
 

Route::group(['middleware' => 'auth'], function () {

    // Make sure the create route comes before `/books/{slug?}` so it takes precedence
    Route::get('/books/create', [BookController::class, 'create']);#->middleware('auth');

    // Note the use of the post method in this route
    Route::post('/books', [BookController::class, 'store']);


    Route::get('/books', [BookController::class, 'index']);
    Route::get('/search', [BookController::class, 'search']);
    Route::get('/books/{slug}', [BookController::class, 'show']);

    /**
        * Book - Update
        */

    # Show the form to edit a specific book
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']);

    # Process the form to edit a specific book
    Route::put('/books/{slug}', [BookController::class, 'update']);


    /**
        * Book - DELETE
        */
    # Show the page to confirm deletion of a book
    Route::get('/books/{slug}/delete', [BookController::class, 'delete']);

    # Process the deletion of a book
    Route::delete('/books/{slug}', [BookController::class, 'destroy']);



    /**
     * List
     *
     */
    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::get('/list/{slug}/save', [ListController::class, 'save']);
});

//Route::get('/books/{title}', ['App\Http\Controllers\BookController', 'show']);
//Route::get('/search/{category}/{subcategory}', [BookController::class, 'search']);

Route::get('/example', function () {
    dump(config('mail.supportEmail'));
    return view('support');
});
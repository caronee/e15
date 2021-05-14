<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MineralController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\SpecimenController;

use App\Http\Controllers\PracticeController;

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


Route::get('/', [MineralController::class, 'welcome']);


Route::get('pages/search', [SpecimenController::class, 'search']);
Route::get('pages/search1', [SpecimenController::class, 'search1']);

Route::get('/minerals', [MineralController::class, 'index']);
Route::get('/minerals/create', [MineralController::class, 'create']);

Route::get('/minerals/{slug}', [MineralController::class, 'show']);

Route::get('/help', [MineralController::class, 'help']);



Route::get('/repositories', [RepositoryController::class, 'index']);

Route::get('/specimens', [SpecimenController::class, 'index']);




Route::group(['middleware'=> 'auth'], function () {
    Route::get('/minerals/create', [MineralController::class, 'create']);
    Route::post('/minerals/', [MineralController::class, 'store']);

    Route::get('/repositories/create', [RepositoryController::class, 'create']);
    Route::post('/repositories/', [RepositoryController::class, 'store']);
    
    Route::get('/specimens/create', [SpecimenController::class, 'create']);

    # Show the form to edit a specific Repository
    Route::get('/repositories/{display_name}/edit', [RepositoryController::class, 'edit']);
    Route::get('/minerals/{slug}/edit', [MineralController::class, 'edit']);

    # Process the form to edit a specific Repository
    Route::put('/repositories/{display_name}', [RepositoryController::class, 'update']);
    Route::put('/minerals/{slug}', [MineralController::class, 'update']);

    Route::post('/specimens/', [SpecimenController::class, 'store']);

    # Show the form to edit a specific specimen
    Route::get('/specimens/{slug}/edit', [SpecimenController::class, 'edit']);

    # Process the form to edit a specific specimen
    Route::put('/specimens/{slug}', [SpecimenController::class, 'update']);

    /**
     * Mineral - DELETE
     */
    # Show the page to confirm deletion of a book
    Route::get('/minerals/{slug}/delete', [MineralController::class, 'delete']);

    # Process the deletion of a book
    Route::delete('/minerals/{slug}', [MineralController::class, 'destroy']);
});



//Route::get('/search', [SpecimenController::class, 'search']);
Route::get('/specimens/{display_name}', [SpecimenController::class, 'show']);

//Route::get('/search', [RepositoryController::class, 'search']);
Route::get('/repositories/{display_name}', [RepositoryController::class, 'show']);
Route::get('/list', [RepositoryController::class, 'list']);
Route::get('/list', [SpecimenController::class, 'list']);



//Route::get('/repositories/{title}', ['App\Http\Controllers\repositoryController', 'show']);
//Route::get('/search/{category}/{subcategory}', [repositoryController::class, 'search']);
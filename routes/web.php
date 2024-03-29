<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::middleware('revoke_itemset')->group(function () {
        Route::get('/', App\Http\Controllers\HomeController::class);

        Route::prefix('data-transaction')->controller(App\Http\Controllers\DataTransactionController::class)->name('data-transaction.')->group(function () {
            Route::get('/', 'index');
            Route::get('get-data', 'get_data')->name('get_data');
            Route::post('import', 'import')->name('import');
        });
    });


    Route::prefix('apriori-process')->controller(App\Http\Controllers\AprioriController::class)->name('apriori-process.')->group(function () {
        Route::get('/', 'index')->middleware('revoke_itemset');
        Route::post('/', 'apriori')->middleware('add_itemset');
        Route::get('/get-data', 'apriori_get')->name('get-data');
        Route::post('/generate', 'apriori_generate')->name('generate');
        Route::get('/get-generate-data', 'apriori_generate_data')->name('get-generate-data');
    });

    Route::prefix('item')->controller(App\Http\Controllers\ItemController::class)->name('item.')->group(function () {
        Route::get('/', 'index');
        Route::get('get-data', 'get_data')->name('get-data');
        Route::get('create', 'form')->name('create');
        Route::get('edit/{item}', 'form')->name('edit');
        Route::post('save/{item?}', 'save')->name('save');
        Route::delete('destroy/{item}', 'destroy')->name('destroy');
    });

    Route::prefix('user')->controller(App\Http\Controllers\UserController::class)->name('user.')->group(function () {
        Route::get('/', 'index')->can('view-user');
        Route::get('get-data', 'get_data')->name('get-data')->can('view-user');
        Route::get('create', 'form')->name('create');
        Route::get('edit/{user}', 'form')->name('edit');
        Route::post('save/{user?}', 'save')->name('save');
        Route::delete('destroy/{user}', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/auth.php';

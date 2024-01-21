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
    Route::get('/', App\Http\Controllers\HomeController::class);


    Route::prefix('apriori-process')->controller(App\Http\Controllers\AprioriController::class)->name('apriori-process.')->group(function () {
        Route::get('/', 'index');
    });

    Route::prefix('data-transaction')->controller(App\Http\Controllers\DataTransactionController::class)->name('data-transaction.')->group(function () {
        Route::get('/', 'index');
        Route::get('get-data', 'get_data')->name('get_data');
    });
});

require __DIR__ . '/auth.php';

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
    });
});


Route::get('test', function () {
    $items = ['A', 'B', 'C', 'D'];
    $k = 2;

    $combinations = [];

    // Helper function untuk menghasilkan kombinasi rekursif
    function generateCombinations($start, $currentCombination, $k, $items, &$combinations)
    {
        $n = count($items);

        // Jika panjang kombinasi mencapai target ($k), tambahkan ke hasil
        if (count($currentCombination) === $k) {
            $combinations[] = $currentCombination;
            return;
        }

        // Iterasi melalui sisa itemset
        for ($i = $start; $i < $n; $i++) {
            $newCombination = $currentCombination;
            $newCombination[] = $items[$i];

            // Panggil rekursif dengan itemset yang lebih panjang
            generateCombinations($i + 1, $newCombination, $k, $items, $combinations);
        }
    }

    generateCombinations(0, [], $k, $items, $combinations);

    return $combinations;
});

require __DIR__ . '/auth.php';

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
        Route::get('/', 'index');
        Route::get('get-data', 'get_data')->name('get-data');
        Route::get('create', 'form')->name('create');
        Route::get('edit/{user}', 'form')->name('edit');
        Route::post('save/{user?}', 'save')->name('save');
        Route::delete('destroy/{user}', 'destroy')->name('destroy');
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

Route::get('associate', function () {
    function calculateSupport($transactions, $itemset)
    {
        // Hitung jumlah transaksi yang mendukung itemset
        $supportCount = 0;

        foreach ($transactions as $transaction) {
            if (array_diff($itemset, $transaction) == []) {
                $supportCount++;
            }
        }

        return $supportCount;
    }

    function calculateConfidence($transactions, $X, $Y)
    {
        // Hitung support untuk X
        $supportX = calculateSupport($transactions, $X);

        // Hitung support untuk X union Y
        $supportXY = calculateSupport($transactions, array_merge($X, $Y));

        // Hitung confidence menggunakan rumus
        if ($supportX > 0) {
            $confidence = $supportXY / $supportX;
            return $confidence;
        } else {
            return 0; // untuk menghindari pembagian oleh 0 jika supportX = 0
        }
    }

    function generateAssociationRules($transactions, $frequentItemsets, $minConfidence)
    {
        $associationRules = [];

        foreach ($frequentItemsets as $itemset) {
            $itemsetSize = count($itemset);

            if ($itemsetSize > 1) {
                $subsets = getSubsets($itemset);

                foreach ($subsets as $subset) {
                    $complement = array_diff($itemset, $subset);

                    $confidence = calculateConfidence($transactions, $subset, $complement);


                    if ($confidence >= $minConfidence) {
                        $associationRules[] = [
                            'X' => $subset,
                            'Y' => $complement,
                            'confidence' => $confidence
                        ];
                    }
                }
            }
        }


        return $associationRules;
    }

    function getSubsets($itemset)
    {
        $subsets = [[]];

        foreach ($itemset as $item) {
            $newSubsets = [];

            foreach ($subsets as $subset) {
                $newSubset = $subset;
                $newSubset[] = $item;
                $newSubsets[] = $newSubset;
            }

            $subsets = array_merge($subsets, $newSubsets);
        }

        // Hapus subset kosong (tanpa item)
        array_shift($subsets);

        return $subsets;
    }

    // Contoh penggunaan
    $transactions = [
        ['A', 'B', 'C'],
        ['A', 'B'],
        ['A', 'C'],
        ['B', 'C'],
    ];

    $frequentItemsets = [

        ['A', 'B'],

    ];

    $minConfidence = 0.5;

    $associationRules = generateAssociationRules($transactions, $frequentItemsets, $minConfidence);




    // Tampilkan aturan asosiasi yang dihasilkan
    foreach ($associationRules as $rule) {
        echo implode(', ', $rule['X']) . ' => ' . implode(', ', $rule['Y']) . ' (Confidence: ' . $rule['confidence'] . ')' . PHP_EOL . '<br>';
    }
});

require __DIR__ . '/auth.php';

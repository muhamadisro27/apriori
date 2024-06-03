<?php

namespace App\Http\Controllers;

use App\Http\Requests\AprioriRequest;
use App\Models\DataTransaction;
use App\Models\DetailResultItemset;
use App\Models\DetailTransaction;
use App\Models\ResultItemset;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AprioriController extends Controller
{
    //

    public function index()
    {
        $date_start = now()->firstOfYear()->format('Y-m-d');
        $date_end = now()->format('Y-m-d');

        return view('admin.apriori.index', compact('date_start', 'date_end'));
    }

    public function apriori(AprioriRequest $request)
    {
        $minimal_support = $request->support;
        $minimal_confidence = $request->confidence;
        $date_start = $request['date-start'];
        $date_end = $request['date-end'];
        $total_transaction = DataTransaction::get_total_transactions($date_start, $date_end);
        if (isset($request['k-itemset'])) {
            session()->put('k-itemset', (session()->get('k-itemset') + 1));
        }
        $k =  session()->get('k-itemset');
        $data = [];
        $dataset = $this->get_dataset($date_start, $date_end, $minimal_support, $minimal_confidence, $k);
        $total_combinations = DetailResultItemset::where('result_itemset_id', session()->get('current_apriori_id'))->where('remark', 1)->count();

        $data['title'] = $k;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['support'] = $minimal_support;
        $data['confidence'] = $minimal_confidence;
        $data['total_transaction'] = $total_transaction;
        $data['dataset'] = $dataset;
        $data['total_combinations'] = $total_combinations;

        return view('admin.apriori.itemset', $data);
    }

    public function apriori_get(): JsonResponse
    {
        if (request()->ajax()) {
            $dataset = $this->collect_data_itemset(session()->get('current_apriori_id'));

            if (session()->get('k-itemset') <= 1) {
                $data = null;
                $data = $dataset->combinations;
            } else {
                $data = [];
                $i = 0;
                foreach ($dataset->combinations->where('result_itemset_id', session()->get('current_apriori_id'))->groupBy('item_set_combination') as $combination) {
                    $item_name = [];
                    $item_code = [];
                    foreach ($combination as $item) {
                        array_push($item_name, $item->item_names);
                        array_push($item_code, $item->item_codes);
                    }

                    $data[$i] = [
                        'item_codes' => implode(',', $item_code),
                        'item_names' => implode(',', $item_name),
                        'frequency' => $combination[0]->frequency,
                        'support_count' => $combination[0]->support_count,
                        'minimal_support' => $combination[0]->minimal_support,
                        'remark' => $combination[0]->remark,
                    ];
                    $i++;
                }
            }

            $newDatas = [];
            foreach ($data as $d) {
                if (!in_array($d, $newDatas)) {
                    $newDatas[] = $d;
                }
            }

            $datatable =  DataTables::collection($data);

            $no = 1;
            $datatable->addColumn('No', function ($dataset) use ($no) {
                $no++;
                return $no;
            })
                ->addColumn('Item Code', function ($dataset) {
                    return $dataset['item_codes'];
                })
                ->addColumn('Item Name', function ($dataset) {
                    return $dataset['item_names'];
                })
                ->addColumn('Frequently', function ($dataset) {
                    return $dataset['frequency'];
                })
                ->addColumn('Support Count', function ($dataset) {
                    return $dataset['support_count'] . ' %';
                })
                ->addColumn('Minimal Support', function ($dataset) {
                    return $dataset['minimal_support'] . ' %';
                })
                ->addColumn('Remark', function ($dataset) {
                    if ($dataset['remark'] == 1) {
                        $remark = '<span class="text-white badge text-bg-success">Lolos</span>';
                    } else {
                        $remark = '<span class="text-white badge text-bg-danger">Tidak Lolos</span>';
                    }

                    return $remark;
                });

            return $datatable->rawColumns(['Remark'])->make(true);
        }
    }

    public function apriori_generate(Request $request)
    {
        $date_start = $request['date-start'];
        $date_end = $request['date-end'];
        $current_apriori_id = $request['current_apriori_id'];
        $k = $request['k-itemset'];
        $confidence = $request['confidence'];

        $data = [
            'date_start' => $date_start,
            'date_end' => $date_end,
            'current_apriori_id' => $current_apriori_id,
            'k' => $k,
            'confidence' => $confidence
        ];

        return view('admin.apriori.generate', $data);
    }

    public function apriori_generate_data(): JsonResponse
    {
        if (request()->ajax()) {

            $date_start = request('date_start');
            $date_end = request('date_end');
            $current_apriori_id = (int) request('current_apriori_id');

            $transactions = DetailResultItemset::select('item_codes')->where('result_itemset_id', ($current_apriori_id - 1))->where('remark', 1)->get()->toArray();

            $frequentItemsets = DetailResultItemset::select('item_codes', 'item_set_combination')->where('remark', 1)->where('result_itemset_id', $current_apriori_id)->get()->groupBy('item_set_combination')->toArray();

            $minConfidence = request('confidence');

            $associationRules = $this->generateAssociationRules($transactions, $frequentItemsets, (int) $minConfidence, $date_start, $date_end);

            $newRules = [];
            foreach ($associationRules as $associationRule) {

                if (!in_array($associationRule, $newRules)) {
                    $newRules[] = $associationRule;
                }
            }
            $datatable =  DataTables::collection($newRules);

            $no = 1;
            $datatable->addColumn('No', function ($dataset) use ($no) {
                $no++;
                return $no;
            })
                ->addColumn('Association Rule', function ($dataset) {
                    return implode($dataset['X']) . '=>' . implode($dataset['Y']);
                })
                ->addColumn('Confidence', function ($dataset) {
                    return $dataset['confidence'] . '%';
                });

            return $datatable->make(true);
        }
    }

    // public function generateAssociationRules2($transactions, $frequentItemsets)
    // {
    //     $rules = [];
    //     $itemset = [];
    //     $k = 1;

    //     while (true) {
    //         $itemset = $this->generateItemset($frequentItemsets, $k);
    //         dd($itemset);
    //         if (empty($itemset)) break;

    // Langkah 2: Menghitung dukungan itemset kandidat
    // foreach ($itemset as $item) {
    //     $support = hitungDukunganItemset($transactions, $item);
    //     if ($support >= $minSupport) {
    //         $rules[] = ['itemset' => $item, 'support' => $support];
    //     }
    // }
    //         $k++;
    //     }

    // $resultRules = [];
    // foreach ($rules as $rule) {
    //     $itemset = $rule['itemset'];
    //     $support = $rule['support'];

    //     if (count($itemset) > 1) {
    //         $subsets = getSubsets($itemset);
    //         foreach ($subsets as $subset) {
    //             $confidence = $support / hitungDukunganItemset($transactions, $subset);
    //             if ($confidence >= $minConfidence) {
    //                 $resultRules[] = [
    //                     'lhs' => $subset,
    //                     'rhs' => array_diff($itemset, $subset),
    //                     'support' => $support,
    //                     'confidence' => $confidence
    //                 ];
    //             }
    //         }
    //     }
    // }

    //     return $resultRules;
    // }

    // public function generateItemset($transactions, $k)
    // {
    //     $itemset = [];
    //     $numTransactions = count($transactions);

    //     // Generate itemset kandidat
    //     foreach ($transactions as $transaction) {
    //         foreach ($transaction as $item) {
    //             if (!in_array([$item], $itemset)) {
    //                 $itemset[] = [$item];
    //             }
    //         }
    //     }
    //     dd($itemset);

    //     // Menggabungkan itemset untuk membentuk itemset kandidat berikutnya
    //     for ($i = 0; $i < count($itemset); $i++) {
    //         for ($j = $i + 1; $j < count($itemset); $j++) {
    //             $combined = array_merge($itemset[$i], $itemset[$j]);
    //             sort($combined);
    //             if (count($combined) == $k && !in_array($combined, $itemset)) {
    //                 $support = hitungDukunganItemset($transactions, $combined);
    //                 if ($support >= $numTransactions * 0.5) {
    //                     $itemset[] = $combined;
    //                 }
    //             }
    //         }
    //     }

    //     return $itemset;
    // }

    public function generateAssociationRules($transactions, $frequentItemsets, $minConfidence, $date_start, $date_end)
    {
        $associationRules = [];

        foreach ($frequentItemsets as $itemset) {

            $item_codes = [];

            foreach ($itemset as $key => $item) {
                $item_codes[$key] = $item['item_codes'];
            }

            $itemsetSize = count($itemset);

            if ($itemsetSize > 1) {
                $subsets = $this->getSubsets($itemset);

                foreach ($subsets as $subset) {

                    $subsetItem = [];

                    array_push($subsetItem, $subset[0]['item_codes']);

                    $complement = array_diff($item_codes, $subsetItem);

                    $confidence = $this->calculateConfidence($transactions, $subsetItem, $complement, $date_start, $date_end);

                    if ($confidence >= $minConfidence) {
                        $associationRules[] = [
                            'X' => $subsetItem,
                            'Y' => $complement,
                            'confidence' => $confidence
                        ];
                    }
                }
            }
        }

        return $associationRules;
    }

    function check_diff_multi($array1, $array2)
    {
        $result = array();
        foreach ($array1 as $key => $val) {
            if (isset($array2[$key])) {
                if (is_array($val) && $array2[$key]) {
                    $result[$key] = $this->check_diff_multi($val, $array2[$key]);
                    unset($result[$key]);
                }
            } else {
                $result[$key] = $val;
            }
        }

        return $result;
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

    function calculateConfidence($transactions, $X, $Y, $date_start, $date_end)
    {
        // Hitung support untuk X
        $supportX = DataTransaction::with('detail_transaction')->whereHas('detail_transaction', function ($q) use ($X) {
            $q->whereIn('item_code', $X);
        })->where('date', '>=', $date_start)->where('date', '<=', $date_end)->count();


        $item_codes = array_merge($X, $Y);

        // Hitung support untuk X union Y
        $supportXY = DataTransaction::select('t1.item_code as item1', 't2.item_code as item2')
            ->join('detail_transactions as t1', 't1.data_transaction_id', '=', 'data_transactions.id')
            ->join('detail_transactions as t2', 't2.data_transaction_id', '=', 'data_transactions.id')
            ->where('t1.item_code', '<', 't2.item_code')
            ->where('t1.item_code', '!=', 't2.item_code')
            ->where('data_transactions.date', '>=', $date_start)
            ->where('data_transactions.date', '<=', $date_end)
            ->where('t1.item_code', $item_codes[0])
            ->where('t2.item_code', $item_codes[1])
            ->groupBy('t1.item_code', 't2.item_code')
            ->selectRaw('COUNT(t1.data_transaction_id) as frequency')
            ->first();

        // Hitung confidence menggunakan rumus
        if ($supportX > 0) {

            $confidence = $this->percentage_number($supportXY['frequency'] / $supportX * 100);

            return $confidence;
        } else {
            return 0; // untuk menghindari pembagian oleh 0 jika supportX = 0
        }
    }

    public function collect_data_itemset($current)
    {
        if (session()->get('k-itemset') <= 1) {
            return ResultItemset::with('combinations')->where('id', $current)->latest()->first();
        } else {
            return ResultItemset::with('combinations')->whereHas('combinations', function ($q) {
                $q->where('item_set_combination', '<>', 0)->where('remark', 1);
            })->where('id', $current)->latest()->first();
        }
    }

    // refactor to service
    public function get_dataset($date_start, $date_end, $minimal_support, $minimal_confidence, $k)
    {
        $items = DetailTransaction::whereHas('transaction', function ($q) use ($date_start, $date_end) {
            $q->where('date', '>=', $date_start)->where('date', '<=', $date_end);
        })->distinct()->get(['item_name', 'item_code'])->toArray();

        $total_transaction = DataTransaction::get_total_transactions($date_start, $date_end);

        $combinations = [];


        if ($k <= 1) {
            $result = ResultItemset::create([
                'date' => now(),
                'item_set_combination' => session()->get('k-itemset') ?? 0
            ]);

            for ($i = 0; $i < count($items); $i++) {
                $frequency = $this->get_frequently($date_start, $date_end, $items[$i]);
                $support_count = $this->get_support_count($frequency, $total_transaction);
                $minimal_support = $this->percentage_number($minimal_support);

                $combinations[$i]['item_code'] = $items[$i]['item_code'];
                $combinations[$i]['item_name'] = $items[$i]['item_name'];
                $combinations[$i]['frequency'] = $frequency;
                $combinations[$i]['support_count'] = $support_count;
                $combinations[$i]['minimal_support'] = $minimal_support;

                if ($support_count >= $minimal_support) {
                    $combinations[$i]['is_passed'] = 1;
                } else {
                    $combinations[$i]['is_passed'] = 0;
                }

                try {
                    DB::beginTransaction();

                    DetailResultItemset::create([
                        'result_itemset_id' => $result->id,
                        'item_set_combination' => $i,
                        'item_codes' => $combinations[$i]['item_code'],
                        'item_names' => $combinations[$i]['item_name'],
                        'frequency' => $combinations[$i]['frequency'],
                        'support_count' => $combinations[$i]['support_count'],
                        'minimal_support' => $combinations[$i]['minimal_support'],
                        'remark' => $combinations[$i]['is_passed'],
                    ]);

                    DB::commit();
                } catch (\Throwable $th) {
                    dd($th->getMessage());
                    DB::rollBack();
                }
            }

            if (!session()->has('current_apriori_id')) {
                session()->put('current_apriori_id', $result->id);
            }

            return $combinations;
        }

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

        $passed_combines = [];
        $current_dataset = $this->collect_data_itemset(session()->get('current_apriori_id'));

        foreach ($current_dataset->combinations as $new) {
            if ($new['remark'] == 1) {
                array_push($passed_combines, $new);
            }
        }
        generateCombinations(0, [], $k, $passed_combines, $combinations);

        $i = 0;
        $result_combines = [];
        $result_2 = ResultItemset::create([
            'date' => now(),
            'item_set_combination' => session()->get('k-itemset') ?? 0
        ]);

        foreach ($combinations as $combination) {
            $item_code = [];
            $item_name = [];
            foreach ($combination as $item) {
                if (!in_array($item['item_codes'], $item_code)) {
                    array_push($item_code, $item['item_codes']);
                    array_push($item_name, $item['item_names']);
                }
            }

            if (count($item_code) < session()->get('k-itemset')) {
                unset($item_code);
                unset($item_name);
            } else {
                $frequency = $this->get_frequently($date_start, $date_end, $item_code)['frequency'] ?? 0;
                $support_count = $this->get_support_count($frequency, $total_transaction);
                $minimal_support = $this->percentage_number($minimal_support);

                $result_combines[$i]['item_code'] = implode(',', $item_code);
                $result_combines[$i]['item_name'] = implode(',', $item_name);
                $result_combines[$i]['frequency'] = $frequency;
                $result_combines[$i]['support_count'] = $support_count;
                $result_combines[$i]['minimal_support'] = $minimal_support;

                if ($support_count >= $minimal_support) {
                    $result_combines[$i]['is_passed'] = 1;
                } else {
                    $result_combines[$i]['is_passed'] = 0;
                }

                try {
                    DB::beginTransaction();

                    for ($k = 0; $k < count(explode(',', $result_combines[$i]['item_code'])); $k++) {
                        DetailResultItemset::firstOrCreate([
                            'result_itemset_id' => $result_2->id,
                            'item_set_combination' => $i,
                            'item_codes' => explode(',', $result_combines[$i]['item_code'])[$k],
                            'item_names' => explode(',', $result_combines[$i]['item_name'])[$k],
                            'frequency' => $result_combines[$i]['frequency'],
                            'support_count' => $result_combines[$i]['support_count'],
                            'minimal_support' => $result_combines[$i]['minimal_support'],
                            'remark' => $result_combines[$i]['is_passed'],
                        ]);
                    }

                    DB::commit();
                } catch (\Throwable $th) {
                    dd($th->getMessage());
                    DB::rollBack();
                }

                $i++;
            }
        }

        if (session()->has('current_apriori_id')) {
            session()->forget('current_apriori_id');
            session()->put('current_apriori_id', $result_2->id);
        }

        return collect($result_combines);
    }

    public function get_frequently($date_start, $date_end, $data)
    {
        if (isset($data['item_code'])) {
            $item_codes[] = $data['item_code'];
        } else {
            $item_codes = $data;
        }

        if (count($item_codes) <= 1) {
            $count = DataTransaction::with('detail_transaction')->whereHas('detail_transaction', function ($q) use ($item_codes) {
                $q->whereIn('item_code', $item_codes);
            })->where('date', '>=', $date_start)->where('date', '<=', $date_end)->count();

            return $count;
        } else {
            $count = DataTransaction::select('t1.item_code as item1', 't2.item_code as item2')
                ->join('detail_transactions as t1', 't1.data_transaction_id', '=', 'data_transactions.id')
                ->join('detail_transactions as t2', 't2.data_transaction_id', '=', 'data_transactions.id')
                ->where('t1.item_code', '<', 't2.item_code')
                ->where('t1.item_code', '!=', 't2.item_code')
                ->where('data_transactions.date', '>=', $date_start)
                ->where('data_transactions.date', '<=', $date_end)
                ->where('t1.item_code', $item_codes[0])
                ->where('t2.item_code', $item_codes[1])
                ->groupBy('t1.item_code', 't2.item_code')
                ->selectRaw('COUNT(t1.data_transaction_id) as frequency')
                ->first();


            return $count ?? 0;
        }
    }

    public function get_support_count($frequently, $total_transaction): float
    {
        return $this->percentage_number(($frequently / $total_transaction) * 100);
    }

    // refactor to helper function
    public function percentage_number($number): float
    {
        return number_format((float)$number, 2, '.', '');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AprioriRequest;
use App\Models\DataTransaction;
use App\Models\DetailTransaction;
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

        $data['title'] = $k;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['support'] = $minimal_support;
        $data['confidence'] = $minimal_confidence;
        $data['total_transaction'] = $total_transaction;

        return view('admin.apriori.itemset', $data);
    }

    public function apriori_get(): JsonResponse
    {
        if (request()->ajax()) {
            $date_start = request('date_start');
            $date_end = request('date_end');
            $minimal_support = (int) request('minimal_support');
            $minimal_confidence = (int) request('minimal_confidence');
            $k = session()->get('k-itemset');

            $dataset = $this->get_dataset($date_start, $date_end, $minimal_support, $minimal_confidence, $k);

            $datatable =  DataTables::collection($dataset);

            $no = 1;
            $datatable->addColumn('No', function ($dataset) use ($no) {
                $no++;
                return $no;
            })
                ->addColumn('Item Code', function ($dataset) {
                    return $dataset['item_code'];
                })
                ->addColumn('Item Name', function ($dataset) {
                    return $dataset['item_name'];
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
                    if ($dataset['is_passed'] == 1) {
                        $remark = '<span class="text-white badge text-bg-success">Lolos</span>';
                    } else {
                        $remark = '<span class="text-white badge text-bg-danger">Tidak Lolos</span>';
                    }

                    return $remark;
                });

            return $datatable->rawColumns(['Remark'])->make(true);
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
            }

            if (!session()->has('new_combinations')) {
                session()->push('new_combinations', $combinations);
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

        foreach (session()->get('new_combinations') as $new) {
            foreach ($new as $n) {
                if ($n['is_passed'] == 1) {
                    array_push($passed_combines, $n);
                }
            }
        }

        generateCombinations(0, [], $k, $passed_combines, $combinations);

        $i = 0;
        $result_combines = [];
        foreach ($combinations as $combination) {
            $item_code = [];
            $item_name = [];
            foreach ($combination as $item) {
                array_push($item_code, $item['item_code']);
                array_push($item_name, $item['item_name']);
            }

            $frequency = $this->get_frequently($date_start, $date_end, $item_code)['frequency'] ?? 0;
            $support_count = $this->get_support_count($frequency, $total_transaction);
            $minimal_support = $this->percentage_number($minimal_support);

            $result_combines[$i]['item_code'] = implode(', ', $item_code);
            $result_combines[$i]['item_name'] = implode(', ', $item_name);
            $result_combines[$i]['frequency'] = $frequency;
            $result_combines[$i]['support_count'] = $support_count;
            $result_combines[$i]['minimal_support'] = $minimal_support;

            if ($support_count >= $minimal_support) {
                $result_combines[$i]['is_passed'] = 1;
            } else {
                $result_combines[$i]['is_passed'] = 0;
            }

            $i++;
        }

        return collect($result_combines);
    }

    public function get_sample_transactions($date_start, $date_end, $minimal_support, $dataset, $size, $total_transaction, $combinations = array())
    {
        if ($size === 1) {
            $i = 0;
            $new_data = [];

            foreach ($dataset as $data) {
                $frequently = $this->get_frequently($date_start, $date_end, $data);
                $support_each_items = $this->get_support_count($frequently, $total_transaction);
                if ($support_each_items >= $minimal_support) {
                    $new_data[$i]['item_code'] = $data['item_code'];
                    $new_data[$i]['item_name'] = $data['item_name'];
                    $new_data[$i]['frequently'] = $frequently;
                    $new_data[$i]['support_count'] = $support_each_items;
                    $new_data[$i]['minimal_support'] = $this->percentage_number($minimal_support);
                    $i++;
                }
            }

            return $new_data;
        }

        $new_combinations = array();

        $itemset_combinations = [];
        $j = 0;
        dd($dataset);
        foreach ($dataset as $combination) {
            $result_combine = DetailTransaction::select('item_code', 'item_name')->distinct()->where('item_code', '<>', $combination['item_code'])->get(['item_code']);

            $i = 0;
            foreach ($result_combine as $data) {
                $itemset_combinations[$j]['item_code'] = $combination['item_code'] . ',' . $data['item_code'];
                $itemset_combinations[$j]['item_name'] = $combination['item_name'] . ',' . $data['item_name'];
                $i++;
            }
            $j++;
        }

        $index = 0;
        foreach ($itemset_combinations as $itemset) {
            $frequently = $this->get_frequently($date_start, $date_end, $itemset);
            $support_each_items = $this->get_support_count($frequently, $total_transaction);
            $minimal_support = $this->percentage_number($minimal_support);
            $new_combinations[$index]['item_code'] = $itemset['item_code'];
            $new_combinations[$index]['item_name'] = $itemset['item_name'];
            $new_combinations[$index]['frequently'] = $frequently;
            $new_combinations[$index]['support_count'] = $support_each_items;
            $new_combinations[$index]['minimal_support'] = $minimal_support;
            $index++;
        }

        session()->put('itemset', $new_combinations);

        return $new_combinations;
    }

    public function get_frequently($date_start, $date_end, $data)
    {
        if (isset($data['item_code'])) {
            $item_codes[] = $data['item_code'];
        } else {
            $item_codes = $data;
        }

        // $wheres = [];
        // $i = 0;
        // foreach($item_codes as $item_code) {
        //     $wheres[$i] = ['item_code', '=', $item_code];
        //     $i++;
        // }

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

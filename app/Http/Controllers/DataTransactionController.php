<?php

namespace App\Http\Controllers;

use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataTransactionController extends Controller
{
    //
    public function index()
    {
        return view('admin.data-transaction.index');
    }

    public function get_data()
    {
        if (request()->ajax()) {
            $model = DataTransaction::filter();

            $datatable =  DataTables::eloquent($model);

            $datatable
                ->addColumn('Date', function ($model) {
                    $d = Carbon::parse($model->date)->translatedFormat('Y-m-d');
                    return $d;
                })
                ->addColumn('TC', function ($model) {
                    return $model->transaction_code;
                })
                ->addColumn('IN', function ($model) {
                    $item_names = DetailTransaction::where('transaction_code', $model->transaction_code)->get();

                    $item = "";

                    if ($item_names) {
                        foreach ($item_names as $detail => $key) {
                            $item .= $key->item_name . ',';
                        }

                        return $item;
                    }


                    return '-';
                })
                ->addColumn('QTY', function ($model) {
                    $qty = 0;
                    $items = DetailTransaction::where('transaction_code', $model->transaction_code)->get();

                    if ($items) {
                        foreach ($items as $item) {
                            $qty += $item->quantity;
                        }

                        return $qty;
                    }

                    return '-';
                });

            return $datatable->make(true);
        }
    }
}

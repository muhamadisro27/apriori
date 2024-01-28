<?php

namespace App\Http\Controllers;

use App\Imports\DataTransactionImport;
use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
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

                    $item = "";

                    if ($model->detail_transaction) {
                        foreach ($model->detail_transaction as $detail => $key) {
                            $item .= $key->item_name . ', ';
                        }

                        return Str::title($item);
                    }

                    return '-';
                })
                ->addColumn('QTY', function ($model) {
                    $qty = 0;

                    if ($model->detail_transaction) {
                        foreach ($model->detail_transaction as $item) {
                            $qty += $item->quantity;
                        }

                        return $qty;
                    }

                    return '-';
                });

            return $datatable->make(true);
        }
    }

    public function import(Request $request)
    {
        $response = [];

        try {
            //code...
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            // import data
            Excel::import(new DataTransactionImport, $request->file('file'));

            $response = [
                'status' => Response::HTTP_OK,
                'message' => 'Successfully imported data transactions !'
            ];
        } catch (\Throwable $th) {
            $response = [
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => $th->getMessage(),
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Service\CommandSQL;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function __construct(protected CommandSQL $command_sql)
    {
        $this->command_sql = $command_sql;
    }

    public function index(): View
    {
        return view('admin.item.table');
    }

    public function get_data(): JsonResponse
    {
        if (request()->ajax()) {
            $model = Item::filter();

            $datatable =  DataTables::eloquent($model);

            $no = 1;
            $datatable->addColumn('No', function ($dataset) use ($no) {
                $no++;
                return $no;
            })
                ->addColumn('Action', 'admin.item.action')
                ->addColumn('Item Name', function ($model) {
                    return $model->item_name;
                })
                ->addColumn('Item Code', function ($model) {
                    return $model->item_code;
                });

            return $datatable->rawColumns(['Action'])->make(true);
        }
    }


    public function form(Item $item): View
    {
        return view('admin.item.form', compact('item'));
    }

    public function save(ItemRequest $request, Item $item): JsonResponse
    {
        $request_data = [
            'item_name' => trim($request->item_name),
            'item_code' => trim($request->item_code),
            'quantity' => trim($request->quantity),
        ];

        $response = $this->command_sql->updateOrCreate($request_data, $item, 'Item');

        return response()->json($response);
    }

    public function destroy(Item $item): JsonResponse
    {
        $response = $this->command_sql->destroy('Item', $item);

        return response()->json($response);
    }

}

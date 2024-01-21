<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'transaction_code',
        'item_name',
        'item_code',
        'quantity'
    ];

    public function detail_transactions()
    {
        return $this->hasMany(DetailTransaction::class, 'transaction_code');
    }

    public static function filter()
    {
        // $transactions = DB::table('data_transactions')
        //     ->join(
        //         'detail_transactions',
        //         'detail_transactions.transaction_code',
        //         '=',
        //         'data_transactions.transaction_code'
        //     )->selectRaw('data_transactions.date,
        //                   data_transactions.transaction_code,
        //                   if(count(detail_transactions.item_name) > 1, concat(detail_transactions.item_name, ",") , detail_transactions.item_name) as items,
        //                   count(detail_transactions.quantity) as total_quantity')
        //     ->groupBy('detail_transactions.transaction_code');

        $transactions = DataTransaction::query()
            ->select('date', 'transaction_code')->orderBy('date', 'desc');

        return $transactions;
    }
}

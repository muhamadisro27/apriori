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

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public static function filter()
    {
        $start = htmlspecialchars(request('date_start')) ?? now()->firstOfMonth()->format('Y-m-d');
        $end = htmlspecialchars(request('date_end')) ?? now()->format('Y-m-d');

        $transactions = DataTransaction::query()->with('detail_transaction', function($q) {
            $q->select('id', 'data_transaction_id' ,'item_name', 'quantity');
        })
        ->select('id', 'date', 'transaction_code', 'created_at')->where('created_at', '>=', $start)->where('created_at', '<=', $end)->orderBy('date', 'desc');

        return $transactions;
    }
}

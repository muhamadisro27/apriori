<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function detail_transaction(): HasMany
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public static function filter()
    {
        $start = htmlspecialchars(request('date_start')) ?? now()->firstOfMonth()->format('Y-m-d');
        $end = htmlspecialchars(request('date_end')) ?? now()->format('Y-m-d');

        $transactions = DataTransaction::query()->with('detail_transaction', function ($q) {
            $q->select('id', 'data_transaction_id', 'item_name', 'quantity');
        })
            ->select('id', 'date', 'transaction_code', 'created_at')->where('date', '>=', $start)->where('date', '<=', $end)->orderBy('date', 'desc');

        return $transactions;
    }

    public static function get_total_transactions($date_start, $date_end): int
    {
        return DataTransaction::where('date', '>=', $date_start)->where('date', '<=', $date_end)->count();
    }
}

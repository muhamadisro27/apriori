<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_transaction_id',
        'item_code',
        'item_name',
        'quantity'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(DataTransaction::class, 'data_transaction_id');
    }
}

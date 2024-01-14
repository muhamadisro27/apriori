<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'transaction_code',
        'item_code',
        'item_name',
        'quantity'
    ];
}

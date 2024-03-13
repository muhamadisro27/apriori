<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'item_name',
        'item_code',
        'quantity'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function filter()
    {
        $items = Item::query();

        return $items;
    }
}

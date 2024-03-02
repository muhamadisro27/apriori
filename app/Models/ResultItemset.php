<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResultItemset extends Model
{
    use HasFactory;

    protected $table = 'result_itemsets';

    protected $fillable = [
        'date',
        'item_set_combination'
    ];

    public function combinations(): HasMany
    {
        return $this->hasMany(DetailResultItemset::class);
    }
}

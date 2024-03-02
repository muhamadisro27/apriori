<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailResultItemset extends Model
{
    use HasFactory;

    protected $table = 'detail_result_itemsets';

    protected $fillable = [
        'result_itemset_id',
        'item_set_combination',
        'item_codes',
        'item_names',
        'frequency',
        'support_count',
        'minimal_support',
        'remark'
    ];

    public function itemset(): BelongsTo
    {
        return $this->belongsTo(ResultItemset::class, 'result_itemset_id');
    }
}

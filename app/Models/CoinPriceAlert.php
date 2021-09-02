<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinPriceAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'coin_id',
        'target_price',
        'price_on_set_date',
        'percentage_range',
        'note'
    ];

    /**
     * RELATIONSHIPS
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * SCOPES
     */

    /**
      * Scope a query to only include alerts for a coin with given Id
      *
      * @param  \Illuminate\Database\Eloquent\Builder  $query
      * @param  String  $coinId
      * @return \Illuminate\Database\Eloquent\Builder
      */
    
    public function scopeCoinId($query, $coinId)
    {
        return $query->where('coin_id', $coinId);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinPriceHistory extends Model
{
    use HasFactory;
    protected $fillable = ['coin_id', 'price', 'price_change_percentage_24h'];


}

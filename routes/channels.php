<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\CoinPriceHistory;
use App\Models\CoinPriceAlert;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//broadcast price change to all authenticated users, so that
Broadcast::channel('coin-price-changed', function ($user) {
    // return auth()->check();
    return true;
});

Broadcast::channel('alert.{coinId}', function ($user, $coinId) {
    
    //as this is triggered when new coin data is saved in coin_price_histories, we can get current price from there
    $historyRecord = CoinPriceHistory::where('coin_id', $coinId)->latest()->first();
    if(!$historyRecord) return false;

    $currentPrice = $historyRecord->price;
    return $user->coinPriceAlerts()->coinId($coinId)->where('target_price', '<=', $currentPrice)->count();
});
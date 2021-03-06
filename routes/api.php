<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinPriceAlertController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/user/alerts' , [CoinPriceAlertController::class, 'index'])->name('coin-price-alerts.index');
    Route::post('/user/alerts' , [CoinPriceAlertController::class, 'store'])->name('coin-price-alerts.store');
    Route::delete('/user/alerts' , [CoinPriceAlertController::class, 'destroy'])->name('coin-price-alerts.destroy');

});
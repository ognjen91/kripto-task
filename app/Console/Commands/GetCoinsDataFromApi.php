<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CoinPriceHistory;



class GetCoinsDataFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get coins data from Coingecko Api and store to DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&=,,&?order=market_cap_asc&per_page=10&page=1');
        if($response->status() == 200){
            $coins = json_decode($response->body());
            foreach($coins as $coin){
                CoinPriceHistory::create([
                    'coin_id' => $coin->id,
                    'price' => $coin->current_price,
                    'price_change_percentage_24h' => $coin->price_change_percentage_24h
                ]);
            }
            return true;
        } else {
            echo 'Network error';
        }

        return false;
    }
}

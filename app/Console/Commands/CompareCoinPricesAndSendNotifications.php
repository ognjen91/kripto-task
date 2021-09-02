<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CoinPriceHistory;

class CompareCoinPricesAndSendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:compare-prices-and-delete-old-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get current and previous price of coins and send notification about price change via websocket';

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
        //first, let's get all records from the db at once and save some db calls
        $allCoins = CoinPriceHistory::all();
        
        //get unique coin_id
        $uniqueCoins = $allCoins->unique('coin_id')->pluck('coin_id');

        $uniqueCoins->each(function($coinId) use ($allCoins){
            // dd($allCoins);
            $coinRecords = $allCoins->where('coin_id', $coinId)->all(); //get all the records with that exact id
            // now, if there are two records, compare prices
            if(count($coinRecords) == 2){
                $records = array_values($coinRecords); //as we have assoc array and we can't use $coinRecords[0] & $coinRecords[1]
                $previousRecord = $records[0];
                $currentRecord = $records[1];
                if($previousRecord->price !== $currentRecord->price){

                    //finaly, delete previous record
                    // $previousRecord->delete();
                } 

            }
        });
        // dd($coins); 
    }
}

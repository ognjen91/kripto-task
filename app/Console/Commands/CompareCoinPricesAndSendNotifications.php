<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CoinPriceHistory;
use App\Events\CoinPriceChanged;

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
        
        //get unique coin_ids, e.g.['bitcoin', 'dogecoins', ...]
        $uniqueCoins = $allCoins->unique('coin_id')->pluck('coin_id');

        // IDEA: Iterate through array of unique ids and compare last two records
        // if the price has change, send notifications via websocket
        // at the end, delete previous reason for the reason of optimization

        // But first, JUST IN CASE!!!
        // if there is more than 2 records, delete all but the last two
        if (count($coinRecords) > 2) {
            $records = array_values($coinRecords); //as we have assoc array and we can't use $coinRecords[0] & $coinRecords[1]
            for($i=0; $i<count($records - 1); $i++){
                $records[$i]->delete();
            }
        }

        $uniqueCoins->each(function($coinId) use ($allCoins){
            $coinRecords = $allCoins->where('coin_id', $coinId)->all(); //get all the records with that exact id
            // now, if there are two records, compare prices
            if(count($coinRecords) == 2){
                $records = array_values($coinRecords); //as we have assoc array and we can't use $coinRecords[0] & $coinRecords[1]
                $previousRecord = $records[0];
                $currentRecord = $records[1];
                if($previousRecord->price !== $currentRecord->price){
                    broadcast(new CoinPriceChanged($previousRecord, $currentRecord));
                } 
                //finaly, delete previous record
                $previousRecord->delete();
            }
            

        });
        // dd($coins); 
    }
}

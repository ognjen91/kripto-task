<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CoinPriceHistory;
use App\Models\CoinPriceAlert;

class DatabaseSeeder extends Seeder
{
    private $coins = [
        'bitcoin',
        'ethereum',
        'cardano',
        'binancecoin',
        'tether',
        'ripple',
        'dogecoin',
        'solana',
        'polkadot',
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->coins as $coin){
            CoinPriceHistory::factory()->create([
                'coin_id' => $coin
            ]);
        }

        User::factory()->create([
            'name' => 'Ognjen',
            'email' => 'qzman16@gmail.com',
            'password' => \bcrypt('123456')
        ]);

        User::factory()->create([
            'name' => config('app.defaultUsername'),
            'password' => config('app.defaultUserPassword'),
            'email' => config('app.defaultUserEmail')
        ]);

        CoinPriceAlert::factory()->create([
            'target_price' => 35000
        ]);
    }
}

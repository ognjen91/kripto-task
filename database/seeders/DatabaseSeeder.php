<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoinPriceHistory;

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
        \App\Models\User::factory()->create([
            'name' => 'Ognjen',
            'email' => 'qzman16@gmail.com',
            'password' => \bcrypt('123456')
        ]);
    }
}

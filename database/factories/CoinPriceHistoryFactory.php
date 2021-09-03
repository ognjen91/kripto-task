<?php

namespace Database\Factories;

use App\Models\CoinPriceHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoinPriceHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoinPriceHistory::class;
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
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'coin_id' => $this->faker->randomElement($this->coins),
            'price' => rand(1,1000000),
            'price_change_percentage_24h' => rand(0,100)
        ];
    }
}

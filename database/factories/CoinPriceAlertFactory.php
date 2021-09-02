<?php

namespace Database\Factories;

use App\Models\CoinPriceAlert;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoinPriceAlertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoinPriceAlert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'coin_id' => 'bitcoin',
            'target_price' => rand(5, 100000),
            'price_on_set_date' => rand(5, 100000),
            'percentage_range' => rand(-30, 30)
        ];
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\CoinPriceHistory;


class CoinPriceChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $coinId;
    public $previousPrice;
    public $currentPrice;
    public $priceChangePercentage24h;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CoinPriceHistory $previousRecord, CoinPriceHistory $currentRecored)
    {
        $this->coinId = $previousRecord->coin_id;
        $this->previousPrice = $previousRecord->price;
        $this->currentPrice = $currentRecored->price;
        $this->priceChangePercentage24h = $currentRecored->price_change_percentage_24h;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [
            new Channel('coin-price-changed'),
            new PrivateChannel('alert.'.$this->coinId)
        ];
    }
}

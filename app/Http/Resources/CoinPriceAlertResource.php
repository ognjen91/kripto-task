<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CoinPriceAlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'coinId' => $this->coin_id,
            'percentageRange' => $this->percentage_range,
            'price' => $this->price,
            'createdAt' => Carbon::parse($this->created_at)->format('d M Y H:i')
        ];
    }
}

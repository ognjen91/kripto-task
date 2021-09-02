<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinPriceAlertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST'){
            return [
                'coin_id' => 'required|string',
                'target_price' => 'required|numeric',
                'price_on_set_date' => 'required|numeric',
                'percentage_range' => 'nullable|numeric',
                'note' => 'nullable'
            ];
        }
    }
}

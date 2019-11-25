<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuctionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'item.*.starts_at' => 'nullable|date',
            'item.*.ends_at' => 'nullable|date',
            'item.*.min_price' => 'nullable|integer|min:0',
        ];
    }
}

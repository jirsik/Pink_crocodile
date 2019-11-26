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
    public static function rules($request)
    {
        $available_items = count($request->input('item', []));
        
        $rules = [];
        for ($i = 0; $i < $available_items; $i++) {
            if ($request->input('item')[$i]['id'] != 0) {
                $rules['item.'.$i.'.starts_at'] = 'nullable|date|after_or_equal:starts_at|before:ends_at';
                $rules['item.'.$i.'.ends_at'] = 'nullable|date|after:item.'.$i.'.starts_at|before_or_equal:ends_at';
                $rules['item.'.$i.'.min_price'] = 'nullable|integer|min:0';
            }
        }

        return $rules;
    }
}

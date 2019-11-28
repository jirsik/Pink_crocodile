<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\DonerRequest;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\EventRequest;
use App\Http\Requests\AuctionRequest;


class FinalRequest extends FormRequest
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
    public function rules(Request $request)
    {   
        switch ($request->input('form')) {
            case 'item': if ($request->input('doner_id') === 'new' ) {
                            $result = array_merge(DonerRequest::rules(), ItemRequest::rules());
                        } else {
                            $result = ItemRequest::rules();
                        }
                        break;
            case 'doner': $result = DonerRequest::rules();
                        break;
            case 'event': $result = EventRequest::rules($request);
                        break;
            case 'auction': $result = array_merge(EventRequest::rules($request), AuctionRequest::rules($request));
                        break;
            default: $result = [];
        }
                
        return $result;
    }
    
    public function messages()
    {
        return [
                'item.*.starts_at.date' => 'Incorrect date format.',
                'item.*.starts_at.after_or_equal' => 'Auction can not start befor the event starts.',
                'item.*.starts_at.before' => 'Auction can not start after the end of event.',
                'item.*.ends_at.date' => 'Incorrect date format.',
                'item.*.ends_at.after' => 'Auction can not end before it starts.',
                'item.*.ends_at.before_or_equal' => 'Auction can not last longer then the event.',
                'item.*.min_price.integer' => 'Price must be a positive number',
                'item.*.min_price.min' => 'Price must be a positive number',
            ];
    }
}

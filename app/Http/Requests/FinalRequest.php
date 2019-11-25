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
            case 'event': $result = EventRequest::rules();
                        break;
            case 'auction': $result = array_merge(EventRequest::rules(), AuctionRequest::rules());
                        break;
            default: $result = [];
        }
                
        return $result;
    }
}

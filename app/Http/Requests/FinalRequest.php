<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\DonerRequest;
use App\Http\Requests\ItemRequest;

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
        if ($request->input('form') === 'item') {
            if ($request->input('doner_id') === 'new' ) {
                $result = array_merge(ItemRequest::rules(), DonerRequest::rules());
            } else {
                $result = ItemRequest::rules();
            }
        } elseif ($request->input('form') === 'doner') {
            $result = DonerRequest::rules();
        } else {
            $result = [];
        }
        return $result;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string|max:35',
            'description' => 'nullable|string|max:500',
            'estimated_price' => 'nullable|integer|max:35',
            'currency' => ['nullable', Rule::in(['CZK', 'EUR', 'USD'])],
            'doner_id' => 'nullable|integer|max:35',
            'photo_path' => 'nullable|string|max:200',
        ];
    }
}

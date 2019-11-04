<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonerRequest extends FormRequest
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
        // 'name', 'organisation', 'about', 'photo_path'
        return [
            'name' => 'required|string|max:35',
            'link' => 'nullable|url|max:35',
            'about' => 'nullable|string|max:500',
            'contact_name' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:35',
            'email' => 'nullable|email|max:100',
            'doner_photo_path' => 'nullable|string|max:200',
        ];
    }
}

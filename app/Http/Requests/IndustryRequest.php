<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IndustryRequest extends Request
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
            'name' => 'required',
            'email' => 'unique:industry,email|email',
            'phone' => 'unique:industry,phone|numeric',
            'website' => 'unique:industry,website',
            'address' => 'required',
            'lat' => 'numeric',
            'lng' => 'numeric'
        ];
    }
}

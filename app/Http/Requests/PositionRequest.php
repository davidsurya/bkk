<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PositionRequest extends Request
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
            'definition' => 'required',
            'skill' => 'required',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'score' => 'numeric',
            'total' => 'required',
            'min_age' => 'required|numeric',
            'max_age' => 'required|numeric',
            'location' => 'required'
        ];
    }
}

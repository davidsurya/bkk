<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'username' => 'required|unique:users|numeric',
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'phone' => 'required|unique:users|numeric',
            'birthday' => 'required|date',
            'department_id' => 'required|numeric',
            'graduation' => 'required|numeric',
            'sex' => 'required',
            'password' => 'required|min:6|confirmed'
        ];
    }
}

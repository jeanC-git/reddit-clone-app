<?php

namespace App\Http\Requests\v1\Auth;

use App\Http\Requests\v1\ApiFormRequest;

class AuthRegisterRequest extends ApiFormRequest
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
            'last_name' => 'required',
            'email' => 'required|string|email|unique:app_users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable'
        ];
    }
}

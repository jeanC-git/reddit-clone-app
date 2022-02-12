<?php

namespace App\Http\Requests\v1\Thread;


use App\Http\Requests\v1\ApiFormRequest;

class ThreadListRequest extends ApiFormRequest
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
            'no_paginate' => 'nullable',
            'paginate' => 'nullable',

            'search' => 'nullable',
            'fields' => 'nullable',

            'app_user_id' => 'nullable',
        ];
    }

    public function prepareForValidation()
    {
        if (!in_array('my-threads', request()->segments())):
            $data['app_user_id'] = auth()->user()->id;
            return $this->merge($data);
        endif;
    }
}

<?php

namespace App\Http\Requests\v1\Post;


use App\Http\Requests\v1\ApiFormRequest;

class PostListRequest extends ApiFormRequest
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
        // TODO: Mejorar validación para detectar API: My Threads
        // TODO: o duplicar Request para esa API en específico
        if (in_array('my-posts', request()->segments())):
            $data['app_user_id'] = auth()->user()->id;
            return $this->merge($data);
        endif;
    }
}

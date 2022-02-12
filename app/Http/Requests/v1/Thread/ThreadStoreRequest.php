<?php

namespace App\Http\Requests\v1\Thread;

use App\Http\Requests\v1\ApiFormRequest;

class ThreadStoreRequest extends ApiFormRequest
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
            'title' => 'required|string|min:20|max:100',
            'text' => 'required|string|min:20|max:250',
            'app_user_id' => 'required|exists:app_users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $app_user = auth()->user();
        $data['app_user_id'] = $app_user->id;

        return $this->merge($data)->all();
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
        return  [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'emails' => 'array|required',
            'emails.*' => 'email|required',
            'phones' => 'array|required',
            'phones.*' => 'regex:/^\+\d+\(\d+\)[\d-]+$/',
        ];
    }
}

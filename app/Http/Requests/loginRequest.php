<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'emailForLogin' => 'required' ,
            'passwordForLogin' => 'required'
        ];
    }
}

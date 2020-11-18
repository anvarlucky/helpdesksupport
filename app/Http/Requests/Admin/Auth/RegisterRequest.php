<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required|min:3|max:30',
            'lastname' => 'required|min:3|max:30',
            'surname' => 'required|min:3|max:30',
            'email' => 'email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required|min:1|max:3',
            'login' =>  'required|min:3|max:20|unique:users,login',
        ];
    }
}

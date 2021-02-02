<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'firstname' => 'required|min:5',
            'lastname' => 'required|min:5',
            'surname' => 'required|min:1',
            'role_id' => 'required|int',
            'login' => 'required|min:5|unique:users,login',
            'email' => 'required|min:5|unique:users,email',
            'password' => 'required'
        ];
    }
}

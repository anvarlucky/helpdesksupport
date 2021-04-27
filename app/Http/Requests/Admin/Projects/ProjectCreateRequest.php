<?php

namespace App\Http\Requests\Admin\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
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
            'name' => 'unique:projects,name|min:3|required',
            'url' => 'required|min:11|unique:projects,url',
        ];
    }
}

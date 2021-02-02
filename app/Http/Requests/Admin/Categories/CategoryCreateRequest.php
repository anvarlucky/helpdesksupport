<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name.uz' => 'required|min:3|max:255|unique:categories,name->uz',
            'name.ru' => 'required|min:3|max:255|unique:categories,name->ru',
            'name.en' => 'required|min:3|max:255|unique:categories,name->en',
        ];
    }
}

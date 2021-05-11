<?php

namespace App\Http\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class FaqCreateRequest extends FormRequest
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
            'title.uz' => 'required|min:3|max:255|alpha|unique:faqs,title->uz',
            'title.ru' => 'required|min:3|max:255|alpha|unique:faqs,title->ru',
            'title.en' => 'required|min:3|max:255|alpha|unique:faqs,title->en',
            'text.uz' => 'required|min:3|max:255|unique:faqs,text->uz',
            'text.ru' => 'required|min:3|max:255|unique:faqs,text->ru',
            'text.en' => 'required|min:3|max:255|unique:faqs,text->en',
        ];
    }
}

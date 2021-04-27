<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateReqest extends FormRequest
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
            'title' => 'required|min:5|max:100',
            'description' => 'required|min:5|max:150',
            'screenshot' => 'max:2048'
        ];
    }
}

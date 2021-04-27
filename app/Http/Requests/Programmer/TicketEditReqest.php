<?php

namespace App\Http\Requests\Programmer;

use Illuminate\Foundation\Http\FormRequest;

class TicketEditReqest extends FormRequest
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
            'description_to_client' => 'required|min:5|max:100',
            'screenshot_to_client' => 'max:2048',
        ];
    }
}

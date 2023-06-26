<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAudioBookRequest extends FormRequest
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
            'book_id' => ['required'],
            'organization_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'book_id.required' => __('audiobook.please_enter_book'),
            'organization_id.required' => __('audiobook.please_enter_organization'),
        ];
    }
}

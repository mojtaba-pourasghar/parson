<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationRequest extends FormRequest
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
            'description' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'book_id.required' => __('awardbook.please_enter_book'),
            'description.required' => __('awardbook.please_enter_description'),
        ];
    }
}

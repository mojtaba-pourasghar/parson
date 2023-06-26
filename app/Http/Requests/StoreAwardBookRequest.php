<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAwardBookRequest extends FormRequest
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
            'award_id' => ['required'],
            'year' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'book_id.required' => __('awardbook.please_enter_book'),
            'award_id.required' => __('awardbook.please_enter_award'),
            'year.required' => __('awardbook.please_enter_year'),
        ];
    }
}

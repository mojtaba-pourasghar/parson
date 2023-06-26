<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAwardPersonRequest extends FormRequest
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
            'person_id' => ['required'],
            'award_id' => ['required'],
            'year' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'person_id.required' => __('awardperson.please_enter_person'),
            'award_id.required' => __('awardperson.please_enter_award'),
            'year.required' => __('awardperson.please_enter_year'),
        ];
    }
}

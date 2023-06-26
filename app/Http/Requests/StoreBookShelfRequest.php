<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookShelfRequest extends FormRequest
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

    public function rules()
    {
        return [
            'book_id' => ['required'],
            'user_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'book_id.required' => __('bookshelf.please_enter_book'),
            'user_id.required' => __('bookshelf.please_enter_user'),
        ];
    }
}

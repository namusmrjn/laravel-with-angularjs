<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreQuotePostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quote' => 'required|string',
            'author' => 'required|string',
            'image' => 'required|url'
        ];
    }
}

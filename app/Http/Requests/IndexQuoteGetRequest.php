<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IndexQuoteGetRequest extends Request
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
            'sp' => 'integer|min:0' // sp should be an integer larger or equals to 0 if it presents
        ];
    }
}

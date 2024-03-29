<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookNowRequest extends FormRequest
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
            'property_id'           => ['required'],
            'bedroom_id'            => ['required'],
            'living_condition'      => ['required'],
            'length'                => ['required'],
            'price'                 => ['required']
        ];
    }
}

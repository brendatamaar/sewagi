<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProperyStep5Request extends FormRequest
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
            'amenity_id'     => ['required'],
            'furniture'     => ['required'],
            'step'     => ['required'],
            'facility_id'     => ['required'],
        ];
    }
}

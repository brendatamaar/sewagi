<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCommunityRequest extends FormRequest
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
            'first_name'            => ['required', 'string', 'max:255'],
            'last_name'             => ['required', 'string', 'max:255'],
            'phone_number'          => ['required', 'string', 'max:255'],      
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'area_live'             => ['required', 'string', 'max:255'],
            'area_practice'         => ['required', 'string', 'max:255'],
            'employment_status'     => ['required', 'string', 'max:255'],
            'working_field'         => ['required', 'string', 'max:255'],
            'latest_education'      => ['required', 'string', 'max:255'],
            'english_spoken'        => ['required', 'string', 'max:255'],
            'english_written'       => ['required', 'string', 'max:255'],
            'description'           => ['max:180']
        ];
    }
}

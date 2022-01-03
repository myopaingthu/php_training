<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'major' => 'required',
            'phone' => [
                'required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15', 'ends_with:0,1,2,3,4,5,6,7,8,9',
                function ($attribute, $value, $fail) {
                    if (Str::substrCount($value, '-',) > 1) {
                        $fail('The ' . $attribute . ' number must contain only one special character');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (Str::substrCount($value, '+',) > 1) {
                        $fail('The ' . $attribute . ' number must contain only one special character');
                    }
                },
            ],
            'address' => 'required',
            'dob' => 'required|before:today'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.regex' => 'Please enter real phone number',
            'dob.required' => 'The date of birth field is required'
        ];
    }
}

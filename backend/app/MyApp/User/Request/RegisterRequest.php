<?php

namespace App\MyApp\User\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'status' => 'required|string',
            'phone' => 'required|int',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required!',
            'last_name.required' => 'Last name is required!',
            'email.required' => 'Status is required!',
            'password.required' => 'Password is required!',
            'status.required' => 'Status is required!',
            'phone.required' => 'Phone is required!',
            'date_of_birth.required' => 'Date of birth is required!',
            'address.required' => 'Address is required!',
            'gender.required' => 'Gender is required!',
        ];
    }
}

<?php

namespace App\MyApp\Grade\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinalGradeRequest extends FormRequest
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
            'id' => 'required|int',
            'first_term' => 'regex:/^\d+(\.\d{1,2})?$/|nullable',
            'first_repeat' => 'regex:/^\d+(\.\d{1,2})?$/|nullable',
            'second_repeat' => 'regex:/^\d+(\.\d{1,2})?$/|nullable',
            'committee' => 'regex:/^\d+(\.\d{1,2})?$/|nullable',
            'promotion' => 'regex:/^\d+(\.\d{1,2})?$/|nullable',
        ];
    }
}

<?php

namespace App\MyApp\Plan\Request;

use Illuminate\Foundation\Http\FormRequest;

class WeekPlanRequest extends FormRequest
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
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'dateStart.required' => 'Date start is required!',
            'dateEnd.required' => 'Date end is required!',
        ];
    }
}

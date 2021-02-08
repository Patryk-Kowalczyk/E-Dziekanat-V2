<?php

namespace App\MyApp\Message\Request;

use Illuminate\Foundation\Http\FormRequest;

class ShowByIdMessageRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Message ID is required!',
        ];
    }
}

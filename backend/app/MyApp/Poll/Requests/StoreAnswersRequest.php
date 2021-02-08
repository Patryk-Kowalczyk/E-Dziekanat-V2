<?php

namespace App\MyApp\Poll\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswersRequest extends FormRequest
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
            '*.poll_id' => 'required|int',
            '*.question_id' => 'required|int',
            '*.answer_id' => 'required|int',
        ];
    }

    public function messages(): array
    {
        return [
            'poll_id.required' => 'Poll ID is required!',
            'question_id.required' => 'Question ID is required!',
            'answer_id.required' => 'Answer ID is required!',
        ];
    }
}

<?php

namespace App\MyApp\Grade\Request;

use Illuminate\Foundation\Http\FormRequest;

class StorePartialGradeRequest extends FormRequest
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
            '*.subject_id' => 'int',
            '*.album' => 'int',
            '*.id'=>'',
            '*.category'=>'string',
            '*.value'=>'regex:/^\d+(\.\d{1,2})?$/',
            '*.comments'=>'string',
            '*.date'=>'date'
        ];
    }

}

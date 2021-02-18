<?php

namespace App\MyApp\Payment\Request;

use App\MyApp\Utility\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ShowByIdPaymentRequest extends FormRequest
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

}

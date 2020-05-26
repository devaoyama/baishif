<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CompanyRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'hourly_rate' => ['required', 'integer', 'min:0', 'max:50000'],
            'holiday_hourly_rate' => ['nullable', 'integer', 'min:0', 'max:50000'],
            'midnight_hourly_rate_increase_rate' => ['nullable', 'integer', 'min:0', 'max:100'],
            'transportation_costs' => ['nullable', 'integer', 'min:0', 'max:50000'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $res = new JsonResponse([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);
        throw new HttpResponseException($res);
    }
}

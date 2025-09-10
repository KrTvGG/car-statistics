<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EventsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Наименование события обязательно для заполнения.',
            'name.max' => 'Наименование события не должно превышать 255 символов.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Ошибка валидации предоставленных данных.',
            'errors' => $validator->errors(),
        ], 422));
    }
}

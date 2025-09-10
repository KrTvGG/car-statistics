<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GuidesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'make' => 'string|max:255',
            'model' => 'string|max:255',
            'year' => 'integer|min:1886|max:' . (date('Y') + 1),
            'engine_capacity' => 'numeric|min:0',
            'power' => 'integer|min:0',
            'body_type' => 'nullable|string|max:100',
            'engine_type' => 'nullable|string|max:100',
            'transmission' => 'nullable|string|max:50',
            'drive_type' => 'nullable|string|max:50',
        ];

        if ($this->isMethod('post')) {
            $rules['make'] = 'required|' . $rules['make'];
            $rules['model'] = 'required|' . $rules['model'];
            $rules['year'] = 'required|' . $rules['year'];
            $rules['engine_capacity'] = 'required|' . $rules['engine_capacity'];
            $rules['power'] = 'required|' . $rules['power'];
        }

        return $rules;
    }

        /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'make.max' => 'Производитель не должен превышать 255 символов.',
            'make.required' => 'Производитель обязателен для заполнения.',
            'model.max' => 'Модель не должна превышать 255 символов.',
            'model.required' => 'Модель обязательна для заполнения.',
            'year.min' => 'Год не должен быть меньше 1886.',
            'year.max' => 'Год не должен превышать ' . (date('Y') + 1) . '.',
            'year.required' => 'Год обязателен для заполнения.',
            'engine_capacity.required' => 'Объем двигателя обязателен для заполнения.',
            'power.required' => 'Мощность обязательна для заполнения.',
            'body_type.max' => 'Тип кузова не должен превышать 100 символов.',
            'engine_type.max' => 'Тип двигателя не должен превышать 100 символов.',
            'transmission.max' => 'Тип трансмиссии не должен превышать 50 символов.',
            'drive_type.max' => 'Тип привода не должен превышать 50 символов.'
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

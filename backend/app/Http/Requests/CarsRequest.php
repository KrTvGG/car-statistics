<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'string|max:255',
            'user_id' => 'integer|exists:users,id',
            'guide_id' => 'integer|exists:guides,id',
            'car_year' => 'integer|min:1886|max:' . (date('Y') + 1),
            'car_color' => 'nullable|string|max:50',
            'vin_number' => 'string|max:17|regex:/^[A-HJ-NPR-Z0-9]{17}$/|unique:cars,vin_number',
            'car_number' => 'string|max:12|unique:cars,car_number'
        ];

        if ($this->isMethod('post')) {
            $rules['name'] = 'required|' . $rules['name'];
            $rules['user_id'] = 'required|' . $rules['user_id'];
            $rules['guide_id'] = 'required|' . $rules['guide_id'];
            $rules['car_year'] = 'required|' . $rules['car_year'];
            $rules['vin_number'] = 'required|' . $rules['vin_number'];
            $rules['car_number'] = 'required|' . $rules['car_number'];
        }

        return $rules;
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'user_id.exists' => 'Выбранного пользователя не существует.',
            'guide_id.exists' => 'Выбранного справочника автомобилей не существует.',
            'car_color.max' => 'Цвет автомобиля не должен превышать 50 символов.',
            'vin_number.size' => 'VIN-номер должен содержать ровно 17 символов.',
            'vin_number.regex' => 'VIN-номер содержит недопустимые символы.',
            'vin_number.unique' => 'VIN-номер уже используется.',
            'car_number.max' => 'Номер автомобиля не должен превышать 12 символов.',
            'car_number.unique' => 'Номер автомобиля уже используется.',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuidesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1886|max:' . (date('Y') + 1),
            'engine_capacity' => 'required|numeric|min:0',
            'power' => 'required|integer|min:0',
            'body_type' => 'nullable|string|max:100',
            'engine_type' => 'nullable|string|max:100',
            'transmission' => 'nullable|string|max:50',
            'drive_type' => 'nullable|string|max:50',
        ];
    }
}
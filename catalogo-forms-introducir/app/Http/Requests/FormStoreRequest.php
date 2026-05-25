<?php

namespace App\Http\Requests\Request;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FormStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'json_data' => 'required|json',
        ];
    }

        public function messages()
        {
            return [
                'json_data.required' => 'El campo JSON es obligatorio.',
                'json_data.json' => 'El campo JSON debe contener un valor JSON válido.',
            ];
        }
}

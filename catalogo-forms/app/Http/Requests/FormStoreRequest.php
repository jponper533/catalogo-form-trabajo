<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombreForm' => 'required|string|max:255',
            'datos' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'nombreForm.required' => 'El nombre del formulario es obligatorio.',
            'nombreForm.string' => 'El nombre del formulario debe ser una cadena de texto.',
            'nombreForm.max' => 'El nombre del formulario no puede exceder los 255 caracteres.',
            'datos.required' => 'Los datos del formulario son obligatorios.',
            'datos.json' => 'Los datos del formulario deben estar en formato JSON válido.',
        ];
    }
}

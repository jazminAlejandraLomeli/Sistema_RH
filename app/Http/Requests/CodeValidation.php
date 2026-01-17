<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeValidation extends FormRequest
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
            'Codigo' => ['required', 'numeric', 'digits:7', 'unique:administrativos,codigo'],

        ];
    }

    public function messages(): array
    {
        return [
            'Codigo.required' => 'El código es requerido',
            'Codigo.numeric' => 'El código debe ser numérico',
            'Codigo.digits' => 'El código debe tener 7 dígitos',
            'Codigo.unique' => 'El código ya esta enlazado a otra persona.',
        ];
    }
}

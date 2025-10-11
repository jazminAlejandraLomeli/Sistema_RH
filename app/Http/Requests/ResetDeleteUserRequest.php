<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetDeleteUserRequest extends FormRequest
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
            'Id' => 'required|numeric|exists:users,id',
            'Status' => 'nullable|in:Activo,Inactivo',
        ];
    }
    public function messages(): array {
        return [
            'Id.required' => 'El ID del usuario es requerido.',
            'Id.numeric' => 'El ID del usuario debe ser numérico.',
            'Id.exists' => 'El ID del usuario no existe en la base de datos.',
            'Status.in' => 'El estado debe ser "activo" o "inactivo".',
        ];
    }
}

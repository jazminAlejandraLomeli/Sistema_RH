<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetCategories extends FormRequest
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
            'Distincion' => ['required', 'numeric', 'in:0,1'],
            'Genero' => ['required', 'numeric', 'in:1,2'],
            'Id_nombramiento' => ['required', 'numeric', 'exists:nombramientos,id'],
        ];
    }

    public function messages()
    {
        return [
            'Distincion.required' => 'El campo distinción es obligatorio.',
            'Distincion.in' => 'El campo distinción debe ser 0 o 1.',
            'Genero.required' => 'El campo género es obligatorio.',
            'Genero.in' => 'El campo género debe ser 1 o 2.',
            'Id_nombramiento.required' => 'El campo ID es obligatorio.',
            'Id_nombramiento.exists' => 'El ID no existe.',
            'Id_nombramiento.numeric' => 'El campo ID debe ser numérico.',
         ];
    }
}

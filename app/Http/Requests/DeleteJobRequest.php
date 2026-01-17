<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteJobRequest extends FormRequest
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
            'Principal' => ['required', 'numeric', 'in:1,0'],
            'Id_work' =>[ 'required','numeric', 'exists:personas_trabajo,id'],
            'Id_worker' =>[ 'required','numeric', 'exists:administrativos,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'Principal.required' => 'El campo tipo nombramiento es obligatorio.',
            'Principal.in' => 'El campo tipo nombramiento debe ser 1 o 0.',
            'Id_work.required' => 'El campo ID trabajo es obligatorio.',
            'Id_work.numeric' => 'El campo ID trabajo debe ser un número.',
            'Id_work.exists' => 'El campo ID trabajo no existe.',
            'Id_worker.required' => 'El campo ID trabajador es obligatorio.',
            'Id_worker.numeric' => 'El campo ID trabajador debe ser un número.',
            'Id_worker.exists' => 'El campo ID trabajador no existe.',
        ];
    }

}

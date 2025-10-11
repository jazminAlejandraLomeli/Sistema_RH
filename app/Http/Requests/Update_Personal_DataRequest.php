<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update_Personal_DataRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric|exists:administrativos,id',
            'Codigo' => 'required|string|size:7',
            'correo' => 'nullable|email',
            'estado_id' => 'required|numeric|exists:estados,id',
            'estudios' => 'required|numeric|in:1,2,3,4,5,6,7,8',
            'f_ingreso' => 'required|date',
            'f_nacimiento' => 'required|date',
            'genero' => 'required|numeric|in:1,2',
            'nombre' => 'required|string',
            'name_emergencia' => 'nullable|string',
            'tel_emergencia' => 'nullable|string|size:10',
            'parentesco_emergencia' => 'nullable|string',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => 'El campo ID es obligatorio.',
            'id.numeric' => 'El ID debe ser un número.',
            'id.exists' => 'El ID debe existir en la base de datos.',
            'Codigo.required' => 'El campo Código es obligatorio.',
            'Codigo.numeric' => 'El Código debe ser un número.',
            'Codigo.size' => 'El Código debe tener exactamente 7 dígitos.',
            'correo.email' => 'El correo debe ser una dirección de correo válida.',
            'estado_id.required' => 'El campo Estado es obligatorio.',
            'estado_id.numeric' => 'El Estado debe ser un número.',
            'estado_id.exists' => 'El Estado debe existir en la base de datos.',
            'estudios.required' => 'El campo Estudios es obligatorio.',
            'estudios.numeric' => 'El campo Estudios debe ser un número.',
            'estudios.in' => 'El campo Estudios debe ser uno de los valores predefinidos.',
            'f_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'f_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
            'f_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'f_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'genero.required' => 'El género es obligatorio.',
            'genero.numeric' => 'El género ingresado no es válido.',
            'genero.in' => 'El género debe ser uno de los valores predefinidos.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'name_emergencia.string' => 'El nombre de emergencia debe ser un texto.',
            'tel_emergencia.tel_emergencia' => 'El teléfono de emergencia debe ser nmerico.',
            'tel_emergencia.size' => 'El teléfono de emergencia debe tener exactamente 10 dígitos.',
            'parentesco_emergencia.string' => 'El parentesco de emergencia debe ser un texto.',
        ];
    }
}

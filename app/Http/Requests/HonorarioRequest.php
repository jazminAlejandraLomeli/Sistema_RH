<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HonorarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required','min:7', 'max:7', 'unique:administrativos,codigo',],
            'gender' => ['required','numeric','in:1,2'],
            'email' => ['nullable','email'],
            'degree_of_studies' => ['required','numeric','in:1,2,3,4,5,6,7,8,9'],
            'birthdate' => ['required','date'],
            'entry_date' => ['required','date'],
            'responsible' => ['required', 'string'],
            'area' => ['required', 'string'],
            'rfc' => ['required' , 
                function($attribute, $value, $fail) {
                    if(!preg_match('/^([A-ZÑ&]{3,4})(\d{2})(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])([A-Z\d]{3})?$/i', $value)){
                        $fail('El RFC no es válido');
                    }
            }]
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser texto',
            'code.required' => 'El código es requerido',
            'code.min' => 'El código debe tener 7 dígitos',
            'code.max' => 'El código debe tener 7 dígitos',
            'code.unique' => 'El código ya está en uso',
            'gender.required' => 'El género es requerido',
            'gender.numeric' => 'El género seleccionado no es válido',
            'gender.in' => 'El género seleccionado no es válido',
            'degree_of_studies.required' => 'El grado de estudios es requerido',
            'degree_of_studies.numeric' => 'El grado de estudios seleccionado no es válido',
            'degree_of_studies.in' => 'El grado de estudios seleccionado no es válido',
            'birthdate.required' => 'La fecha de cumpleaños es requerido',
            'birthdate.date' => 'La fecha de cumpleaños no es una fecha válida',
            'entry_date.required' => 'La fecha de ingreso a la UDG es requerido',
            'entry_date.date' => 'La fecha de ingreso a la UDG no es una fecha válida',
            'responsible.required' => 'El responsable es requerido',
            'responsible.string' => 'EL responsable no es válido',
            'area.required' => 'El área es requerida',
            'area.string' => 'El área no es válida',
            'rfc.required' => 'El RFC es requerido'
        ];
    }
}

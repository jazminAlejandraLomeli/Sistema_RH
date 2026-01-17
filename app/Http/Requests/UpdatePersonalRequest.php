<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdatePersonalRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        // Obtener la colección de estados desde config
        $gender = collect(config('collections.sexo'))->pluck('id')->toArray();
        $degree = collect(config('collections.grados'))->pluck('id')->toArray();


        return [
            'Personal.Id' => ['required', 'numeric', 'exists:administrativos,id'],
            'Personal.Codigo' => [
                'required',
                'integer',
                'digits:7',
                Rule::unique('administrativos', 'codigo')
                    ->ignore($request->input('Personal.Id')),
            ],
            'Personal.Genero' => ['required', 'integer', 'in:' . implode(',', $gender)],
            'Personal.Nombre' => ['required', 'string'],
            'Personal.F_nacimiento' => ['required', 'date'],
            'Personal.F_ingreso' => ['required', 'date'],
            'Personal.Estudios' => ['required', 'integer', 'in:' . implode(',', $degree)],
          //  'Personal.Correo' => ['nullable', 'email', 'unique:administrativos,correo'],

            'Personal.Correo' => [
                'nullable',
                'email',

                Rule::unique('administrativos', 'correo')
                    ->ignore($request->input('Personal.Id')),
            ],

            'Personal.Telefono' => ['nullable', 'numeric', 'digits:10'],
            'Personal.Nombre_e' => ['nullable', 'string'],
            'Personal.Parentesco' => ['nullable', 'string'],
            'Personal.Tel_emer' => ['nullable', 'numeric', 'digits:10'],
            'Personal.Nss' =>
            [
                'nullable',
                'numeric',
                'digits:11',
                Rule::unique('administrativos', 'nss')
                    ->ignore($request->input('Personal.Id')),
            ],
            'Personal.RfC' =>
            [
                'nullable',
                'string',
                'digits:13',
                Rule::unique('administrativos', 'rfc')
                    ->ignore($request->input('Personal.Id')),
            ],
            'Personal.Status' => ['required', 'integer', 'exists:estados,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'Id.required' => 'El campo id es obligatorio.',
            'Personal.Codigo.required' => 'El campo código es obligatorio.',
            'Personal.Codigo.numeric' => 'El campo código debe ser numérico.',
            'Personal.Codigo.digits' => 'El campo código consta de 7 digitos.',
            'Personal.Codigo.unique' => 'El código ingresado ya pertenece a otra persona.',

            'Personal.Genero.required' => 'El campo genéro deber ser un boleano.',
            'Personal.Genero.numeric' => 'El campo genéro debe ser un valor numérico.',
            'Personal.Genero.in' => 'El campo genéro debe ser un 1 o un 2.',
            'Personal.Correo.email' => 'El campo de correo no tiene una estructura correcta.',
            'Personal.Correo.unique' => 'El correo ya existe en la base de datos.',
            'Personal.Estudios.required' => 'El campo de grado de estudios es requerido.',
            'Personal.Estudios.numeric' => 'El campo de grado de estudios debe ser numérico.',
            'Personal.Estudios.in' => 'El campo de grado de estudios no esta en el rango requerido.',
            'Personal.F_ingreso.required' => 'El campo de fecha de ingreso a UdeG es requerido.',
            'Personal.F_ingreso.date' => 'El campo de fecha de ingreso a UdeG debe ser una fecha.',
            'Personal.F_nacimiento.required' => 'El campo de fecha de nacimientoes requerida.',
            'Personal.F_nacimiento.data' => 'El campo de fecha de nacimiento debe ser una fecha.',
            'Personal.Nombre.required' => 'El campo de nombre es requerido.',
            'Personal.Telefono.numeric' => 'El campo de teléfono de emergencia debe ser numérico.',
            'Personal.Telefono.digits' => 'El campo de teléfono de emergencia debe ser de 10 digitos.',
            'Personal.Nss.digits' => 'El número de seguridad social consta de 11 digitos.',
            'Personal.Nss.unique' => 'El número de seguridad social ya existe en la base de datos.',
            'Personal.RfC.digits' => 'El RFC consta de 13 digitos.',
            'Personal.RfC.unique' => 'El RFC ya existe en la base de datos.',
            'Personal.Status.required' => 'El campo estado laboral es requerido.',
            'Personal.Status.numeric' => 'El campo estado laboral debe ser numérico.',
            'Personal.Status.exists' => 'El campo estado laboral no existe en la base de datos.',
        ];
    }
}

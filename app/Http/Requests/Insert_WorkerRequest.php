<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Insert_WorkerRequest extends FormRequest
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
            'Personal.Codigo' => 'required|numeric|digits:7',
            'Personal.Genero' => 'required|numeric|in:1,2',
            'Personal.correo' => 'nullable|email|unique:administrativos,correo',
            'Personal.estudios' => 'required|numeric|in:1,2,3,4,5,6,7,8,9',
            'Personal.f_ingreso' => 'required|date',
            'Personal.f_nacimiento' => 'required|date',
            'Personal.nombre' => 'required|string',

            'Personal.nombre_e' => 'nullable|string',
            'Personal.parentesco' => 'nullable|string',
            'Personal.telefono' => 'nullable|numeric|digits:10',

            'Job.Adicional' => 'nullable|numeric||exists:distincion_adicional,id',
            'Job.Adscripcion' => 'required|string',
            'Job.Categoria' => 'required|numeric|exists:categorias,id',
            'Job.Contrato' => 'required|numeric|in:1,2,3',
            'Job.Horas' => 'required|numeric',
            'Job.Nombramiento' => 'required|numeric|exists:nombramientos,id',
            'Job.Oficial' => 'required|string',
            'Job.Turno' => 'required|numeric|in:1,2,3,4,5',
            'Job.Vencimiento' => 'nullable|date',
            'Job.Departamentos' => 'bail|required_if:Nombramiento,6|array',
            'Job.Departamentos.*' => 'bail|nullable|exists:departamentos,id',
            'Job.Semblanza' => 'nullable|string|max:5000',

        ];
    }

    public function messages(): array
    {
        return [
            'Personal.Codigo.required' => 'El campo código es obligatorio.',
            'Personal.Codigo.numeric' => 'El campo código debe ser numérico.',
            'Personal.Codigo.digits' => 'El campo código consta de 7 digitos.',
            'Personal.Genero.required' => 'El campo genéro deber ser un boleano.',
            'Personal.Genero.numeric' => 'El campo genéro debe ser un valor numérico.',
            'Personal.Genero.in' => 'El campo genéro debe ser un 1 o un 2.',

            'Personal.correo.email' => 'El campo de correo no tiene una estructura correcta.',
             'Personal.correo.unique'=> 'El correo ya existe en la base de datos.',

            'Personal.estudios.required' => 'El campo de grado de estudios es requerido.',
            'Personal.estudios.numeric' => 'El campo de grado de estudios debe ser numérico.',
            'Personal.estudios.in' => 'El campo de grado de estudios no esta en el rango requerido.',
            'Personal.f_ingreso.required' => 'El campo de fecha de ingreso a UdeG es requerido.',
            'Personal.f_ingreso.date' => 'El campo de fecha de ingreso a UdeG debe ser una fecha.',
            'Personal.f_nacimiento.required' => 'El campo de fecha de nacimientoes requerida.',
            'Personal.f_nacimiento.data' => 'El campo de fecha de nacimiento debe ser una fecha.',
            'Personal.nombre.required' => 'El campo de nombre es requerido.',
            'Personal.telefono.numeric' => 'El campo de teléfono de emergencia debe ser numérico.',
            'Personal.telefono.digits' => 'El campo de teléfono de emergencia debe ser de 10 digitos.',

            'Job.Adicional.numeric' => 'El campo distinción adicional debe ser un número.',
            'Job.Adicional.exists' => 'El campo distinción adicional no existe en la base de datos.',
            'Job.Adscripcion.required' => 'El campo área de adscripción es requerida.',
            'Job.Categoria.required' => 'El campo categoría es requerido.',
            'Job.Categoria.numeric' => 'El campo categoría debe ser numérico.',
            'Job.Categoria.exists' => 'El campo categoría no existe en la base de datos.',
            'Job.Contrato.required' => 'El campo tipo de contrato es requerido.',
            'Job.Contrato.numeric' => 'El campo tipo de contrato debe ser numérico.',
            'Job.Contrato.in' => 'El campo tipo de contrato debe ser un número entre 1 a 3.',
            'Job.Horas.required' => 'El campo horas de trabajo es requerido.',
            'Job.Horas.numeric' => 'El campo horas de trabajo debe ser numérico.',
            'Job.Nombramiento.required' => 'El campo nombramiento es requerido.',
            'Job.Nombramiento.numeric' => 'El campo nombramiento debe ser numerico.',
            'Job.Nombramiento.exists' => 'El campo nombramiento no existe en la base de datos.',
            'Job.Oficial.required' => 'El campo horario oficial es requerido.',
            'Job.Turno.required' => 'El campo turno es requerido.',
            'Job.Turno.numeric' => 'El campo turno debe ser numérico.',
            'Job.Vencimiento.date' => 'El campo frcha de vencimiento debe ser una fecha.',
            'Job.Semblanza.max' => 'El campo semblanza excede el limite de caracteres.',


        ];
    }
}

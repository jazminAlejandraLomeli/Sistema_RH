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

        // Obtener la colección de estados desde config
        $gender = collect(config('collections.sexo'))->pluck('id')->toArray();
        $estados = collect(config('collections.estados'))->pluck('id')->toArray();

        // $gender = array_keys(config('collections.sexo'));
        $degree = collect(config('collections.grados'))->pluck('id')->toArray();
        $hours = collect(config('work-collections.Hours'))->pluck('id')->toArray();
        $shifts = collect(config('work-collections.Shifts'))->pluck('id')->toArray();
        $contracts = collect(config('work-collections.Contracts'))->pluck('id')->toArray();

        return [
            'Personal.Codigo' => ['required', 'integer', 'digits:7', 'unique:administrativos,codigo'],
            'Personal.Genero' => ['required', 'integer', 'in:' . implode(',', $gender)],
            'Personal.Nombre' => ['required', 'string'],
            'Personal.F_nacimiento' => ['required', 'date'],
            'Personal.F_ingreso' => ['required', 'date'],
            'Personal.Estudios' => ['required', 'integer', 'in:' . implode(',', $degree)],
            'Personal.Correo' => ['nullable', 'email', 'unique:administrativos,correo'],
            'Personal.Telefono' => ['nullable', 'numeric', 'digits:10'],
            'Personal.Nombre_e' => ['nullable', 'string'],
            'Personal.Parentesco' => ['nullable', 'string'],
            'Personal.Tel_emer' => ['nullable', 'numeric', 'digits:10'],
            'Personal.Nss' => ['nullable', 'numeric', 'digits:11', 'unique:administrativos,nss'],
            'Personal.RfC' => ['nullable', 'string', 'digits:13', 'unique:administrativos,rfc'],
            'Personal.Status' => ['required', 'integer', 'exists:estados,id'],

            'Address.Estado' =>  ['nullable', 'integer', 'in:' . implode(',', $estados)],
            'Address.Municipio' =>  ['nullable', 'string'],
            'Address.Colonia' =>  ['nullable', 'string'],
            'Address.Calle' =>  ['nullable', 'string'],
            'Address.Numero' =>  ['nullable', 'string'],
            'Address.CP' =>  ['nullable', 'string', 'digits:5'],


            'Job.Nombramiento' => ['required', 'integer', 'exists:nombramientos,id'],
            'Job.Categoria' => ['required', 'integer', 'exists:categorias,id'],
            'Job.Horas' => ['required', 'integer', 'in:' . implode(',', $hours)],
            'Job.Turno' => ['required', 'integer', 'in:' . implode(',', $shifts)],
            'Job.Oficial' => ['required', 'string'],
            'Job.Contrato' => ['required', 'integer', 'in:' . implode(',', $contracts)],
            'Job.Vencimiento' => ['nullable', 'date'],
            'Job.Adscripcion' => ['required', 'string'],
            'Job.Adicional' => ['nullable', 'numeric', 'exists:distincion_adicional,id'],
            'Job.Status' => ['required', 'integer', 'exists:estados,id'],

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
            'Personal.Nss.unique' => 'El número de seguridad social ya existe en la base de datos.',
            'Personal.Nss.digits' => 'El número de seguridad social consta de 11 digitos.',
            'Personal.RfC.unique' => 'El RFC ya existe en la base de datos.',
            'Personal.RfC.digits' => 'El RFC consta de 13 digitos.',

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
            'Job.Status.required' => 'El campo estado laboral es requerido.',
            'Job.Status.numeric' => 'El campo estado laboral debe ser numérico.',
            'Job.Status.exists' => 'El campo estado laboral no existe en la base de datos.',




            'Address.Estado.integer' => 'El campo estado debe ser numérico.',
            'Address.Estado.in' => 'El campo estado no existe en la base de datos.',
            'Address.Municipio.string' => 'El campo municipio debe ser una cadena de caracteres.',
            'Address.Colonia.string' => 'El campo colonia debe ser una cadena de caracteres.',
            'Address.Calle.string' => 'El campo calle debe ser una cadena de caracteres.',

            'Address.Numero.string' => 'El campo numero debe ser una cadena de caracteres.',
            'Address.CP.string' => 'El campo cp debe ser una cadena de caracteres.',
            'Address.CP.digits' => 'El campo cp debe tener 5 digitos.',


        ];
    }
}

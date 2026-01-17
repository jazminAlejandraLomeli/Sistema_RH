<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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

         $hours = collect(config('work-collections.Hours'))->pluck('id')->toArray();
        $shifts = collect(config('work-collections.Shifts'))->pluck('id')->toArray();
        $contracts = collect(config('work-collections.Contracts'))->pluck('id')->toArray();

        return [

            'Id_work' => ['required', 'numeric', 'exists:personas_trabajo,id'],
            'Id_worker' => ['required', 'numeric', 'exists:administrativos,id'],
            'Principal' => ['required', 'numeric', 'in:0,1'],

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

    public function messages(){
        return [
            'Id_work.required'=> 'El campo Id_work es requerido.',
            'Id_work.numeric'=> 'El campo Id_work debe ser numérico.',
            'Id_work.exists'=> 'El campo Id_work no existe en la base de datos.',
            'Id_worker.required'=> 'El campo Id_worker es requerido.',
            'Id_worker.numeric'=> 'El campo Id_worker debe ser numérico.',
            'Id_worker.exists'=> 'El campo Id_worker no existe en la base de datos.',
            'Principal.required'=> 'El campo principal es requerido.',
            'Principal.numeric'=> 'El campo principal debe ser numérico.',
            'principal.in'=> 'El campo principal debe ser 0 o 1.',

            'Job.Nombramiento.required'=> 'El campo nombramiento es requerido.',
            'Job.Nombramiento.numeric'=> 'El campo nombramiento debe ser numérico.',
            'Job.Nombramiento.exists'=> 'El campo nombramiento no existe en la base de datos.',
            'Job.Categoria.required'=> 'El campo categoría es requerido.',
            'Job.Categoria.numeric'=> 'El campo categoría debe ser numérico.',
            'Job.Categoria.exists'=> 'El campo categoría no existe en la base de datos.',
            'Job.Horas.required'=> 'El campo horas de trabajo es requerido.',
            'Job.Horas.numeric'=> 'El campo horas de trabajo debe ser numérico.',
            'Job.Turno.required'=> 'El campo turno es requerido.',
            'Job.Turno.numeric'=> 'El campo turno debe ser numérico.',
            'Job.Oficial.required'=> 'El campo horario oficial es requerido.',
            'Job.Oficial.string'=> 'El campo horario oficial debe ser una cadena de caracteres.',
            'Job.Contrato.required'=> 'El campo tipo de contrato es requerido.',
            'Job.Contrato.numeric'=> 'El campo tipo de contrato debe ser numérico.',
            'Job.Contrato.in'=> 'El campo tipo de contrato debe ser un número entre 1 a 3.',
            'Job.Vencimiento.date'=> 'El campo frcha de vencimiento debe ser una fecha.',
            'Job.Adscripcion.required'=> 'El campo área de adscripción es requerida.',
            'Job.Adscripcion.string'=> 'El campo área de adscripción debe ser una cadena de caracteres.',
            'Job.Adicional.numeric'=> 'El campo distinción adicional debe ser un número.',
            'Job.Adicional.exists'=> 'El campo distinción adicional no existe en la base de datos.',
            'Job.Status.required'=> 'El campo estado es requerido.',
            'Job.Status.numeric'=> 'El campo estado debe ser numérico.',
            'Job.Status.exists'=> 'El campo estado no existe en la base de datos.',

         
         
            'Job.Departamentos.required_if'=> 'El campo departamento es requerido.',
            'Job.Departamentos.array'=> 'El campo departamento debe ser un array.',
            'Job.Departamentos.*.exists'=> 'El campo departamento no existe en la base de datos.',
            
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Insert_jobRequest extends FormRequest
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
            'Job.Principal' => 'required|numeric|in:0,1',
            'Job.Id' => 'required|numeric|exists:administrativos,id',
            'Job.Adicional' => 'nullable|numeric|exists:distincion_adicional,id', //válido si contiene un valor numérico o si es nulo
            'Job.Adscripcion' => 'required|string',
            'Job.Categoria' => 'required|numeric|exists:categorias,id',
            'Job.Contrato' => 'required|numeric|in:1,2,3',
            'Job.Horas' => 'required|numeric',
            'Job.Nombramiento' => 'required|numeric|exists:nombramientos,id',
            'Job.Oficial' => 'required|string',
            'Job.Turno' => 'required|numeric|in:1,2,3,4,5',
            'Job.Termino' => 'nullable|date',
            'Job.Estado' => 'nullable|numeric|exists:estados,id',
            'Job.Departamentos' => 'bail|required_if:Nombramiento,6|array',
            'Job.Departamentos.*' => 'bail|nullable|exists:departamentos,id',
            'Job.Semblanza' => 'nullable|string|max:5000',
            'Job.Vencimiento' => 'nullable|date',
 
        ];
    }

    public function messages(): array
    {
        return [

            'Job.Principal.required' => 'El campo de nombramiento principal es requerido.',
            'Job.Principal.numeric' => 'El campo de nombramiento principal debe ser numérico.',
            'Job.Principal.in' => 'El campo de nombramiento principal debe ser 0 o 1.',
            'Job.Id.required' => 'El ID de la persona es requerido.',
            'Job.Id.numeric' => 'El ID de la persona debe ser numérico.',
            'Job.Id.exists' => 'El ID de la persona no pertenece a ningun trabajador.',
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
            'Job.Termino.date' => 'El campo frcha de vencimiento debe ser una fecha.',
            'Job.Estado.numeric' => 'El campo estado debe ser numérico.',
            'Job.Estado.exists' => 'El campo estado debe existir en la base de datos.',
            'Job.Departamentos' => 'El campo departamentos es obligatorio si es profesor de asignatura',
            'Job.Departamentos.*' => 'Existen departamentos que no existen en nuestra base de datos',
            'Job.Semblanza.max' => 'El campo semblanza excede el limite de caracteres.',
            'Job.Vencimiento.date'=> 'El campo fecha de vencimiento debe ser una fecha.',

        ];
    }
}

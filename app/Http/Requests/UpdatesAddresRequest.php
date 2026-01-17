<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatesAddresRequest extends FormRequest
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
        $estados = collect(config('collections.estados'))->pluck('id')->toArray();
       
        return [
            'Address.Id' => ['required', 'numeric', 'exists:administrativos,id'],
            'Address.Id_address' => ['nullable', 'numeric', 'exists:domicilios,id'],
            'Address.Estado' =>  ['nullable', 'integer', 'in:' . implode(',', $estados)],
            'Address.Municipio' =>  ['nullable', 'string'],
            'Address.Colonia' =>  ['nullable', 'string'],
            'Address.Calle' =>  ['nullable', 'string'],
            'Address.Numero' =>  ['nullable', 'string'],
            'Address.CP' =>  ['nullable', 'string', 'digits:5'],
        ];
    }

    public function messages()
    {
        return [

            'Address.Estado.integer' => 'El campo estado debe ser numérico.',
            'Address.Estado.in' => 'El campo estado no existe en la base de datos.',
            'Address.Municipio.string' => 'El campo municipio debe ser una cadena de caracteres.',
            'Address.Colonia.required' => 'El campo colonia es obligatorio.',
            'Address.Colonia.string' => 'El campo colonia debe ser una cadena de caracteres.',
            'Address.Calle.required' => 'El campo calle es obligatorio.',
            'Address.Calle.string' => 'El campo calle debe ser una cadena de caracteres.',

            'Address.Numero.required' => 'El campo numero es obligatorio.',
            'Address.Numero.string' => 'El campo numero debe ser una cadena de caracteres.',
            'Address.CP.required' => 'El campo cp es obligatorio.',
            'Address.CP.string' => 'El campo cp debe ser una cadena de caracteres.',
            'Address.CP.digits' => 'El campo cp debe tener 5 digitos.',


        ];
    }
}

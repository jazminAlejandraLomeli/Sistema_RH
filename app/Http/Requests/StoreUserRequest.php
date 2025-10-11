<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'Code' => 'required|numeric|digits:7|exists:administrativos,codigo|unique:users,user_name',
            'UserType' => 'required|numeric|exists:roles,id',
            'Name' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'Code.required' => 'El campo código es obligatorio.',
            'Code.numeric' => 'El campo código debe ser un numérico.',
            'Code.digits' => 'El campo código debe ser de 7 caracteres.',
            'Code.exists' => 'El campo código debe existir en la base de datos.',
            'Code.unique' => 'Ya existe un usuario con el código ingresado.',
            'UserType.required' => 'El campo tipo de usuario es obligatorio.',
            'UserType.numeric' => 'El campo tipo de usuario debe ser un numérico.',
            'UserType.exists' => 'El tipo de usuario debe existir en la base de datos.',
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.max' => 'El campo nombre no debe exceder los 255 caracteres.',
        ];
    }


}

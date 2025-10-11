<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'Id' => 'required|numeric|exists:users,id',
            'UserType' => 'required|numeric|exists:roles,id',
         ];
    }

    public function messages(): array
    {
        return [
            'Id.required' => 'El campo código es obligatorio.',
            'Id.numeric' => 'El campo código debe ser un numérico.',
            'Id.exists' => 'El campo código debe existir en la base de datos.',
            'UserType.required' => 'El campo tipo de usuario es obligatorio.',
            'UserType.numeric' => 'El campo tipo de usuario debe ser un numérico.',
            'UserType.exists' => 'El tipo de usuario debe existir en la base de datos.',
         ];
    }
}

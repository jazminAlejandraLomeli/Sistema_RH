<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends FormRequest
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
            'photo' => ['required','image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'code' => ['required','exists:administrativos,codigo']
        ];
    }

    public function messages() : array
    {
        return [
            'photo.required' => 'La foto es requerida',
            'photo.image' => 'La foto debe ser una imagen',
            'photo.mimes' => 'La foto solo acepta los siguientes formatos: jpg, png, jpeg',
            'photo.max' => 'La foto supera los 2MB máximos permitidos',
            'code.required' => 'El código es obligatorio',
            'code.exists' => 'El código no existe en los registros'
        ];
    }
}

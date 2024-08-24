<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', PasswordRules::min(8)->letters()->mixedCase()->numbers()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'El campo nombre es obligatorio',
            'name.string'         => 'El campo nombre debe ser una cadena de texto',
            'name.max'            => 'El campo nombre no debe exceder los 255 caracteres',
            'email.required'      => 'El campo email es obligatorio',
            'email.string'        => 'El campo email debe ser una cadena de texto',
            'email.email'         => 'El campo email debe ser un correo electrónico',
            'email.max'           => 'El campo email no debe exceder los 255 caracteres',
            'email.unique'        => 'El email ya se encuentra registrado',
            'password.required'   => 'El campo contraseña es obligatorio',
            'password.confirmed'  => 'Las contraseñas no coinciden',
            'password.min'        => 'La contraseña debe tener al menos 8 caracteres',
            'password.letters'    => 'La contraseña debe contener al menos una letra',
            'password.mixed_case' => 'La contraseña debe contener al menos una letra mayúscula y una minúscula',
            'password.numbers'    => 'La contraseña debe contener al menos un número',
        ];
    }
}

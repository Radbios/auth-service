<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "O email é um campo obrigatório",
            "email.email" => "O email tem que ser um email válido",
            "password.required" => "A senha é um campo obrigatório",
        ];
    }
}
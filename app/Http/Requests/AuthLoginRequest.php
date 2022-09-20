<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'senha' => 'required|min:8|max:30|regex:(^[a-zA-Z0-9 _-]+[a-zA-Z0-9-14\-[a-zA-Z0-9-.]+$)'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Campo obrigatório',
            'email.email' => 'Email inválido',
            'senha.min' => 'Precisa 8 caracteres',
            'senha.max' => 'Excedeu o numero de caracteres',         
            'senha.regex' => 'Senha inválida',
            'senha.required' => 'Campo obrigatório'
        ];
    }
}

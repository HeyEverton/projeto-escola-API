<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfessorRequest extends FormRequest
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
            'nome' => 'required|string',
            'email' => 'required|email',
            'professor_cpf' => 'required|string|max:14|min:14',
            'professor_foto' => 'required',
            'professor_rg' => 'required|string',
            'estado_civil' => 'required|string',
            'sexo' => 'required|max:10',
            'formacao' => 'required|string',
            'tel_contato' => 'required|string',
            'nome_rua' => 'required|string',
            'numero_residencia' => 'required|integer',
            'cep' => 'required|string',
            'cidade' => 'required|string',
            'bairro' => 'required|string',
            'estado' => 'required|string|max:2',
            'banco' => 'required|string',
            'numero_conta' => 'required|string',
            'agencia' => 'required|string',
        ];
    }
}

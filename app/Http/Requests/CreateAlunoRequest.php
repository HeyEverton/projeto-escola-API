<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlunoRequest extends FormRequest
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
            'cpf_aluno' => 'required|string',
            'aluno_foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email',
            'sexo' => 'required|max:10',
            'nacionalidade' => 'required|max:40',
            'escolaridade' => 'required|max:35',
            'data_nasc' => 'required',
            'whatsapp' => 'sometimes',
            'tel_contato' => 'required|string',
            'nome_rua' => 'required|string',
            'numero_residencia' => 'required|string',
            'cep' => 'required|string',
            'cidade' => 'required|string',
            'bairro' => 'required|string',
            'estado' => 'required|string|max:2',
        ];
    }
}

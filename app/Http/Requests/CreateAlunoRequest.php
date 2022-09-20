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
            'aluno_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email',
            'sexo' => 'required',
            'data_nasc' => 'required',
            'tel_fixo' => 'sometimes',
            'tel_contato' => 'required|string',
            'nome_rua' => 'required|string',
            'cep' => 'required|string',
            'cidade' => 'required|string',
            'bairro' => 'required|string',
            'estado' => 'required|string|max:2',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'este campo e obrigatorio.',
            'cpf_aluno.required' => 'este campo e obrigatorio.',
            'aluno_foto.required' => 'este campo e obrigatorio.',
            'aluno_foto.image' => 'por favor, insira uma imagem.',
            'aluno_foto.mimes' => 'apenas os formatos: jpeg, jpg, png sao permitidos.',
            'email.required' => 'este campo e obrigatorio.',
            'email.email' => 'email invalido.',
            'sexo.required' => 'este campo e obrigatorio',
            'data_nasc.required' => 'este campo e obrigatorio',
            'tel_contato.required' => 'este campo e obrigatorio',
            'nome_rua.required' => 'este campo e obrigatorio',
            'cep.required' => 'este campo e obrigatorio',
            'cidade.required' => 'este campo e obrigatorio',
            'bairro.required' => 'este campo e obrigatorio',
            'estado.required' => 'este campo e obrigatorio',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoUpdateRequest extends FormRequest
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
            'nome' => 'sometimes|string',
            'cpf_aluno' => 'sometimes|string|max:14|min:14',
            'aluno_foto' => 'sometimes',
            'email' => 'sometimes|email',
            'sexo' => 'sometimes|max:10',
            'nacionalidade' => 'sometimes|max:40',
            'observacap' => 'sometimes|string|max:500',
            'escolaridade' => 'sometimes|max:35',
            'data_nasc' => 'sometimes',
            'whatsapp' => 'sometimes',
            'tel_contato' => 'sometimes|string',
            'nome_rua' => 'sometimes|string',
            'numero_residencia' => 'sometimes|string',
            'cep' => 'sometimes|string',
            'cidade' => 'sometimes|string',
            'bairro' => 'sometimes|string',
            'estado' => 'sometimes|string|max:2',
        ];
    }
}

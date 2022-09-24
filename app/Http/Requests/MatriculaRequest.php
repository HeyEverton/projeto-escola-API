<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
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
            'aluno_id' => 'required',
            'turma_id' => 'required',
            'valor_curso' => 'required',
            'desconto_curso' => 'required',
            'data_vencimento' => 'required',
            'forma_pagamento' => 'required',
            'qtd_parcelas' => 'required',
        ];
    }
}

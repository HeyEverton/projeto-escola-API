<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformarPagamentoRequest extends FormRequest
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
            'data_pagamento' => 'sometimes',
            'valor_pago' => 'sometimes',
            'status' => 'required',
            'observacao' => 'sometimes',
            'user_id' => 'sometimes',
            'aluno_id' => 'sometimes',
            'matricula_id' => 'sometimes',
        ];
    }
}

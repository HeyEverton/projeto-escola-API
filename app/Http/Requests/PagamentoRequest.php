<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagamentoRequest extends FormRequest
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
            'data_pagamento' => 'required|date',
            'valor_pago' => 'required',
            'status' => 'sometimes',
            'observacao' => 'sometimes',
            'aluno_id' => 'required',
            'user_id' => 'required',
            'parcela_id' => 'required',
        ];
    }
}

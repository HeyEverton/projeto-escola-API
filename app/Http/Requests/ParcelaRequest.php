<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelaRequest extends FormRequest
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
            'num_parcela' => 'required',
            'valor_parcela' => 'required',
            'data_vencimento' => 'required|date',
            'aluno_id' => 'required',
            'matricula_id' => 'required',
        ];
    }
}

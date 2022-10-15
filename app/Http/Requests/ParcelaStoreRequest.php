<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelaStoreRequest extends FormRequest
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
            'num_parcela' => 'sometimes',
            'data_vencimento' => 'required',
            'aluno_id' => 'required',
            'matricula_id' => 'required',
            'valor_curso' => 'required',
            'desconto_curso' => 'sometimes',
        ];
    }
}

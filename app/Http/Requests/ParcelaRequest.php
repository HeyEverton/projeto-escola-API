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
            'num_parcela' => 'sometimes',
            'data_vencimento' => 'sometimes',
            'aluno_id' => 'sometimes',
            'matricula_id' => 'sometimes',
            'valor_curso' => 'sometimes',
            'desconto_curso' => 'sometimes',
        ];
    }
}

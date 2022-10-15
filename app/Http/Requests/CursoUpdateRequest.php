<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoUpdateRequest extends FormRequest
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
            'descricao' => 'required|string',
            'ativo' => 'required|boolean',
            'preco' => 'required|integer',
            'carga_horaria' => 'required|string',
            'desconto' => 'nullable',
        ];
    }
}

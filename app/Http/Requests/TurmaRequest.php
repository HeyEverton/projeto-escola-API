<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurmaRequest extends FormRequest
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
            'nome' =>'required|string',
            'turno' =>'required|string',
            'data_inicio' =>'required|date',
            'data_termino' =>'nullable|date',
            'qt_max_alunos' =>'required|int',
            'qt_atual_alunos' =>'required|int',
            'horario_entrada' =>'required|string',
            'horario_saida' =>'required|string',
            'modalidade' =>'required|integer',
            'status' =>'required|string',
            'professor_id' =>'required',
            'curso_id' =>'required',
        ];
    }
}

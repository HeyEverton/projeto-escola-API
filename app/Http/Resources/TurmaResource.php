<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TurmaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'turno' => (string)$this->turno,
            'data_inicio' => (string)$this->data_inicio,
            'data_termino' => (string)$this->data_termino,
            'qt_max_alunos' => (string)$this->qt_max_alunos,
            'qt_atual_alunos' => (string)$this->qt_atual_alunos,
            'horario_entrada' => (string)$this->horario_entrada,
            'horario_saida' => (string)$this->horario_saida,
            'modalidade' => $this->modalidade,
            'status' => (string)$this->status,
            'created_at' => (string)$this->created_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessorResource extends JsonResource
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
            'nome' => (string)$this->nome,
            'professor_cpf' => (string)$this->professor_cpf,
            'professor_rg' => (string)$this->professor_rg,
            'professor_foto' => (string)$this->professor_foto,
            'estado_civil' => $this->estado_civil,
            'sexo' => $this->sexo,
            'formacao' => (string)$this->formacao,
            'tel_contato' => (string)$this->tel_contato,
            'nome_rua' => (string)$this->nome_rua,
            'numero_residencia' => (string)$this->numero_residencia,
            'cep' => (string)$this->cep,
            'cidade' => (string)$this->cidade,
            'estado' => (string)$this->estado,
            'banco' => (string)$this->banco,
            'numero_conta' => (string)$this->numero_conta,
            'agencia' => (string)$this->agencia,
            'created_at' => (string)$this->created_at,
        ];
    }
}

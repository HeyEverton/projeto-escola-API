<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlunoResource extends JsonResource
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
            'cpf_aluno' => (string)$this->cpf_aluno,
            'aluno_foto' => (string)$this->aluno_foto,
            'email' => (string)$this->email,
            'sexo' => (string)$this->sexo,
            'data_nasc' => (string)$this->data_nasc,
            'tel_fixo' => (string)$this->tel_fixo,
            'tel_contato' => (string)$this->tel_contato,
            'nome_rua' => (string)$this->nome_rua,
            'cep' => (string)$this->cep,
            'cidade' => (string)$this->cidade,
            'bairro' => (string)$this->bairro,
            'estado' => (string)$this->estado,
            'created_at' => (string)$this->created_at,
        ];
    }
}

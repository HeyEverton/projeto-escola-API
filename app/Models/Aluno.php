<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'cpf_aluno',
        'aluno_foto',
        'email',
        'sexo',
        'data_nasc',
        'tel_fixo',
        'nome_rua',
        'cep',
        'cidade',
        'bairro',
        'estado',
    ];

    // public function pagamentos()
    // {
    //     return $this->hasMany(Pagamento::class);
    // }
}

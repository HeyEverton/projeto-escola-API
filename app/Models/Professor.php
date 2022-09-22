<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'tb_professores';

    protected $fillable = [
        'nome',
        'email',
        'professor_cpf',
        'professor_rg',
        'professor_foto',
        'estado_civil',
        'sexo',
        'formacao',
        'tel_contato',
        'nome_rua',
        'numero_residencia',
        'cep',
        'cidade',
        'bairro',
        'estado',
        'banco',
        'numero_conta',
        'agencia',
    ];
}

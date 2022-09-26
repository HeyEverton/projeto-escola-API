<?php

namespace App\Models;

use App\Enums\{EstadoCivil, Sexo};
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

    protected $casts = [
        'sexo' => Sexo::class,
        'estado_civil' => EstadoCivil::class
    ];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}

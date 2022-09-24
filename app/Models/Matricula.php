<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $table = 'tb_matriculas';
    protected $fillable = [
        'valor_curso',
        'desconto_curso',
        'data_vencimento',
        'forma_pagamento',
        'qtd_parcelas',
        'aluno_id',
        'turma_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
}

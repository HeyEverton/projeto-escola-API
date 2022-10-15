<?php

namespace App\Models;

use App\Enums\FormaPagamento;
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

    protected $casts = [
        'forma_pagamento' => FormaPagamento::class
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}

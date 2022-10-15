<?php

namespace App\Models;

use App\Enums\StatusPagamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;
    protected $table = 'tb_parcelas';
    protected $fillable = [
        'num_parcela',
        'valor_parcela',
        'data_vencimento',
        'aluno_id',
        'matricula_id',
        'user_id',
        'status',
        'data_pagamento',
        'valor_pago',
        'data_pagamento',
        'observacao'

    ];

    protected $casts = [
        'status' => StatusPagamento::class
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use App\Enums\StatusPagamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;
    protected $table = 'tb_pagamentos';
    
    protected $fillable = [
        'num_parcelas',
        'valor_parcela',
        'data_vencimento',
        'status',
        'aluno_id',
    ];

    protected $casts = [
        'status' => StatusPagamento::class
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}

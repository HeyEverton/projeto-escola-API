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
        'data_pagamento',
        'valor_pago',
        'status',
        'observacao',
        'aluno_id',
        'user_id',
        'parcela_id',
    ];

    protected $casts = [
        'status' => StatusPagamento::class
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }



    // public function parcela()
    // {
    //     return $this->belongsTo(Parcela::class);
    // }
}

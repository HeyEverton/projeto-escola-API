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
        return $this->belongsTo(User::class, 'user_id');
    }
}

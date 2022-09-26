<?php

namespace App\Models;

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
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }
}

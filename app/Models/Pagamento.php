<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_parcelas',
        'valor_parcela',
        'data_vencimento',
        'status',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}

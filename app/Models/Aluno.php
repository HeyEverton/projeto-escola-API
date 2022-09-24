<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'tb_alunos';
    
    protected $fillable = [
        'nome',
        'cpf_aluno',
        'aluno_foto',
        'email',
        'sexo',
        'nacionalidade',
        'escolaridade',
        'data_nasc',
        'whatsapp',
        'tel_contato',
        'nome_rua',
        'numero_residencia',
        'cep',
        'cidade',
        'bairro',
        'estado',
    ];

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
}

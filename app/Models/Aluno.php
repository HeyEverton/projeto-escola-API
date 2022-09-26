<?php

namespace App\Models;

use App\Enums\{Nacionalidade, Sexo};
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
    protected $casts = [
        'sexo' => Sexo::class,
        'nacionalidade' => Nacionalidade::class
    ];

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'aluno_id');
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

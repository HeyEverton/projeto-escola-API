<?php

namespace App\Models;

use App\Enums\{Escolaridade, Nacionalidade, Sexo};
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'observacao',
        'whatsapp',
        'tel_contato',
        'nome_rua',
        'numero_residencia',
        'cep',
        'cidade',
        'bairro',
        'estado',
    ];

    protected function alunoFoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'http://' . $_SERVER['HTTP_HOST'] . "/storage/alunos_fotos/" . $value,
        );
    }
    
    protected $casts = [
        'sexo' => Sexo::class,
        'nacionalidade' => Nacionalidade::class,
        'escolaridade' => Escolaridade::class
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

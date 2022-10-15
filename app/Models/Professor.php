<?php

namespace App\Models;

use App\Enums\{Banco, EstadoCivil, Nacionalidade, Sexo};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'tb_professores';

    protected $fillable = [
        'nome',
        'email',
        'professor_cpf',
        'professor_rg',
        'professor_foto',
        'estado_civil',
        'sexo',
        'formacao',
        'tel_contato',
        'nome_rua',
        'numero_residencia',
        'cep',
        'cidade',
        'bairro',
        'estado',
        'banco',
        'numero_conta',
        'agencia',
        'nacionalidade',
    ];

    protected function professorFoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'http://' . $_SERVER['HTTP_HOST'] . "/storage/professores_fotos/" . $value,
        );
    }


    protected $casts = [
        'sexo' => Sexo::class,
        'estado_civil' => EstadoCivil::class,
        'nacionalidade' => Nacionalidade::class,
        'banco' => Banco::class,
    ];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}

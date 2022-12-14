<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'tb_cursos';

    protected $fillable = [
        'nome',
        'descricao',
        'ativo',
        'preco',
        'carga_horaria',
        'desconto',
    ];
    

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}

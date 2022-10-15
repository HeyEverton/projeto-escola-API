<?php

namespace App\Models;

use App\Enums\ModalidadeTurma;
use App\Enums\StatusTurma;
use App\Enums\Turno;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'tb_turmas';
    protected $fillable = [
        'nome',
        'turno',
        'data_inicio',
        'data_termino',
        'qt_max_alunos',
        'qt_atual_alunos',
        'horario_entrada',
        'horario_saida',
        'modalidade',
        'status',
        'professor_id',
        'curso_id',
    ];
    
    protected $casts = [
        'status' => StatusTurma::class,
        'modalidade' => ModalidadeTurma::class,
        'turno' => Turno::class,
    ];
    
    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}

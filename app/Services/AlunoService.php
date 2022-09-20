<?php

namespace App\Services;

use App\Exceptions\EmailHasBeenTaken;
use App\Models\Aluno;

class AlunoService 
{
    public function store(array $input)
    {
        $aluno = Aluno::where('email', $input['email'])->exists();
        if(empty($aluno)) {
            throw new EmailHasBeenTaken();
        }
        $aluno = 'teste';

    }
}
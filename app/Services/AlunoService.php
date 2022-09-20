<?php

namespace App\Services;

use App\Exceptions\EmailHasBeenTaken;
use App\Http\Requests\CreateAlunoFotoRequest;
use App\Http\Requests\CreateAlunoRequest;
use App\Models\Aluno;

class AlunoService
{

    public function store(array $input, CreateAlunoRequest $alunoFotoRequest, CreateAlunoRequest $request)
    {
       dd('teste chegou service');

        $alunoFoto = $alunoFotoRequest->file('aluno_foto');
        try {
            $arquivo = '';
            if ($alunoFoto) {
                if ($request->file('aluno_foto')->isValid()) {
                    $extensaoArquivo = $alunoFoto->getClientOriginalExtension();
                    $nomeAluno = $request->get('nome');
                    $arquivo = $alunoFoto->storeAs('fotoAluno', "{$nomeAluno}" .  "." . "{$extensaoArquivo}");
                }
            }
            $data['aluno_foto'] = $arquivo;

            $this->aluno->create($data);

            return response()->json([
                'data' => 'foi cadastrado',
            ]);
        } catch (\Exception $e) {
        }
    }
}

<?php

namespace App\Services;

use App\Exceptions\EmailHasBeenTaken;
use App\Exceptions\FileNotSend;
use App\Http\Requests\CreateAlunoFotoRequest;
use App\Http\Requests\CreateAlunoRequest;
use App\Models\Aluno;
use Illuminate\Support\Facades\Storage;

class AlunoService
{

    public function store(array $input, CreateAlunoRequest $alunoFotoRequest, CreateAlunoRequest $request)
    {
       dd('teste chegou service');

        if ($alunoFotoRequest->hasFile('aluno_foto')) {

            $alunoFoto = $alunoFotoRequest->file('aluno_foto');

            // $arquivo = '';

                if ($request->file('aluno_foto')->isValid()) {

                    // $extensaoArquivo = $alunoFoto->getClientOriginalExtension();
                    // $nomeAluno = $request->get('nome');
                    // $arquivo = 
                    $alunoFoto->store('fotoAluno');

                    $url = Storage::url($alunoFoto);
                    dd($url);
                }
            
            $data['aluno_foto'] = $alunoFoto;

            $aluno = $this->aluno->create($data);

            return response()->json([
                'data' => $aluno
            ]);
        } else {
            throw new FileNotSend();
        }
    }
}

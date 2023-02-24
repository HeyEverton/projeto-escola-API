<?php

namespace App\Services;

use App\Exceptions\EmailHasBeenTaken;
use App\Exceptions\FileNotSend;
use App\Exceptions\InvalidCpf;
use App\Http\Requests\AlunoUpdateRequest;
use App\Http\Requests\CreateAlunoFotoRequest;
use App\Http\Requests\CreateAlunoRequest;
use App\Http\Resources\AlunoResource;
use App\Models\Aluno;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class AlunoService
{
    public function __construct(private Aluno $aluno)
    {
    }

    public function store(array $input, CreateAlunoFotoRequest $alunoFotoRequest, CreateAlunoRequest $request)
    {
        $input = $request->validated();
        $data = $request->all();

        $alunoFoto = $alunoFotoRequest->file('aluno_foto');

        $alunoEmail = Aluno::where('email', $input['email'])->exists();
        $alunoCpf = Aluno::where('cpf_aluno', $input['cpf_aluno'])->exists();
        if (!empty($alunoEmail)) { throw new EmailHasBeenTaken(); }
        if (!empty($alunoCpf)) { throw new InvalidCpf(); }

        $arquivo = '';

        if ($alunoFoto) {
            if ($request->file('aluno_foto')->isValid()) {
                $extensaoArquivo = $alunoFoto->getClientOriginalExtension();
                $nome = Uuid::uuid6() . '.'. $extensaoArquivo;
                $arquivo = $alunoFoto->storeAs('public/alunos_fotos', $nome);
            }
        }
        $data['aluno_foto'] = $nome;
        $aluno =  $this->aluno->create($data);

        return $aluno;
    }

    public function edit(array $input, AlunoUpdateRequest $request, $id)
    {
        $input = $request->validated();
        $aluno = $this->aluno->findOrFail($id);
        $aluno->fill($request->except('aluno_foto'));
        if ($foto = $request->hasFile('aluno_foto')) {

            $foto = $request->file('aluno_foto');
            $extensaoArquivo = $foto->getClientOriginalExtension();
            $nomeArquivo = Uuid::uuid6() . '.' . $extensaoArquivo;
            $caminhoArquivo = public_path() . '/storage/alunos_fotos/';
            $foto->move($caminhoArquivo, $nomeArquivo);
            $aluno->aluno_foto = $nomeArquivo;
        }
        $aluno->save();

        return $aluno;
    }
}

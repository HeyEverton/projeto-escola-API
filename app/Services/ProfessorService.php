<?php

namespace App\Services;

use App\Exceptions\EmailHasBeenTaken;
use App\Exceptions\FileNotSend;
use App\Exceptions\InvalidCpf;
use App\Http\Requests\CreateProfessorFotoRequest;
use App\Http\Requests\CreateProfessorRequest;
use App\Http\Resources\ProfessorResource;
use App\Models\Professor;
use Ramsey\Uuid\Uuid;

class ProfessorService
{
    public function __construct(private Professor $professor)
    {
    }

    public function store(array $input, CreateProfessorRequest $request, CreateProfessorFotoRequest $professorFotoRequest)
    {
        $input = $request->validated();
        $data = $request->all();

        $professorFoto = $professorFotoRequest->file('professor_foto');

        $professorEmail = Professor::where('email', $input['email'])->exists();
        $professorCpf = Professor::where('professor_cpf', $input['professor_cpf'])->exists();

        if (!empty($professorEmail)) {
            throw new EmailHasBeenTaken();
        }
        if (!empty($professorCpf)) {
            throw new InvalidCpf();
        }

        if ($professorFotoRequest->hasFile('professor_foto')) {
            $arquivo = '';
            if ($professorFoto) {
                if ($request->file('professor_foto')->isValid()) {
                    $extensaoArquivo = $professorFoto->getClientOriginalExtension();
                    $nomeArquivo = Uuid::uuid6() . '.' . $extensaoArquivo;
                    $arquivo = $professorFoto->storeAs('public/professores_fotos', $nomeArquivo);
                }
            }
            $data['professor_foto'] = $nomeArquivo;
            $professor =  $this->professor->create($data);
            return $professor;
        } else {
            throw new FileNotSend();
        }
    }

    public function edit(array $input, CreateProfessorRequest $request, $id)
    {
        $input = $request->validated();

        $professor = $this->professor->findOrFail($id);


        $professor->fill($request->except('professor_foto'));

        if ($foto = $request->hasFile('professor_foto')) {

            $foto = $request->file('professor_foto');
            $extensaoArquivo = $foto->getClientOriginalExtension();
            $nomeArquivo = Uuid::uuid6() . '.' . $extensaoArquivo;
            $caminhoArquivo = public_path() . '/storage/professores_fotos/';
            $foto->move($caminhoArquivo, $nomeArquivo);
            $professor->professor_foto = $nomeArquivo;
        } 
        $professor->save();

        return $professor;
    }
}

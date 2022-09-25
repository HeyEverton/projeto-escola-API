<?php

namespace App\Http\Controllers;

use App\Exceptions\FileNotSend;
use App\Http\Requests\{CreateAlunoFotoRequest, CreateAlunoRequest};
use App\Http\Resources\AlunoResource;
use App\Models\Aluno;
use App\Services\AlunoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid as Uuid;

class AlunoController extends Controller
{
    public function __construct(private Aluno $aluno, private AlunoService $alunoService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->aluno->select()->paginate();

        return response()->json($alunos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAlunoRequest $request, CreateAlunoFotoRequest $alunoFotoRequest)
    {
        $input = $request->validated();
        $data = $request->all();
        $aluno = $this->alunoService->store($input, $alunoFotoRequest, $request);
        return new AlunoResource($aluno);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = $this->aluno->find($id);
        if (empty($aluno)) {
            throw new ModelNotFoundException();
        }

        return new alunoResource($aluno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAlunoRequest $request, $id)
    {
        $input = $request->validated();
        $aluno = $this->alunoService->edit($input, $request, $id);
        return new AlunoResource($aluno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = $this->aluno->find($id);

        if (empty($aluno)) {
            throw new ModelNotFoundException();
        }
        $aluno->delete();

        return response()->json([
            'message'  => 'deletado com sucesso'
        ]);
    }

    public function pesquisarNome($nome)
    {
        $alunos = $this->aluno->select()->where('nome', 'like', '%' . $nome . '%')->paginate();
        return response()->json($alunos, 200);
    }
    
    public function pesquisarCpf($cpf)
    {
        $alunos = $this->aluno->select()->where('cpf_aluno', 'like', '%' . $cpf . '%')->paginate();
        
        return response()->json($alunos, 200);
    }
    
    public function pesquisarEmail($email)
    {
        $alunos = $this->aluno->select()->where('email', 'like', '%' . $email . '%')->paginate();
        
        return response()->json($alunos, 200);
    }
    
    public function pesquisarTelefone($telContato)
    {
        $alunos = $this->aluno->select()->where('tel_contato', 'like', '%' . $telContato . '%')->paginate();
        
        return response()->json($alunos, 200);
    }
    
    public function pesquisarDataNasc($dataNasc)
    {
        $alunos = $this->aluno->select()->where('data_nasc', 'like', '%' . $dataNasc . '%')->paginate();
        
        return response()->json($alunos, 200);
    }
}

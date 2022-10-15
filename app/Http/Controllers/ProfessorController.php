<?php

namespace App\Http\Controllers;

use App\Exceptions\FileNotSend;
use App\Http\Requests\CreateProfessorFotoRequest;
use App\Http\Requests\CreateProfessorRequest;
use App\Http\Resources\ProfessorResource;
use App\Models\Professor;
use App\Services\ProfessorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{
    public function __construct(private Professor $professor, private ProfessorService $professorService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Professor::class); 
        $professores = $this->professor->select()->paginate();
        return response()->json($professores, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProfessorRequest $request, CreateProfessorFotoRequest $professorFotoRequest)
    {
        $this->authorize('create', Professor::class); 
        $input = $request->validated();
        $professor = $this->professorService->store($input, $request, $professorFotoRequest);
        return new ProfessorResource($professor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Professor::class); 
        $professor = $this->professor->find($id);
        if (empty($professor)) {
            throw new ModelNotFoundException();
        }
        return new ProfessorResource($professor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProfessorRequest $request, $id)
    {
        $this->authorize('update', Professor::class); 
        $input = $request->validated();
        $professor = $this->professorService->edit($input, $request, $id);
        return new ProfessorResource($professor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Professor::class); 
        $professor = $this->professor->find($id);
        if (empty($professor)) {
            throw new ModelNotFoundException();
        }
        $professor->delete();
        return response()->json([
            'message' => 'Excluido com sucesso.',
        ]);
    }


    public function pesquisarNome($nome)
    {
        $professores = $this->professor->select()->where('nome', 'like', '%' . $nome . '%')->paginate();
        return response()->json($professores, 200);
    }

    public function pesquisarCpf($cpf)
    {
        $professores = $this->professor->select()->where('professor_cpf', 'like', '%' . $cpf . '%')->paginate();
        return response()->json($professores, 200);
    }

    public function pesquisarRg($rg)
    {
        $professores = $this->professor->select()->where('professor_rg', 'like', '%' . $rg . '%')->paginate();
        return response()->json($professores, 200);
    }

    public function pesquisarTelefone($telContato)
    {
        $professores = $this->professor->select()->where('tel_contato', 'like', '%' . $telContato . '%')->paginate();
        return response()->json($professores, 200);
    }

    public function pesquisarEmail($email)
    {
        $professores = $this->professor->select()->where('email', 'like', '%' . $email . '%')->paginate();
        return response()->json($professores, 200);
    }

    public function pesquisarConta($numConta)
    {
        $professores = $this->professor->select()->where('numero_conta', 'like', '%' . $numConta . '%')->paginate();
        return response()->json($professores, 200);
    }


    public function pesquisarTodosSexo($sexo)
    {
        $professores = $this->professor->select()->where('sexo', 'like', '%' . $sexo . '%')->paginate();
        return response()->json($professores, 200);
    }

    public function todosProfessoresContagem()
    {
        $professores = $this->professor->select('*')->count();
        return response()->json([
            'contagem_professores' => $professores
        ]);
    }
}

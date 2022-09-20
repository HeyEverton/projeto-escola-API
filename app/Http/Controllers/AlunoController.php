<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlunoFotoRequest;
use App\Http\Requests\CreateAlunoRequest;
use App\Http\Resources\AlunoResource;
use App\Models\Aluno;
use App\Services\AlunoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        // $aluno = $this->alunoService->store($input, $data);

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

            // return new AlunoResource($data);
            return response()->json([
                'data' => 'foi cadastrado',
            ]);
        } catch (\Exception $e) {

        }

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
    public function update(CreateAlunoRequest $request, $id, CreateAlunoFotoRequest $alunoFotoRequest)
    {
        $input = $request->validated();
        // $data = $request->all();

        $aluno = $this->aluno->find($id);
        if (empty($aluno)) {
            throw new ModelNotFoundException();
        }

        $aluno->update($input);

        return new AlunoResource($aluno);

        // $alunoFoto = $alunoFotoRequest->file('aluno_foto');
        // try {
        //     $arquivo = '';
        //     if ($alunoFoto) {
        //         if ($request->file('aluno_foto')->isValid()) {
        //             $extensaoArquivo = $alunoFoto->getClientOriginalExtension();
        //             $nomeAluno = $request->get('nome');
        //             $arquivo = $alunoFoto->storeAs('fotoAluno', "{$nomeAluno}" .  "." . "{$extensaoArquivo}");
        //         }
        //     }
        //     $data['aluno_foto'] = $arquivo;

        //     $this->aluno->update($data);

            // return new AlunoResource($data);
            // return response()->json([
            //     'data' => 'foi editado',
            // ]);
        // } catch (\Exception $e) {
        // }
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

        if(empty($aluno)) {
            throw new ModelNotFoundException();
        }
        $aluno->delete();

        return response()->json([
           'message'  => 'deletado com sucesso'
        ]);
    }
}

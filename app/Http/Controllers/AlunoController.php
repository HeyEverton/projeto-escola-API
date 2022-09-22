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
        // $aluno = $this->alunoService->store($input, $request, $data);
        

        if ($alunoFotoRequest->hasFile('aluno_foto')) {

            // $alunoFoto =;

            // $arquivo = '';
            if ($request->file('aluno_foto')->isValid()) {

                // $extensaoArquivo = $alunoFoto->getClientOriginalExtension();
                // $nomeAluno = $request->get('nome');
                // $arquivo = 
                $alunoFoto = $alunoFotoRequest->file('aluno_foto')->store('fotos-alunos','public');

                $url = asset(Storage::url($alunoFoto));

                $data['aluno_foto'] = $url;
                $aluno = $this->aluno->select();
                $aluno = $this->aluno->create($data);

                return response()->json([
                    'data' => $aluno
                ]);
            }



        } else {
            throw new FileNotSend();
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
        $data = $request->all();
        // $aluno = $this->alunoService->update($input, $data);
        dd($request->all());


        if ($alunoFotoRequest->hasFile('aluno_foto')) {

            if ($request->file('aluno_foto')->isValid()) {

                $alunoFoto = $alunoFotoRequest->file('aluno_foto')->store('fotos-alunos','public');
                $url = asset(Storage::url($alunoFoto));
                
                $data['aluno_foto'] = $url;
               
                $aluno = $this->aluno->update($data);
                return response()->json([
                    'data' => $aluno
                ]);
            }
        } else {
            throw new FileNotSend();
        }
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
}

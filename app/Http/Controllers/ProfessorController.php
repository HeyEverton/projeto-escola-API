<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessorFotoRequest;
use App\Http\Requests\CreateProfessorRequest;
use App\Models\Professor;
use App\Services\ProfessorService;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function __construct(private Professor $professor, ProfessorService $professorService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProfessorRequest $request, CreateProfessorFotoRequest $professorFotoRequest)
    {
        $input = $request->validated();
        $data = $request->all();
        dd($data);

        $professorFoto = $professorFotoRequest->file('professor_foto');
        try {
            $arquivo = '';
            if ($professorFoto) {
                if ($request->file('professor_foto')->isValid()) {
                    $extensaoArquivo = $professorFoto->getClientOriginalExtension();
                    $nomeProfessor = $request->get('nome');
                    $arquivo = $professorFoto->storeAs('fotosProfessores', "{$nomeProfessor}" .  "." . "{$extensaoArquivo}");
                }
            }
            $data['aluno_foto'] = $arquivo;

            $this->professor->create($data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

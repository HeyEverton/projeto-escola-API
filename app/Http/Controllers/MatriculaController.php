<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function __construct(private Matricula $matricula)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matriculas = $this->matricula->select()->paginate();
        return response()->json($matriculas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatriculaRequest $request)
    {
        $input = $request->validated();
        $matricula = $this->matricula->create($input);
        return response()->json($matricula, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matricula = $this->matricula->find($id);

        if(empty($matricula)) { throw new ModelNotFoundException(); }
        return response()->json($matricula, 200);
    }

    public function showRelations($id)
    {
        $matricula = $this->matricula->with('aluno')->with('parcelas')->find($id);

        if(empty($matricula)) { throw new ModelNotFoundException(); }
        return response()->json($matricula, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatriculaRequest $request, $id)
    {
        $input = $request->validated();
        $matricula = $this->matricula->find($id);
        if(empty($matricula)) { throw new ModelNotFoundException(); }
        $matricula->update($input);
        return response()->json($matricula, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matricula = $this->matricula->find($id);
        if (empty($matricula)) { throw new ModelNotFoundException(); }
        $matricula->delete();

        return response()->json([
            'message' => 'Excluído com sucesso',
        ],200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurmaRequest;
use App\Http\Resources\TurmaResource;
use App\Models\Turma;
use App\Services\TurmaService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TurmaController extends Controller
{

    public function __construct(private Turma $turma)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = $this->turma->select()->paginate();

        return response()->json($turmas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TurmaRequest $request)
    {
        $input = $request->validated();
        $turma = $this->turma->create($input);
        return response()->json([
            'data' => $turma
        ], 200);
        // return new TurmaResource($turma);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $turma = $this->turma->find($id);
        if (empty($turma)) {
            throw new ModelNotFoundException();
        }
        return new TurmaResource($turma);
    }

    public function showRelation($id)
    {
        $turma = $this->turma->with('professor')->with('curso')->find($id);

        if (empty($turma)) {
            throw new ModelNotFoundException();
        }
        return response()->json([
            'data' => $turma
        ]);
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
        $input = $request->validated();

        $turma = $this->turma->find($id);
        if (empty($turma)) {
            throw new ModelNotFoundException();
        }
        $turma->update($input);
        return new TurmaResource($turma);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $turma = $this->turma->find($id);
        if (empty($turma)) {
            throw new ModelNotFoundException();
        }
        $turma->delete();

        return response()->json([
            'message' => 'Excluido com sucesso.',
        ]);
    }
}

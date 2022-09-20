<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Http\Requests\CursoUpdateRequest;
use App\Http\Resources\CursoResource;
use App\Models\Curso;
use App\Services\CursoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function __construct(private Curso $curso)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = $this->curso->select()->paginate();

        return response()->json($curso, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoRequest $request)
    {

        $input = $request->validated();
        $curso = $this->curso->create($input);

        return new CursoResource($curso);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = $this->curso->find($id);
        if (empty($curso)) {
            throw new ModelNotFoundException();
        }

        return new CursoResource($curso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CursoUpdateRequest $request, $id)
    {
        $input = $request->validated();

        $curso = $this->curso->find($id);
        if(empty($curso)) {
            throw new ModelNotFoundException();
        }

        $curso->update($input);

        return new CursoResource($curso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = $this->curso->find($id);
        if (empty($curso)) {
            throw new ModelNotFoundException();
        }
        $curso->delete();

        return response()->json([
            'msg' => 'excluido com sucesso',
        ]);
    }
}

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
        $this->authorize('view-any', Curso::class);
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
        $this->authorize('create', Curso::class);
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
     $this->authorize('view', Curso::class);
     $this->authorize('view', Curso::class);
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
        $this->authorize('update', Curso::class);
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
        $this->authorize('delete', Curso::class);
        $curso = $this->curso->find($id);
        if (empty($curso)) {
            throw new ModelNotFoundException();
        }
        $curso->delete();

        return response()->json([
            'msg' => 'excluido com sucesso',
        ]);
    }

    public function pesquisarNome($nome)
    {
        $cursos = $this->curso->select()->where('nome', 'like', '%' . $nome . '%')->paginate();
        return response()->json($cursos, 200);
    }

    public function pesquisarPreco($preco)
    {
        $cursos = $this->curso->select()->where('preco', 'like', '%' . $preco . '%')->paginate();
        return response()->json($cursos, 200);
    }

    
    public function todosCursosContagem()
    {
        $cursos = $this->curso->select('*')->count();
        return response()->json([
            'contagem_cursos' => $cursos
        ]);
    }
    
    public function todosCursosEstimativa()
    {
        // $cursos = Curso::whereRaw("DATE(created_at) = '" . date('D/M/Y') . "'")->get();
        $cursos = Curso::whereDate('created_at', today())->get();
        return $cursos;
        // $cursos = $this->curso->where('created_at', 'like', '%' . $mes . '%')->count('*');
        // return response()->json([
        //     'contagem_cursos' => $cursos
        // ]);
    }
}

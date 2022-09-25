<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcelaRequest;
use App\Models\Parcela;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    public function __construct(private Parcela $parcela)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parcelas = $this->parcela->select()->paginate();
        return response()->json($parcelas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParcelaRequest $request)
    {
        $input = $request->validated();
        $parcela = $this->parcela->create($input);
        return response()->json($parcela, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parcela = $this->parcela->find($id);
        if (empty($parcela)) {
            throw new ModelNotFoundException();
        }
        return response()->json($parcela, 200);
    }

    public function showRelation($id)
    {
        $parcela = $this->parcela->with('aluno')->with('matricula')->find($id);
        if (empty($parcela)) {
            throw new ModelNotFoundException();
        }
        return response()->json($parcela, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParcelaRequest $request, $id)
    {
        $input = $request->validated();

        $parcela = $this->parcela->find($id);
        if (empty($parcela)) {
            throw new ModelNotFoundException();
        }
        $parcela->update($input);
        return response()->json([
            'data' => $parcela
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parcela = $this->parcela->find($id);
        if (empty($parcela)) {
            throw new ModelNotFoundException();
        }
        $parcela->delete();

        return response()->json([
            'message' => 'Excluido com sucesso',
        ], 200);
    }
}

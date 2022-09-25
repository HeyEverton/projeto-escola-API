<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagamentoRequest;
use App\Models\Pagamento;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function __construct(private Pagamento $pagamento)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagamento = $this->pagamento->select()->paginate();
        return response()->json($pagamento, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagamentoRequest $request)
    {
        $input = $request->validated();
        // dd($input);
        $pagamento = auth()->user()->pagamentos()->create($input);

        return response()->json($pagamento, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagamento = $this->pagamento->find($id);
        if (empty($pagamento)) {
            throw new ModelNotFoundException();
        }
        return response()->json($pagamento, 200);
    }

    public function showRelation($id)
    {
        $pagamento = $this->pagamento->with('aluno')->with('usuario')->find($id);
        if (empty($pagamento)) {
            throw new ModelNotFoundException();
        }
        return response()->json($pagamento, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagamentoRequest $request, $id)
    {
        $input = $request->validated();
        $pagamento = $this->pagamento->find($id);
        if (empty($pagamento)) {
            throw new ModelNotFoundException();
        }
        $pagamento = auth()->user()->pagamentos()->update($input);

        return response()->json([
            'message' => 'O pagamento foi atualizado com sucesso.'
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
       $pagamento = $this->pagamento->find($id);
       if(empty($pagamento)) {
        throw new ModelNotFoundException();
       }
       $pagamento->delete();
       return response()->json([
        'message' => 'O pagamento foi excluido com sucesso.'
       ], 200);
       
    }
}

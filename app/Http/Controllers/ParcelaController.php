<?php

namespace App\Http\Controllers;

use App\Http\Requests\{InformarPagamentoRequest, ParcelaRequest, ParcelaStoreRequest};
use App\Models\Aluno;
use App\Models\Parcela;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $request->validated();
        $dataV = new DateTime($request->data_vencimento);
        $valorMensalidade = $request->valor_curso / $request->qtd_parcelas;
        $parcelas = [];

        for ($i = 1; $i <= $request->qtd_parcelas; $i++) {
            $objParcela = [
                'num_parcela' => $i,
                'valor_parcela' => $valorMensalidade,
                'data_vencimento' => $dataV->modify('+1 month')->format('Y-m-d'),
            ];
            $parcelas[] = $objParcela;
        }
        return response($parcelas);
    }

    public function criarParcelas(ParcelaStoreRequest $request)
    {
        $request->validated();
        $dataV = new DateTime($request->data_vencimento);
        $valorMensalidade = $request->valor_curso / $request->qtd_parcelas;
        $parcelas = [];

        for ($i = 1; $i <= $request->qtd_parcelas; $i++) {

            $parcelas = Parcela::create([
                'num_parcela' => $i,
                'valor_parcela' => $valorMensalidade,
                'data_vencimento' => $dataV->modify('+1 month')->format('Y-m-d'),
                'matricula_id' => $request->matricula_id,
                'aluno_id' => $request->aluno_id,
            ]);
        }
        return response()->json([
            $parcelas
        ], 200);
    }

    public function informarPagamento(InformarPagamentoRequest $request, $id)
    {
        $request->validated();
        $parcela = $this->parcela->find($id);
        
        if (!empty($parcela)) {
            $parcela->fill($request->all());
            $parcela->save();

            return response()->json([
                'message' => 'O pagamento foi informado com sucesso.'
            ], 200);

        } else {
            throw new ModelNotFoundException();
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
        $parcela = $this->parcela->with('aluno')->with('usuario')->find($id);
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
            'message' => 'Excluído com sucesso',
        ], 200);
    }

    public function parcelaAluno($id)
    {
        $parcelas = Parcela::where('aluno_id', $id)->get();
        return response()->json($parcelas, 200);
    }

    public function parcelaAlunoContagem($id)
    {
        $contagem = Parcela::count('*')->where('aluno_id', $id)->get();
        return response()->json([
            'data' => $contagem
        ], 200);
    }
}

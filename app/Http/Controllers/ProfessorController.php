<?php

namespace App\Http\Controllers;

use App\Exceptions\FileNotSend;
use App\Http\Requests\CreateProfessorFotoRequest;
use App\Http\Requests\CreateProfessorRequest;
use App\Http\Resources\ProfessorResource;
use App\Models\Professor;
use App\Services\ProfessorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $professores = $this->professor->select()->paginate();

        return response()->json($professores, 200);
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
        // $aluno = $this->professorService->store($input, $request, $data);
        
        if ($professorFotoRequest->hasFile('professor_foto')) {
            if ($request->file('professor_foto')->isValid()) {
                $professorFoto = $professorFotoRequest->file('professor_foto')->store('fotos-professores', 'public');
                
                $url = asset(Storage::url($professorFoto));
                
                $data['professor_foto'] = $url;

                $professor = $this->professor->create($data);
                $resource = new ProfessorResource($professor);

                return $resource;
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
        $professor = $this->professor->find($id);
        if (empty($professor)) {
            throw new ModelNotFoundException();
        }

        return new ProfessorResource($professor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProfessorRequest $request, $id, CreateProfessorFotoRequest $professorFotoRequest)
    {
        $input = $request->validated();
        $data = $request->all();
        // $aluno = $this->professorService->update($input, $request, $data);

        
        $professor = $this->professor->find($id);
        $professor->fill($request->except('professor_foto'));
        dd($professor);
        if ($professorFotoRequest->hasFile('professor_foto')) {
            if ($request->file('professor_foto')->isValid()) {
                $professorFoto = $professorFotoRequest->file('professor_foto')->store('fotos-professores', 'public');
                
                $url = asset(Storage::url($professorFoto));
                
                $data['professor_foto'] = $url;
                $professor = $this->professor->update($data);

                // $resource = new ProfessorResource($professor);

                return $professor;
                // return $resource;
                // return response()->json([
                //     'message' => 'atualizou'
                // ]);
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
        $professor = $this->professor->find($id);
        if (empty($professor)) {
            throw new ModelNotFoundException();
        }
        $professor->delete();

        return response()->json([
            'message' => 'Excluido com sucesos',
        ]);
    }
}

<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/')->group(function() {
    //AUTENTICACAO INCOMPLETA
    Route::post('login', [AuthController::class, 'login']);
    Route::post('cadastro', [AuthController::class, 'register']);
    Route::post('verificar-email', [AuthController::class, 'verifyEmail']);
    Route::post('esqueceu-a-senha', [AuthController::class, 'forgotPassword']);
    Route::post('recuperar-senha', [AuthController::class, 'resetPassword']);

    //MATRICULAS
    Route::resource('matriculas', MatriculaController::class);
    Route::get('matriculas/aluno/{id}', [MatriculaController::class, 'showRelation']);

    //ALUNO
    Route::resource('alunos', AlunoController::class);

    //PROFESSOR    
    Route::resource('professores', ProfessorController::class);
    
    //CURSO
    Route::resource('cursos', CursoController::class);

    //TURMA
    Route::resource('turmas',  TurmaController::class) ;
    Route::get('turmas/editar/{id}', [TurmaController::class, 'showRelation']);

    //PARCELAS
    Route::resource('parcelas', ParcelaController::class);
    Route::get('parcelas/aluno/matricula/{id}', [ParcelaController::class, 'showRelation']);;

    //pagamentos
    Route::resource('pagamentos', PagamentoController::class);
    Route::get('pagamentos/alunos/{id}', [PagamentoController::class, 'showRelation']);
   
});

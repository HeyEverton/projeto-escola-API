<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfessorController;
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



    //ALUNO
    Route::get('alunos', [AlunoController::class, 'index']);
    Route::post('alunos', [AlunoController::class, 'store']);
    Route::get('alunos/{id}', [AlunoController::class, 'show']);
    Route::put('alunos/{id}', [AlunoController::class, 'update']);
    Route::delete('alunos/{id}', [AlunoController::class, 'destroy']);

    //PROFESSOR
    
    Route::post('professores', [ProfessorController::class, 'store']);

    //CURSO
    Route::post('cursos', [CursoController::class, 'store']);
    Route::get('cursos', [CursoController::class, 'index']);
    Route::get('cursos/{id}', [CursoController::class, 'show']);
    Route::put('cursos/{id}', [CursoController::class, 'update']);
    Route::delete('cursos/{id}', [CursoController::class, 'destroy']);
});

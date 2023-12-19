<?php

use App\Http\Controllers\Api\{
    CepController,
    MovimentacaoController,
    ContaController,
    UserController,
    loginController,
    RegisterController,
};

use Illuminate\Support\Facades\Route;


Route::get('/usuario', [UserController::class, 'index']);
Route::put('/usuario', [UserController::class, 'update']);
Route::delete('/usuario/{cpf}', [UserController::class, 'delete']);     

Route::get('/contas/{cpf}', [ContaController::class, 'index']);
Route::post('/conta', [ContaController::class, 'create']);
Route::delete('/conta/{conta}', [ContaController::class, 'delete']); 
Route::get('/contas', [ContaController::class, 'getAllContas']);
Route::get('/contas/{conta}/extrato', [MovimentacaoController::class, 'extrato']);

Route::post('/movimentacao', [MovimentacaoController::class, 'index']);

Route::get('/cep/{cep}', [CepController::class, 'index']);
Route::post('/cep', [CepController::class, 'create']);
Route::post('/endereco', [CepController::class, 'store']);
    
Route::post('/usuario', [RegisterController::class, 'register']);

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});
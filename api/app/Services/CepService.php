<?php 

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;
use App\Repositories\CepRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;


class CepService extends ResponseController
{

    protected $repository;

    public function __construct(CepRepository $cepRepository)
    {
        $this->repository = $cepRepository;
    }

    public function getCep($request)
    {
        if($request > 99999999){
            return response()->json(['message' => 'O Cep deve conter 8 digitos!'], 404);
        }
        $cep = $this->repository->findCep($request);

        if (!$cep) {
            return response()->json(['message' => 'Cep não encontrado!'], 404);
        }
        return $this->sendResponse($cep,'Cep Encontrado com sucesso!', 200);
    }

    public function createCep(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cep' => 'required',
            'rua' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Preencha todos os campos', $validator->errors());       
        }
        $cep_criado = $this->repository->createCep($request);
        if(!$cep_criado){
            return response()->json(['error' => 'Não foi possível cadastrar o Cep'], 404);
        }
        return $this->sendResponse($cep_criado, 'Cep criado com Sucesso!', 201);
    }

    public function createEndereco($request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required',      
            'cep' => 'required',
            'rua' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Preencha todos os campos', $validator->errors());       
        }
        $enderecoCriado = $this->repository->createEndereco($request);
        if(!$enderecoCriado){
            return response()->json(['error' => 'Não foi possível cadastrar o Endereco'], 404);
        }
        return $this->sendResponse($enderecoCriado, 'Endereco criado com Sucesso!', 201);
        
    }
}
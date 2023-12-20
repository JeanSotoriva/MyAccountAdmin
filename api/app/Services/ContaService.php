<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Models\User;
use App\Models\Conta;
use App\Http\Controllers\Controller;
use App\Repositories\ContaRepository;
use App\Repositories\UserRepository;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Symfony\Component\VarDumper\Cloner\Data;

class ContaService extends ResponseController
{

    protected $repository;
    protected $userRepository;

    public function __construct(ContaRepository $contaRepository, UserRepository $userRepository)
    {
        $this->repository = $contaRepository;
        $this->userRepository = $userRepository;
    }

    public function getContasByCpf($cpf)
    {
        $user = $this->userRepository->findUser($cpf);
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
        $contas = $this->repository->getContasByCpf($cpf);
        if (!$contas) {
            return response()->json(['error' => 'O Usuário não possui contas'], 404);
        }
        return $this->sendResponse($contas,'success', 200);
    }

    public function createConta(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'conta' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Preencha todos os campos !', $validator->errors());       
        }
        if ($request->conta > 99999999) {
            return $this->sendError('A conta deve ter no maximo 8 digitos!', '', 404);   
        }
        if (!$user = $this->findUserByCpf($request->cpf)) {
            return $this->sendError('Usuário não encontrado!', '', 404);
        }
        if ($this->repository->ContaExists($request->conta)) {
            return $this->sendError('Essa conta já existe!', '', 404);
        }
        $conta_criada = $this->repository->createContaRepository($request);
        if (!$conta_criada) {
            return $this->sendError('Não foi possível criar a conta!', '', 404);
        }
        $conta_criada = ([
            'id' => $conta_criada->id,
            'cpf' => $conta_criada->cpf,
            'conta' => $conta_criada->conta,
        ]);
        return $this->sendResponse($conta_criada, 'Conta criada com Sucesso!',  201);
    }

    public function deleteContaService($conta)
    {
        $conta = $this->repository->ContaExists($conta);
        if (!$conta) {
            return response()->json(['error' => 'Essa conta não existe!'], 404);
        }
        if($hasMovimentacao = $this->repository->contaHasMovimentacao($conta)){
            // $hasMovimentacao->delete();
            $conta->movimentacoes()->delete();
        }
        $conta->delete();
        return $this->sendResponse('Conta deletada com sucesso!.', 'success', 200);
    }

    public function findUserByCpf($cpf){
        $user = $this->userRepository->findUser($cpf);
        return $user;
    }

    public function getAllContas(){
        return $this->repository->getAllContas();
    }

}
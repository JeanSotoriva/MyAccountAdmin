<?php 

namespace App\Services;

use App\Repositories\MovimentacaoRepository;
use App\Repositories\ContaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MovimentacaoService extends ResponseController
{
    protected $contaRepository;
    protected $repository;

    public function __construct(MovimentacaoRepository $movimentacaoRepository, ContaRepository $contaRepository)
    {
        $this->repository = $movimentacaoRepository;
        $this->contaRepository = $contaRepository;
    }

    public function ActionGeneratorService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conta' => 'required',
            'acao' => 'required',
            'valor' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Preencha os dados!', $validator->errors());       
        }
        if (!$this->contaRepository->ContaExists($request->conta)) {
            return response()->json(['error' => 'Essa conta não existe!'], 404);
        }
        if($request->valor <= 0){
            return $this->sendError(['Voce nao pode depositar ou sacar valores negativos!']);
        }
        if($request->acao == 'depositar'){
            $deposito = $this->repository->depositar($request);
            return $this->sendResponse( $deposito, 'Deposito efetuado com Sucesso!', 201);
        }
        else if($request->acao == 'sacar'){
            $saldo = $this->contaRepository->getSaldoByConta($request->conta);
            if($saldo < $request->valor){
                return $this->sendError(['Saldo insuficiente!']);
            }
            $saque = $this->repository->sacar($request);
            return $this->sendResponse($saque, 'Saque efetuado com Sucesso!',  201);
        }
    }

    public function getExtrato($request)
    {
        if (!$this->contaRepository->ContaExists($request)) {
            return response()->json(['error' => 'Essa conta não existe!'], 404);
        }
        $extrato = $this->repository->getExtrato($request);
        return $this->sendResponse($extrato, 'Extrato feito com Sucesso!',  201);
    }
    
}
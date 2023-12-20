<?php

namespace App\Repositories;

use App\Models\Movimentacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Conta;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\DB;

class MovimentacaoRepository
{
    protected $entity;

    public function __construct(Movimentacao $movimentacao)
    {
        $this->entity = $movimentacao;
    }

    public function depositar(Request $request)
    {
        $conta = Conta::where('conta', $request->conta)->first();
        $deposito = $request['valor'];
        $conta->saldo += $deposito;
        $conta->save();
        $deposito = $this->entity->create([
            'num_conta' => $request->conta,
            'acao' => 'depositar',
            'valor' => $request->valor,
        ]);
        return $deposito;
    }

    public function sacar($request)
    {      
        $conta = Conta::where('conta', $request->conta)->first();
        $saque = $request['valor'];
        $conta->saldo -= $saque;
        $conta->save();
        $saque = $this->entity->create([
            'num_conta' => $request->conta,
            'acao' => 'depositar',
            'valor' => -abs($request->valor),
        ]);
        return $saque;
    }

    public function getExtrato($contaNumero)
    {
        $conta = Conta::where('conta', $contaNumero)->first();
        $extrato = $this->entity->where('num_conta', $conta->conta)->first();
        $extrato = $conta->movimentacoes()->select(
            'acao', 
            'valor',
            DB::raw("TO_CHAR(data_movimentacao, 'DD-MM-YYYY HH24:MI:SS') as data"),
        )->get();
        return $extrato;
    }
}
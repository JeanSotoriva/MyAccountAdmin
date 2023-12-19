<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conta;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\DB;

class ContaRepository
{
    protected $entity;

    public function __construct(Conta $conta)
    {
        $this->entity = $conta;
    }

    public function getContasByCpf($cpf)
    {
        $user = User::where('cpf', $cpf)->first();
        $contas = $user->contas()->select(
            'conta', 
            'saldo', 
            DB::raw("TO_CHAR(data_criacao, 'DD-MM-YYYY HH24:MI:SS') as data")
        )->get();
        return $contas;
    }

    public function createContaRepository(Request $request)
    {
        $user = User::where('cpf', $request->cpf)->first();
        $conta_criada = $this->entity->create([
            'cpf' => $user->cpf,
            'conta' => $request->conta,
            'saldo' => '0',
            'data_criacao' => now(),
        ]);
        return $conta_criada;
    }

    public function contaExists($conta){
        $conta = $this->entity->where('conta', $conta)->first();
        return $conta;
    }

    public function userHasConta($request){
        $conta = Conta::where('cpf', $request)->first();
        return $conta;
    }

    public function getAllContas()
    {
        $resultado = DB::table('contas')
            ->join('users', 'users.cpf', '=', 'contas.cpf')
            ->select('users.nome', 'contas.*')
            ->get();
        return $resultado;
    }

    public function getSaldoByConta($numConta)
    {
        $conta = Conta::where('conta', $numConta)->first();
        return $conta->saldo;
    }

}
<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Models\Cep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CepRepository
{
    protected $entity;

    public function __construct(Cep $Cep)
    {
        $this->entity = $Cep;
    }

    public function createCep(Request $request)
    {
        $cep_criado = $this->entity->create([
            'cep' => $request->cep,
            'rua' => $request->rua,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
        ]);
        return $cep_criado;
    }

    public function findCep($request){
        $cep = $this->entity->where('cep', $request)->first();
        return $cep;
    }

    public function createEndereco(Request $request)
    {
        $endereco = Endereco::create([
            'usuario_id' => $request->usuario_id,
            'cep' => $request->cep,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
        ]);
        return $endereco;
    }

}
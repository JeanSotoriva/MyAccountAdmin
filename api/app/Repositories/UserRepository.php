<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $entity;
    protected $user;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers()
    {
        $resultado = DB::table('users')
        ->leftJoin('enderecos', 'enderecos.usuario_id', '=', 'users.id')
        ->select('users.*', 'enderecos.cep', 'enderecos.rua', 'enderecos.numero', 'enderecos.cidade', 'enderecos.estado')
        ->get();
        return $resultado;
    }

    public function updateUsuario(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->cpf = $request['cpf'];
        $user->nome = $request['nome'];
        $user->data_nascimento = $request['data_nascimento'];
        $user->save();
        return $user;
    }

    public function findUser($request){
        $user = User::where('cpf', $request)->first();
        return $user;
    }

}
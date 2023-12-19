<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class RegisterController extends ResponseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'nome' => 'required',
            'data_nascimento' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Preencha os dados !', $validator->errors());       
        }
   
        $data = $request->all();

        if (User::where('cpf', $request->cpf)->exists()) {
            return $this->sendError('O usuário já existe.', 'error', 400);
        }
 
        // $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $success['id'] =  $user->id;
        $success['cpf'] =  $user->cpf;
        $success['nome'] =  $user->nome;
        $success['data_nascimento'] =  $user->data_nascimento;
        return $this->sendResponse($success, 'Usuario registrado com Sucesso!', 201);
    }
}
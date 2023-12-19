<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class loginController extends ResponseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('error', 'Credenciais inválidas.', 401);
        }
        $successToken['token'] =  $user->createToken('MyApp')->plainTextToken;

        return $this->sendResponse($successToken, 'Usuário Logado com Sucesso.', 200);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return new userResource($user);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json([], 204);
    }
}
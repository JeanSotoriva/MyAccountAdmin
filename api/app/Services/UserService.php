<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\ContaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LaravelLegends\PtBrValidator\Rules\FormatoCpf;


class UserService extends ResponseController
{

    protected $repository;
    protected $contaRepository;

    public function __construct(UserRepository $userRepository, ContaRepository $contaRepository)
    {
        $this->repository = $userRepository;
        $this->contaRepository = $contaRepository;
    }

    public function getAllUsers()
    {
        return $this->repository->getAllUsers();
    }

    public function updateUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpf' => ['required', new FormatoCpf()],
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->toArray();
            if (isset($errors['cpf'])) {
                return $this->sendError('Cpf Inválido!', $errors['cpf']);
            }
            return $this->sendError('Preencha os dados corretamente!', $errors);
        }
        $user = $this->repository->updateUsuario($request);
        return $this->sendResponse([
            'cpf' => $user->cpf,
            'nome' => $user->nome,
            'data_nascimento' => $user->data_nascimento,
            
        ], 'Dados Atualizados com Sucesso.');
    }
    
    public function delete($request){
        $user = $this->repository->findUser($request);
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
        $hasConta = $this->contaRepository->userHasConta($request);
        if ($hasConta) {
            return $this->sendError('Pessoa possui conta vinculada', '', 404);
        }
        if($hasEndereco = $this->repository->userHasEndereco($request)){
            $hasEndereco->delete();
        }
        $user->delete();
        return $this->sendResponse('', 'Usuário excluído com sucesso!',  200);
    }
    
}
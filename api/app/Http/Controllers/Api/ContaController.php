<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use App\Models\User;
use App\Models\Lancamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Services\ContaService;

class ContaController extends ResponseController
{
    protected $contaService;

    public function __construct(ContaService $contaService)
    {
        $this->contaService = $contaService;
    }
    protected $conta;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        return $this->contaService->getContasByCpf($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllContas()
    {
        return $this->contaService->getAllContas();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->contaService->createConta($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($request)
    {
        return $this->contaService->deleteContaService($request);
    }

}

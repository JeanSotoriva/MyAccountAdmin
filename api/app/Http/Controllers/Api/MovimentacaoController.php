<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movimentacao;
use App\Models\User;
use App\Models\Lancamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Services\MovimentacaoService;

class MovimentacaoController extends ResponseController
{
    protected $movimentacaoService;

    public function __construct(MovimentacaoService $movimentacaoService)
    {
        $this->movimentacaoService = $movimentacaoService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->movimentacaoService->ActionGeneratorService($request);
    }

    public function extrato($request)
    {
        return $this->movimentacaoService->getExtrato($request);
    }

}

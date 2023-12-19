<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use App\Http\Controllers\Controller;
use App\Services\CepService;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Symfony\Component\VarDumper\Cloner\Data;

class CepController extends ResponseController
{
    protected $cepService;

    public function __construct(CepService $cepService)
    {
        $this->cepService = $cepService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        return $this->cepService->getCep($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        return $this->cepService->createCep($request);
    }

    public function store(Request $request)
    {   
        return $this->cepService->createEndereco($request);
    }
}

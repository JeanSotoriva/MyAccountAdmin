<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCpf = SeederHelper::getUserCpf();
        $conta = Conta::create([
            'cpf' => $userCpf,
            'conta' => '14577',
            'saldo' => '100',
            'data_criacao' => Carbon::createFromFormat('d/m/Y', '16/12/2023')->format('Y-m-d'),
        ]);
    }
}
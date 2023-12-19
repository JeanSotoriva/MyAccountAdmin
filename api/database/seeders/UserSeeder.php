<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'cpf' => '03512659020',
            'nome' => 'Jean Marcos',
            'data_nascimento' => '12/05/1994',
        ]);

        SeederHelper::setUserCpf($user->cpf);
    }
}
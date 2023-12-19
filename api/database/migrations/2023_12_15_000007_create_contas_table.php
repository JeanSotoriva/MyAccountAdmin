<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf');
            $table->integer('conta')->unique();
            $table->Double('saldo');
            $table->timestamp('data_criacao');
            $table->timestamps();
        });
        
        Schema::table('contas', function (Blueprint $table) {
            $table->foreign('cpf')->references('cpf')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
};

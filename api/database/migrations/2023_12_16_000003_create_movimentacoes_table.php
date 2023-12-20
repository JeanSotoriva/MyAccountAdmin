<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('num_conta');
            $table->timestamp('data_movimentacao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('acao');
            $table->double('valor');
            $table->timestamps();
        });

        Schema::table('movimentacoes', function (Blueprint $table) {
            $table->foreign('num_conta')->references('conta')->on('contas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentacoes');
    }
};

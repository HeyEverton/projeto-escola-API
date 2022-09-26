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
        Schema::create('tb_matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('turma_id');
            $table->foreign('aluno_id')->references('id')->on('tb_alunos');
            $table->foreign('turma_id')->references('id')->on('tb_turmas');
            
            $table->double('valor_curso');
            $table->string('desconto_curso', 10)->nullable();
            $table->date('data_vencimento');
            $table->char('forma_pagamento', 1);
            $table->tinyInteger('qtd_parcelas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_matriculas');
    }
};

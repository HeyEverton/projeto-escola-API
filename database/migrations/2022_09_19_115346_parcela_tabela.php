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
        Schema::create('tb_parcelas', function (Blueprint $table) {
            $table->id();
            $table->integer('num_parcela')->nullable();
            $table->double('valor_parcela')->nullable();
            $table->date('data_vencimento')->nullable();

            $table->double('valor_pago')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->text('observacao')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->unsignedBigInteger('aluno_id')->nullable();
            $table->unsignedBigInteger('matricula_id')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('aluno_id')->references('id')->on('tb_alunos')->cascadeOnDelete();
            $table->foreign('matricula_id')->references('id')->on('tb_matriculas')->cascadeOnDelete();

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
        Schema::dropIfExists('tb_parcelas');
    }
};

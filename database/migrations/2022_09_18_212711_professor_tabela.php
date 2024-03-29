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
        Schema::create('tb_professores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->string('professor_cpf', 15)->unique();
            $table->string('professor_rg', 15);
            $table->string('professor_foto');
            $table->string('estado_civil', 10); 
            $table->string('sexo', 10); 
            $table->string('formacao', 100);
            $table->string('nacionalidade', 2);
            $table->string('tel_contato', 15);
            $table->string('nome_rua', 45);
            $table->integer('numero_residencia');
            $table->string('cep', 10); 
            $table->string('cidade', 30);
            $table->string('bairro', 20);
            $table->string('estado', 2);

            //DADOS BANCARIOS
            $table->string('banco', 4);
            $table->string('numero_conta', 10);
            $table->string('agencia', 5);
            // $table->char('forma_pagamento', 1)->nullable();
            $table->double('valor_salario')->nullable();

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
        Schema::dropIfExists('tb_professores');
    }
};

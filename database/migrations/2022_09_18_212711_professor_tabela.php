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
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('professor_cpf', 11)->unique();
            $table->string('professor_rg');
            $table->string('professor_foto');
            $table->string('estado_civil', 10); 
            $table->string('sexo', 10); 
            $table->string('tel_contato', 15);
            $table->string('nome_rua', 45);
            $table->string('cep', 10); 
            $table->string('cidade', 30);
            $table->string('bairro', 20);
            $table->string('estado', 2);

            //DADOS BANCARIOS
            $table->integer('numero_conta');
            $table->integer('agencia');
            $table->string('banco');

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

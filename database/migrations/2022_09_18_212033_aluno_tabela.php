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
        Schema::create('tb_alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cpf_aluno', 15)->unique();
            $table->string('aluno_foto');
            $table->string('email')->unique();
            $table->string('sexo', 1);
            $table->string('nacionalidade', 2);
            $table->string('escolaridade', 35);
            $table->date('data_nasc');
            $table->string('whatsapp', 15)->nullable();
            $table->string('tel_contato', 15);
            $table->string('nome_rua', 50);
            $table->integer('numero_residencia');
            $table->string('cep', 10);
            $table->string('cidade', 30);
            $table->string('bairro', 30);
            $table->string('estado', 2);

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
        Schema::dropIfExists('tb_alunos');
    }
};

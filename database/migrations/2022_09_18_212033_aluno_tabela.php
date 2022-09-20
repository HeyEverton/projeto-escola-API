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
            $table->string('nome');
            $table->string('cpf_aluno', 11)->unique();
            $table->string('aluno_foto');
            $table->string('email')->unique();
            $table->string('sexo', 10);
            $table->date('data_nasc');
            $table->string('tel_fixo', 15)->nullable();
            $table->string('tel_contato', 15);
            $table->string('nome_rua',45);
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

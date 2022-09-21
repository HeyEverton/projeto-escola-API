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
        Schema::create('tb_turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->integer('turno');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->integer('qt_max_alunos');
            $table->integer('qt_atual_alunos');
            $table->time('horaria_entrada');
            $table->time('horaria_saida');
            $table->integer('modalidade');
            $table->string('status', 30);

            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('curso_id');

            $table->foreign('professor_id')->references('id')->on('tb_professores');
            $table->foreign('curso_id')->references('id')->on('tb_cursos');

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
        Schema::dropIfExists('tb_turmas');
    }
};

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
            $table->string('turno', 15); 
            $table->string('data_inicio', 15);
            $table->string('data_termino', 15);
            $table->integer('qt_max_alunos');
            $table->integer('qt_atual_alunos');
            $table->string('horario_entrada', 10); 
            $table->string('horario_saida', 10 );
            $table->string('modalidade', 20);
            $table->string('status', 13)->default('Em aberto'); 

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

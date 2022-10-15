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
            $table->string('turno', 2); 
            $table->date('data_inicio', 15);
            $table->date('data_termino', 15)->nullable();
            $table->integer('qt_max_alunos');
            $table->integer('qt_atual_alunos');
            $table->time('horario_entrada'); 
            $table->time('horario_saida');
            $table->tinyInteger('modalidade')->default(1);
            $table->char('status', 2)->default('A'); 

            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('curso_id');

            $table->foreign('professor_id')->references('id')->on('tb_professores')->cascadeOnDelete();
            $table->foreign('curso_id')->references('id')->on('tb_cursos')->cascadeOnDelete();

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

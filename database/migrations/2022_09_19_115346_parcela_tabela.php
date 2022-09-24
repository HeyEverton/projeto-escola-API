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
            $table->integer('num_parcelas');
            $table->double('valor_parcela');
            $table->string('data_vencimento');
            $table->string('status', 30);
            $table->unsignedBigInteger('aluno_id');

            $table->foreign('aluno_id')->references('id')->on('tb_alunos');

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

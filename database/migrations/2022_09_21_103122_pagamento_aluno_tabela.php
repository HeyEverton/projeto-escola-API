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
        Schema::create('tb_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recebeu_id');
            $table->date('data_pagamento');
            $table->string('valor_pago', 30);
            $table->text('observacao');

            $table->foreign('recebeu_id')->references('id')->on('tb_usuarios');
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
        Schema::dropIfExists('tb_pagamentos');
    }
};

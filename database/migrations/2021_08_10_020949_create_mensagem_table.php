<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_remetente')->nullable();
            $table->foreign('id_remetente')->unsigned()
                ->references('id')
                ->on('usuario');
            $table->unsignedBigInteger('id_destinatario')->nullable();
            $table->foreign('id_destinatario')->unsigned()
                ->references('id')
                ->on('usuario');
            $table->string('texto');
            $table->boolean('lido');
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
        Schema::dropIfExists('mensagem');
    }
}

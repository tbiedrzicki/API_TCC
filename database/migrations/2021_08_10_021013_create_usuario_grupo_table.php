<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_grupo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario') -> nullable();
            $table->foreign('id_usuario')->unsigned()
                    ->references('id')            
                    ->on('usuario');
                    $table->unsignedBigInteger('id_grupo') -> nullable();
                    $table->foreign('id_grupo')->unsigned()
                            ->references('id')            
                            ->on('grupo'); 
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
        Schema::dropIfExists('usuario_grupo');
    }
}

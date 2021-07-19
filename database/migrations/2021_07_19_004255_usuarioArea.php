<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarioArea', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario') -> nullable();
            $table->foreign('id_usuario')->unsigned()
                    ->references('id')            
                    ->on('usuario');
            $table->unsignedBigInteger('id_area')-> nullable();
            $table->foreign('id_area')->unsigned()
                    ->references('id')            
                    ->on('areaInteresse');
            $table->boolean('ajuda');
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
        Schema::dropIfExists('usuario_area');
    }
}

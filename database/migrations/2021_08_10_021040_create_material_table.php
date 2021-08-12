<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario') -> nullable();
            $table->foreign('id_usuario')->unsigned()
                    ->references('id')            
                    ->on('usuario');
            $table->unsignedBigInteger('id_area')-> nullable();
            $table->foreign('id_area')->unsigned()
                    ->references('id')            
                    ->on('area');
            $table->string('descrição');
            $table->string('local_arquivo');            
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
        Schema::dropIfExists('material');
    }
}

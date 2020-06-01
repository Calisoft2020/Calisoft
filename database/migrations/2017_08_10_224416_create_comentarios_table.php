<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Comentarios', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('comentario');
            $table->integer('FK_UserId')->unsigned();
            $table->integer('FK_ProyectoId')->unsigned();
            $table->integer('FK_ModuloId')->unsigned();

            $table->foreign('FK_UserId')->references('PK_id')
            ->on('TBL_Usuarios')->onUpdate('cascade');

            $table->foreign('FK_ProyectoId')->references('PK_id')
            ->on('TBL_Proyectos')->onUpdate('cascade');

            $table->foreign('FK_ModuloId')->references('PK_id')
            ->on('TBL_Modulos')->onUpdate('cascade');

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
        Schema::dropIfExists('TBL_Comentarios');
    }
}

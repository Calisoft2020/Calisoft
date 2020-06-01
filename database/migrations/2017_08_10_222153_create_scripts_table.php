<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Scripts', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('url');
            $table->text('comentario')->nullable();
            $table->enum('estado', ['sin calificar','calificado'])->default('sin calificar');
            $table->integer('FK_ProyectoId')->unsigned();
            $table->timestamps();
            

            $table->foreign('FK_ProyectoId')->references('PK_id')
            ->on('TBL_Proyectos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_scripts');
    }
}

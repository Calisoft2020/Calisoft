<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivoBdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_ArchivoBd',function(Blueprint $table){
          $table->increments('PK_id');
          $table->string('url');
          $table->text('observacion')->nullable();
          $table->integer('FK_ProyectoId')->unsigned();
          $table->integer('FK_TipoBdId')->unsigned();          

          $table->foreign('FK_ProyectoId')->references('PK_id')
          ->on('TBL_Proyectos')->onUpdate('cascade');

          $table->foreign('FK_TipoBdId')->references('PK_id')
          ->on('TBL_TipoBd')->onUpdate('cascade');

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
        Schema::dropIfExists('TBL_ArchivoBd');
    }
}

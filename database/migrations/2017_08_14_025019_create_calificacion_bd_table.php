<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionBdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_CalificacionBd',function(Blueprint $table){
          $table->integer('total')->default(0);
          $table->integer('acertadas')->default(0);
          $table->double('calificacion')->default(0);
          $table->integer('FK_TipoNomenclaturaId')->unsigned();
          $table->integer('FK_ArchivoBdId')->unsigned();

          $table->foreign('FK_TipoNomenclaturaId')->references('PK_id')
            ->on('TBL_TipoNomenclatura')->onDelete('cascade');

          $table->foreign('FK_ArchivoBdId')->references('PK_id')
            ->on('TBL_ArchivoBd')->onDelete('cascade');
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
        //
    }
}

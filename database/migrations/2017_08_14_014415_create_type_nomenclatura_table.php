<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeNomenclaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_TipoNomenclatura',function(Blueprint $table){
          $table->increments('PK_id');
          $table->string('nombre');
          $table->string('estandar');
          $table->string('nomenclatura');
          $table->integer('valor');
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
        Schema::dropIfExists('TBL_TipoNomenclatura');
    }
}

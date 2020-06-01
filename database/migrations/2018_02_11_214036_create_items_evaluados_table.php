<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsEvaluadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_ItemsEvaluados', function (Blueprint $table) {
            $table->increments('PK_id');
            $table->string('atributo');
            $table->integer('fila')->unsigned();
            $table->boolean('calificacion');
            $table->integer('FK_scriptId')->unsigned();
            $table->integer('FK_itemId')->unsigned();

            $table->foreign('FK_scriptId')->references('PK_id')
            ->on('TBL_Scripts')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('FK_itemId')->references('PK_id')
            ->on('TBL_ItemsCodificacion')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('TBL_ItemsEvaluados');
    }
}

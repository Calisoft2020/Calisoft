<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaCodificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_NotaCodificacion', function (Blueprint $table) {
            $table->float('nota')->default('0');
            $table->integer('total')->default('0');
            $table->integer('acertadas')->default('0');
            $table->integer('FK_ScriptsId')->unsigned();
            $table->integer('FK_ItemsId')->unsigned();

            $table->foreign('FK_ScriptsId')->references('PK_id')
            ->on('TBL_Scripts')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('FK_ItemsId')->references('PK_id')
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
        Schema::dropIfExists('TBL_NotaCodificacion');
    }
}

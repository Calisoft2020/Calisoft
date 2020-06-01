<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_EvaluacionDocumento', function (Blueprint $table) {

            $table->boolean('checked')->default(false);
            $table->text('observacion')->nullable();
            $table->unsignedInteger('FK_DocumentoId');
            $table->unsignedInteger('FK_ComponenteId');
            $table->unsignedInteger('FK_EvaluatorId');
            $table->timestamps();

            $table->foreign('FK_ComponenteId')->references('PK_id')->on('TBL_ComponentesDocumento')
                ->onDelete('cascade');

            $table->foreign('FK_DocumentoId')->references('PK_id')->on('TBL_Documentos')
                ->onDelete('cascade');

            $table->foreign('FK_EvaluatorId')->references('PK_id')->on('TBL_Usuarios')
                ->onDelete('cascade');

            $table->primary(['FK_DocumentoId', 'FK_ComponenteId', 'FK_EvaluatorId'], 'my_long_table_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_EvaluacionDocumento');
    }
}

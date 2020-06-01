<?php
namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class DocEvaluation extends Model
{
    protected $table = "TBL_EvaluacionDocumento";

    protected $fillable = [
        'checked', 'observacion', 'FK_DocumentoId', 'FK_ComponenteId', 'FK_EvaluatorId'
    ];


    public function documento()
    {
        return $this->belongsTo(Documento::class, 'FK_DocumentoId', 'PK_id');
    }

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'FK_ComponenteId', 'PK_id');
    }

    public function evaluador()
    {
        return $this->belongsTo(User::class, 'FK_EvaluatorId', 'PK_id');
    }




}

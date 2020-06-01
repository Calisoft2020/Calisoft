<?php
namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Documento extends Model
{
    protected $table = "TBL_Documentos";
    protected $primaryKey = "PK_id";
    protected $fillable = ['url', 'FK_ProyectoId', 'FK_TipoDocumentoId'];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getUrlAttribute($url)
    {
        return Storage::disk('documentos')->url($url);
    }

    public function tipo()
    {
        return $this->belongsTo(TiposDocumento::class, 'FK_TipoDocumentoId', 'PK_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'FK_ProyectoId', 'PK_id');
    }

    public function evaluaciones()
    {
        return $this->hasMany(DocEvaluation::class, 'FK_DocumentoId');
    }
}

<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class ArchivoSql extends Model
{
    protected $primaryKey = "PK_id";
    protected $table = "TBL_ArchivoBd";
    protected $fillable = ['url','FK_ProyectoId','FK_TipoBdId'];
    protected $hidden = ['created_at', 'updated_at'];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class,'FK_ProyectoId','PK_id');
    }
    
    public function tipobd(){
        return $this->belongsTo(Tipobd::class,'FK_TipoBdId','PK_id');
    }

    public function componentes()
    {
        return $this->belongsToMany(NomenclaturaBd::class, 'TBL_CalificacionBd','FK_ArchivoBdId','FK_TipoNomenclaturaId')
        ->withTimestamps()
        ->withPivot('total','acertadas','calificacion');
    }
}

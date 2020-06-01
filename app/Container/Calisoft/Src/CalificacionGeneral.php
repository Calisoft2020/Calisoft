<?php

namespace App\Container\Calisoft\Src;
use Illuminate\Database\Eloquent\Model;

class CalificacionGeneral extends Model
{
    protected $primaryKey = "PK_Id";
    protected $table = "TBL_Calificacion_General";
    protected $fillable = ['nombreModulo','calificacion','FK_Id_Proyecto'];
    protected $hidden = ['created_at', 'updated_at'];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class,'FK_Id_Proyecto','PK_id');
    }
}
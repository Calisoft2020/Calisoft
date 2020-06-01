<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class calificacionBD extends Model
{
    protected $table = "TBL_calificacionbd";
    protected $fillable = ['total','acertadas','calificacion', 'FK_TipoNomenclaturaId', 'FK_ArchivoBdId'];
    protected $hidden = ['created_at', 'updated_at'];


}

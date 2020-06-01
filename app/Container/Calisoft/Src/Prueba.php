<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = 'TBL_Pruebas';
    protected $primaryKey = 'PK_id';
    protected $fillable = [
        'contexto', 'calificacion', 'FK_CasoPruebaId'
    ];
    protected $casts = [
        'contexto' => 'array'
    ];
}

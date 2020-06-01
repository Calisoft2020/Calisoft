<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class ItemsEvaluados extends Model
{
    protected $table = 'TBL_ItemsEvaluados';
    protected $primaryKey = 'PK_id';
    protected $fillable = ['atributo','fila','calificacion','FK_scriptId','FK_itemId'];

    public function script(){
        return $this->belongsTo(Script::class,'FK_scriptId','PK_id');
    }

    public function item(){
        return $this->belongsTo(ItemsCodificacion::class,'FK_itemId','PK_id');    
    } 
}

<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class TestValue extends Model
{   
    protected $table = "TBL_TestValues";
    protected $primaryKey = "PK_id";
    public $timestamps = false;
    protected $fillable = [
        'valor', 'tipo', 'FK_InputType','valido'
    ];

}

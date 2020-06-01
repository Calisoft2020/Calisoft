<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class InputTypes extends Model
{
    protected $primaryKey = "PK_id";
    protected $table="TBL_Inputs_Types";
    protected $fillable = ['nombre','reglas'];
}

<?php

namespace App\Container\Calisoft\Src;

use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    protected $table = "TBL_Semilleros";
    protected $primaryKey = "PK_id";

    protected $fillable = ["nombre"];
}

<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\Repositories\Calificaciones;

class NotaGlobalController extends Controller
{
    
    function __construct()
    {
        //$this->middleware('can:see_global_evaluation,proyecto');
    }

    public function total(Proyecto $proyecto) {
        $calificaciones = new Calificaciones($proyecto);
        return $calificaciones->global();
    }
}

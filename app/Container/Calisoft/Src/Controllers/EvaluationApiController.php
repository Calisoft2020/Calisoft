<?php
namespace App\Container\Calisoft\Src\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluationApiController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function modelado()
    {
        $proyecto = auth()->user()->proyectos()->first();
        return $proyecto->documentos()
            ->with('tipo', 'evaluaciones.componente', 'evaluaciones.evaluador')
            ->get();
    }
}

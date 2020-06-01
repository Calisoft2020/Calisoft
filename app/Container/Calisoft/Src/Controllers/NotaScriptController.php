<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\NotaCodificacion;
use App\Container\Calisoft\Src\Repositories\Evaluations;
use App\Container\Calisoft\Src\Script;
use App\Container\Calisoft\Src\Requests\NotaScriptUpdateRequest;


class NotaScriptController extends Controller
{
    public function __construct(Evaluations $evaluations)
    {
        $this->evaluations=$evaluations;
        $this->middleware('auth');
        $this->middleware('role:evaluator', [
            'except' => ['index']
        ]);
    }
    public function show(Script $script)
    {
        return $this->evaluations->forScript($script);
    }

    
    /**
     * Actualiza la nota del script
     */
    
    public function update(NotaScriptUpdateRequest $request, Script $script)
    {
        $script->items()->updateExistingPivot($request->PK_id,[
            'nota'=>$request->nota,
            'acertadas'=>$request->acertadas,
            'total'=>$request->total,
            
        ]);
    }
    /**
     * crea el comentario del script
     */
    public function comentario(Request $request,Script $script){
        $script->comentario=$request->comentario;
        $script->estado = 'calificado';
        $script->save();
        return redirect()->route('evaluator-codificacion', [
        'proyecto'=> $script->proyecto->PK_id
        ]);
    }

    
}

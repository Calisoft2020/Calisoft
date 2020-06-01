<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Repositories\Evaluations;
use App\Container\Calisoft\Src\ArchivoSql;
use App\Container\Calisoft\Src\Requests\NotaFileBdUpdateRequest;
use App\Container\Calisoft\Src\Proyecto;

class NotaFileBDController extends Controller
{
    public function __construct(Evaluations $evaluations)
    {
        $this->evaluations=$evaluations;
        $this->middleware('auth');
        $this->middleware('role:evaluator,student', [
            'except' => ['index']
        ]);
    }

    public function show(ArchivoSql $sql)
    {
       return $this->evaluations->forSql($sql);
    }
    
    /**
     * Actualiza la nota del sql
     */
    
    public function update(NotaFileBdUpdateRequest $request, ArchivoSql $sql)
    {
        $sql->componentes()->updateExistingPivot($request->PK_id,[            
            'acertadas'=>$request->acertadas,
            'total'=>$request->total,       
            'calificacion'=>$request->calificacion,     
        ]);
        
    }
    
    public function observacion(Request $request, ArchivoSql $sql){
        
        $sql->observacion=$request->observacion;
        $sql->save();
        return redirect()->route('home'); 
    }
}

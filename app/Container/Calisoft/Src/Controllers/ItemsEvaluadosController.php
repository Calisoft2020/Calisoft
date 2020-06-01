<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Container\Calisoft\Src\ItemsEvaluados;
use App\Container\Calisoft\Src\Script;
use App\Container\Calisoft\Src\ItemsCodificacion;
use App\Container\Calisoft\Src\Requests\ItemsEvaluadosStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ItemsEvaluadosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:evaluator,student', [
            'except' => ['index']
        ]);
       
       
    }

    public function show($id){
       $items = DB::table('TBL_Scripts')
                    ->join('TBL_ItemsEvaluados','TBL_Scripts.PK_id','=','TBL_ItemsEvaluados.FK_scriptId')
                    ->join('TBL_ItemsCodificacion','TBL_ItemsEvaluados.FK_itemId','=','TBL_ItemsCodificacion.PK_id')
                    ->select('*')
                    ->where('TBL_Scripts.PK_id','=',$id)
                    ->get();
        return $items;              
    }
    
    
 
    public function store(ItemsEvaluadosStoreRequest $request)
    {
        return ItemsEvaluados::create([
            'atributo' => $request->atributo,
            'fila'     => $request->fila,
            'calificacion' => $request->calificacion,
            'FK_scriptId'  => $request->FK_scriptId,
            'FK_itemId' => $request->FK_itemId,
        ]); 
    }
}

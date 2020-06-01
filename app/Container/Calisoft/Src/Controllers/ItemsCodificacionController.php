<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\ItemsCodificacion;
use App\Container\Calisoft\Src\Requests\ItemsCodificacionUpdateRequest;

class ItemsCodificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', [
            'except' => ['index']
        ]);
    }

    public function index()
    {
        return ItemsCodificacion::all();
    }


    public function update(ItemsCodificacionUpdateRequest $request, ItemsCodificacion $codificacion )
    {
        $codificacion->valor=$request->valor;
        $codificacion->save(); 
    }

}

<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\NomenclaturaBd;
use App\Container\Calisoft\Src\Requests\BaseDatosUpdateRequest;

class BaseDatosController extends Controller
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
        return NomenclaturaBd::all();
    }

    
    public function update(BaseDatosUpdateRequest $request, $id)
    {
        $basedato = NomenclaturaBd::find($id);
        $basedato->estandar = $request->estandar;
        $basedato->valor = $request->valor;
        $basedato->save();       
    }

}

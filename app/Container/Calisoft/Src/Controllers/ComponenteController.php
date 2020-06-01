<?php


namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\TiposDocumento;
use App\Container\Calisoft\Src\Componente;
use App\Container\Calisoft\Src\Requests\ComponenteStoreRequest;
use App\Container\Calisoft\Src\Requests\ComponenteUpdateRequest;

class ComponenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', [
            'except' => ['index']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComponenteStoreRequest $request)
    {
       
        return Componente::create([
            'nombre' => $request->nombre,
            'descripcion'=> $request->descripcion,
            'FK_TipoDocumentoId'=> $request->FK_TipoDocumentoId,
            'required'=> $request->required or false
        ]);
    }


    public function update(ComponenteUpdateRequest $request, Componente $componente)
    {
        
        $componente->update(
            $request->only('nombre', 'required', 'descripcion')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Componente $componente)
    {
        $componente->delete();
    }
}

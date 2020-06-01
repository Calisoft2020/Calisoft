<?php

namespace App\Container\Calisoft\Src\Controllers;

use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\TiposDocumento;
use Illuminate\Http\Request;
use App\Container\Calisoft\Src\Componente;
use App\Container\Calisoft\Src\Requests\TipoDocumentoStoreRequest;
use App\Container\Calisoft\Src\Requests\TipoDocumentoUpdateRequest;

class TiposDocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', [
            'except' => ['index']
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return TiposDocumento::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoDocumentoStoreRequest $request)
    {
       

        return TiposDocumento::create([
            'nombre' => $request->nombre,
            'required' => $request->required
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  TiposDocumento  $tdocumento
     * @return \Illuminate\Http\Response
     */
    public function update(TipoDocumentoUpdateRequest $request, TiposDocumento $tdocumento)
    {
        
        $tdocumento->update([
            'nombre' => $request->nombre,
            'required' => $request->required
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TiposDocumento  $tdocumento
     * @return \Illuminate\Http\Response
     */
     public function destroy(TiposDocumento $tdocumento)
     {
         $tdocumento->delete();
     }

    /**
    * Obtiene los componentes del documento
    * @param TiposDocumento $documento
    * @return \Illuminate\Http\Response  Arreglo con los componentes
    */
    public function getComponents(TiposDocumento $tdocumento)
    {
        return $tdocumento->componentes;
    }
}

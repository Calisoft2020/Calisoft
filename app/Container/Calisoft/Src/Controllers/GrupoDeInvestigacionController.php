<?php

namespace App\Container\Calisoft\Src\Controllers;

use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\GrupoDeInvestigacion;
use Illuminate\Http\Request;

use App\Container\Calisoft\Src\Requests\GrupoStoreRequest;
use App\Container\Calisoft\Src\Requests\GrupoUpdateRequest;

class GrupoDeInvestigacionController extends Controller
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
    public function index()
    {
        return GrupoDeInvestigacion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoStoreRequest $request)
    {
        return GrupoDeInvestigacion::create($request->only('nombre'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrupoDeInvestigacion  $grupoDeInvestigacion
     * @return \Illuminate\Http\Response
     */
    public function update(GrupoUpdateRequest $request, GrupoDeInvestigacion $grupos_de_investigacion)
    {
        $grupos_de_investigacion->update($request->only('nombre'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrupoDeInvestigacion  $grupoDeInvestigacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GrupoDeInvestigacion::destroy($id);
    }
}

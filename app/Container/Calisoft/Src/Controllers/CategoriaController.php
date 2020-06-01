<?php

namespace App\Container\Calisoft\Src\Controllers;

use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Categoria;
use Illuminate\Http\Request;
use App\Container\Calisoft\Src\Requests\CategoriaStoreRequest;
use App\Container\Calisoft\Src\Requests\CategoriaUpdateRequest;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', [
            'except' => ['index']
        ]);
    }


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Categoria::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaStoreRequest $request)
    {
        return Categoria::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaUpdateRequest $request, Categoria $categoria)
    {
        $categoria->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
    }
}

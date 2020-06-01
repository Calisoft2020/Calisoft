<?php

namespace App\Container\Calisoft\Src\Controllers;

use App\Container\Calisoft\Src\Semillero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Requests\SemilleroUpdateRequest;
use App\Container\Calisoft\Src\Requests\SemilleroStoreRequest;

class SemilleroController extends Controller
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
        return Semillero::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemilleroStoreRequest $request)
    {
        return Semillero::create($request->only('nombre'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function update(SemilleroUpdateRequest $request, Semillero $semillero)
    {
        $semillero->update($request->only('nombre'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semillero  $semillero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semillero $semillero)
    {
        $semillero->delete();
    }
}

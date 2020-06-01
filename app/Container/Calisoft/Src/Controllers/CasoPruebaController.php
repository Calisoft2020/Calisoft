<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Container\Calisoft\Src\Requests\CasoPruebaStoreRequest;
use App\Container\Calisoft\Src\Requests\CasoPruebaEnviarRequest;
use App\Container\Calisoft\Src\CasoPrueba;
use App\Container\Calisoft\Src\Prueba;
use App\Container\Calisoft\Src\InputTypes;
use App\Container\Calisoft\Src\Proyecto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Container\Calisoft\Src\Notifications\CasoPruebaCreado;
use App\Container\Calisoft\Src\Notifications\CasoPruebaEnviado;
use Illuminate\Support\Facades\Notification;


class CasoPruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CasoPruebaStoreRequest $request)
    {
        CasoPrueba::create([
            'nombre' => $request->nombre,
            'proposito'=> $request->proposito,
            'alcance'=> $request->alcance,
            'resultado_esperado'=> $request->resultado_esperado,
            'criterios' => $request->criterios,
            'prioridad'=> $request->prioridad,
            'limite' => $request->limite,
            'formulario' => '',
            'observacion' => '',
            'estado' => 'evaluar',
            'entrega' => 0,
            'FK_ProyectoId'=> $request->FK_ProyectoId

        ]);

        //Notificación a los integrantes del proyecto
        $proyecto = Proyecto::find($request->FK_ProyectoId);
        $usuarios = $proyecto->usuarios()->where('tipo','integrante')->get();
        return Notification::send($usuarios, new CasoPruebaCreado($proyecto->nombre,$request->nombre));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CasoPrueba $casoPrueba)
    {
        return $casoPrueba->formulario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CasoPrueba $casoPrueba)
    {
        return $casoPrueba;
    }

    public function enviarCasoPrueba(CasoPruebaEnviarRequest $request, CasoPrueba $casoPrueba)
    {
        
        $json = json_decode($request->formulario, true);
        
        //Ciclo for que identifica los tipos de inputs seleccionados por el usuario y concatena con el Json
        for ($i = 0; $i < sizeof($json) ; $i++) {
            $json[$i]['id'] = $test = InputTypes::find($request->testInput[$i])->PK_id;
        }
        
        $proyecto = $request->user()->proyectos()->first(); //obtiene el proyecto del usuario logeado
        $doc = new CasoPrueba(); //inicializa el caso prueba a guardar
        
        if($request->observacion == NULL){
            $doc->observacion = "No hay observaciones";
        }else{
            $doc->observacion = $request->observacion;
        }

        $doc->formulario = json_encode($json);
        //Actualiza el caso prueba 
        $proyecto->casoPruebas()->where('PK_id','=',$casoPrueba->PK_id)->update([
        'observacion' => $doc->observacion,
        'formulario' => $doc->formulario,
        ]);

        // Notificación a los evaluadores     
        $proyecto = Proyecto::find($casoPrueba->FK_ProyectoId);
        $usuarios = $proyecto->usuarios()->where('tipo','evaluador')->get();
        return Notification::send($usuarios, 
                new CasoPruebaEnviado($proyecto->nombre,$casoPrueba->nombre, 
                $estudiante = auth()->user()->first(),$proyecto->PK_id));
        //return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CasoPrueba $casoPrueba)
    {
        Storage::disk('casoPruebas')->delete($casoPrueba->getOriginal('formulario'));
        $casoPrueba->delete();
    }

    public function pruebas(CasoPrueba $casoPrueba)
    {
        $numero = Prueba::where('FK_CasoPruebaId',$casoPrueba->PK_id)->count();
        return $numero;
    }

    
}

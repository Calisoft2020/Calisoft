<?php
namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\User;
use App\Container\Calisoft\Src\Repositories\Calificaciones;
use App\Container\Calisoft\Src\CasoPrueba;
use App\Container\Calisoft\Src\ArchivoSql;
use App\Container\Calisoft\Src\calificacionBD;
use App\Container\Calisoft\Src\Documento;
use App\Container\Calisoft\Src\Componente;
use App\Container\Calisoft\Src\DocEvaluation;
use App\Container\Calisoft\Src\Script;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use PDF;


class PDFController extends Controller
{

    function __construct()
    {
        //$this->middleware('can:see_evaluations,App\Proyecto')->except('total', 'usuarios');
        //$this->middleware('can:see_global,proyecto')->only('total');
    }
    /**
     * Reporte de evluacion de diagramas
     *
     * @param Proyecto $proyecto
     * @return Illuminate\Http\Response
     */
    public function modelacion(Proyecto $proyecto)
    {
        $documentos = $proyecto->documentos()
            ->with('tipo', 'evaluaciones.componente', 'evaluaciones.evaluador')->get();
        $total = (new Calificaciones($proyecto))->modelacion();
        $pdf = PDF::loadView('pdf.modelacion', compact('proyecto', 'documentos', 'total'));
        return $pdf->stream('modelacion.pdf');
    }

    /**
     * Reporte de usuarios registrados en la plataforma
     *
     * @return Illuminate\Http\Response
     */
    public function usuarios()
    {
        $pdf = PDF::loadView('pdf.usuarios', ['usuarios' => User::limit(50)->get()]);
        return $pdf->stream('usuarios.pdf');
    }
    public function scripts(Proyecto $proyecto )
    {
        $scripts = $proyecto->scripts()->with('items')->get();
        $calificacion=new Calificaciones($proyecto);
        $nota=$calificacion->codificacion();
        $pdf = PDF::loadView('pdf.codificacion', compact('proyecto', 'scripts','nota'));
        return $pdf->stream('codificacion.pdf');
        
    }

    public function basedatos(Proyecto $proyecto)
    {
        $sql = $proyecto->sql->load('componentes');
        $promedio = $sql->componentes->filter(function($componente, $index){
            return $componente->pivot->total > 0;
        })->avg("pivot.calificacion");

        $promedio = round($promedio);
        $pdf = PDF::loadView('pdf.basedatos', compact('proyecto', 'sql','promedio'));
        return $pdf->stream('basedatos.pdf');
    }

    public function plataforma(Proyecto $proyecto) {
        $casos = $proyecto->casoPruebas()->with('pruebas')->get();
        $total = round($casos->avg('calificacion'));
        $pdf = PDF::loadView('pdf.plataforma', compact('casos', 'total', 'proyecto'));
        return $pdf->stream('plataforma.pdf');
    }

    public function total(Proyecto $proyecto) {
        $calificaciones = new Calificaciones($proyecto);
        $payload = $calificaciones->global();
        $payload['proyecto'] = $proyecto;
        $pdf = PDF::loadView('pdf.global', $payload);
        return $pdf->stream('resultados.pdf');
    }
    
    public function codificacionTotal(){
        $proyectos = Proyecto::all();
        $calificaciones = collect();
        foreach($proyectos as $proyecto){
             $calificacion = new Calificaciones($proyecto);
             $calificaciones->push([
                 'nombre' => $proyecto->nombre,
                 'nota'   => $calificacion->codificacion()
             ]);
        }
        $promedio = $calificaciones->avg('nota');    
        $pdf = PDF::loadview('pdf.codificacion-total',compact('calificaciones','promedio'));
        return $pdf->stream('total-codificacion.pdf');
    }
    public function studentResultadoGeneral()
    {
        $pj = auth()->user()->proyectos()->first();
        $proyecto=$pj->PK_id;
        $nombrePj=$pj->nombre;
        
        $clasificacion = $pj->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();
        
        $integranteId = array();
        $integranteId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','integrante')->pluck('FK_UsuarioId');
        foreach($integranteId as $medio){
            $integrante = User::where('PK_id','=',$medio)->pluck('name');
        }

        $modelado = $pj->documentos()
            ->with('tipo', 'evaluaciones.componente', 'evaluaciones.evaluador')->get();
        $modelado = (new Calificaciones($pj))->modelacion();
        
        $notaCodificacion[] = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $notaCodificacion = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }
        $codificacion = $notaCodificacion;

        $plataforma = CasoPrueba::where('FK_ProyectoId',$proyecto)->pluck('calificacion');
        $plataforma = round($plataforma[0]);
        
        $idCalificacionBD = ArchivoSql::where('FK_ProyectoId',$proyecto)->pluck('PK_id');
        $idCalificacionBD = $idCalificacionBD[0];
        $contadorBD = calificacionBD::where('calificacion','>',0)->where('FK_ArchivoBdId',$idCalificacionBD)->pluck('calificacion');
        $mediador = 0;
        $counter = 0;
        foreach($contadorBD as $num){
            $mediador += $num;
            $counter += 1;
        }
        if(($counter)== 0){
            $interventor = 0;
            $resultadoBD = round($interventor*20);
        }else{
            $interventor = $mediador/$counter;
            $resultadoBD = round($interventor*20);
        }
        
        $total = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);

        $pdf = PDF::loadView('pdf.resultado-general-student-home',compact('modelado','codificacion','plataforma','resultadoBD','total','nombrePj','integrante'));
        return $pdf->stream('resultados-generales.pdf');
    }
    public function studentPorcentajeGeneral(){
        $pj = auth()->user()->proyectos()->first();

        $proyecto=$pj->PK_id;
        $nombrePj=$pj->nombre;
        $fechaCreado = $pj->created_at;
        
        $clasificacion = $pj->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();
        
        $integranteId = array();
        $integranteId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','integrante')->pluck('FK_UsuarioId');
        foreach($integranteId as $medio){
            $integrante = User::where('PK_id','=',$medio)->get();
        }
        
        $evaluadorId = array();
        $evaluadorId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','evaluador')->pluck('FK_UsuarioId');
        foreach($evaluadorId as $medio){
            $evaluador = User::where('PK_id','=',$medio)->get();
        }

        $modeladoPorcentaje = (new Calificaciones($pj))->modelacion();
        if($modeladoPorcentaje == null){
            $modeladoPorcentaje = 0;
        }
        if($modeladoPorcentaje >= 100){
            $modeladoPorcentaje = 100;
        }
        
        $codificacionPorcentaje = array();
        $scriptIdPorcentaje = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptIdPorcentaje as $script) {
            $codificacionPorcentaje = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
            if($codificacionPorcentaje >= 100){
                $codificacionPorcentaje = 100;
            }
        }
        if($codificacionPorcentaje == null){
            $codificacionPorcentaje = 0;
        }

        try{
            $plataformaPorcentaje = CasoPrueba::where('FK_ProyectoId',$proyecto)->pluck('calificacion');
            $plataformaPorcentaje = round($plataformaPorcentaje[0]);
            if($plataformaPorcentaje >= 100){
                $plataformaPorcentaje = 100;
            }
        }catch(Exception $e){
            $plataformaPorcentaje = 0;
        }

        $idSql = ArchivoSql::where('FK_ProyectoId',$proyecto)->pluck('PK_id');
        if((count($idSql) >= 1)){
            $contadorBDPorcentaje = calificacionBD::where('calificacion','>',0)->where('FK_ArchivoBdId',$idSql)->pluck('calificacion');
            $mediador = 0;
            $counter = 0;
            foreach($contadorBDPorcentaje as $num){
                $mediador += $num;
                $counter += 1;
            }
            if(($counter)== 0){
                $interventor = 0;
                $resultadoBDPorcentaje = round($interventor*20);
            }else{
                $interventor = $mediador/$counter;
                $resultadoBDPorcentaje = round($interventor*20);
            }
            
        }else{
            $resultadoBDPorcentaje = 0;
        }

        $totalPorcentaje = round((
            $modeladoPorcentaje * $categoria->modelado +
            $plataformaPorcentaje * $categoria->plataforma +
            $codificacionPorcentaje * $categoria->codificacion +
            $resultadoBDPorcentaje * $categoria->base_datos
                ) / 100);
        if($totalPorcentaje >= 100){
            $totalPorcentaje = 100;
        }

        $sumatoriaPorcentaje =   $modeladoPorcentaje + $plataformaPorcentaje + $codificacionPorcentaje + $resultadoBDPorcentaje;
        
        $modeladoPorcentaje = round((100*$modeladoPorcentaje)/$sumatoriaPorcentaje);
        $plataformaPorcentaje = round((100*$plataformaPorcentaje)/$sumatoriaPorcentaje);
        $codificacionPorcentaje = round((100*$codificacionPorcentaje)/$sumatoriaPorcentaje);
        $resultadoBDPorcentaje = round((100*$resultadoBDPorcentaje)/$sumatoriaPorcentaje);

        $pdf = \PDF::loadView('pdf.porcentaje-general-student',compact('modeladoPorcentaje',
        'codificacionPorcentaje','plataformaPorcentaje','resultadoBDPorcentaje','totalPorcentaje',
        'nombrePj','integrante','evaluador','fechaCreado','categoria'));

        return $pdf->setPaper('a4', 'landscape')->stream('porcentaje-general.pdf');
    }
    public function studentTablaGeneral(){

        $pj = auth()->user()->proyectos()->first();
        $proyecto=$pj->PK_id;
        $nombrePj=$pj->nombre; 

        $clasificacion = $pj->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();
        
        $integranteId = array();
        $integranteId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','integrante')->pluck('FK_UsuarioId');
        foreach($integranteId as $medio){
            $integrante = User::where('PK_id','=',$medio)->get();
        }
        $evaluadorId = array();
        $evaluadorId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','evaluador')->pluck('FK_UsuarioId');
        foreach($evaluadorId as $medio){
            $evaluador = User::where('PK_id','=',$medio)->get();
        }

        $modeladoTabla = $pj->documentos()
            ->with('tipo', 'evaluaciones.componente', 'evaluaciones.evaluador')->get();
        $modeladoTabla = (new Calificaciones($pj))->modelacion();
        
        $notaCodificacionTabla[] = array();
        $scriptIdTabla = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptIdTabla as $scriptTabla) {
            $notaCodificacionTabla = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$scriptTabla)->sum('nota'))*15.3);
        }
        $codificacionTabla = $notaCodificacionTabla;

        $plataformaTabla = CasoPrueba::where('FK_ProyectoId',$proyecto)->pluck('calificacion');
        $plataformaTabla = round($plataformaTabla[0]);
        
        $idCalificacionBDTabla = ArchivoSql::where('FK_ProyectoId',$proyecto)->pluck('PK_id');
        $idCalificacionBDTabla = $idCalificacionBDTabla[0];
        $contadorBDTabla = calificacionBD::where('calificacion','>',0)->pluck('calificacion');
        $mediadorTabla = 0;
        $counterTabla = 0;
        foreach($contadorBDTabla as $num){
            $mediadorTabla += $num;
            $counterTabla += 1;
        }
        if(($counterTabla)== 0){
            $interventorTabla = 0;
            $resultadoBDTabla = round($interventorTabla*20);
        }else{
            $interventorTabla = $mediadorTabla/$counterTabla;
            $resultadoBDTabla = round($interventorTabla*20);
        }

        $totalTabla = round((
            $modeladoTabla * $categoria->modelado +
            $plataformaTabla * $categoria->plataforma +
            $codificacionTabla * $categoria->codificacion +
            $resultadoBDTabla * $categoria->base_datos
                ) / 100);
        
        $tamanoModeladoTabla = Documento::groupBy('FK_ProyectoId')->selectRaw('sum(nota) as suma')->get();
        $documentosTotalesTabla = DB::table('TBL_Documentos')->selectRaw('sum(nota) as suma')->get();
        $noteTabla=0;
        foreach($documentosTotalesTabla as $nota){
            $noteTabla += $nota->suma;
        }
        $promedioGeneralDocumentosTabla =round(($noteTabla*$categoria->modelado)/count($tamanoModeladoTabla));

        $tamanoPlataformaTabla = DB::table('TBL_CasoPrueba')->pluck('calificacion');
        $casosPruebaTotalesTabla = DB::table('TBL_CasoPrueba')->selectRaw('sum(calificacion) as nota')->get();
        $notaCasosTabla=0;
        foreach($casosPruebaTotalesTabla as $suma){
            $notaCasosTabla += $suma->nota;
        }
        $promedioGeneralCasosTabla = round(($notaCasosTabla)/count($tamanoPlataformaTabla));

        $scriptsTotalesTabla = DB::table('TBL_NotaCodificacion')->groupBy('FK_ScriptsId')->selectRaw('sum(nota) as suma')->get();;
        $notaCodificaTabla = 0;
        foreach($scriptsTotalesTabla as $nota){
            $notaCodificaTabla += $nota->suma;
        }
        $promedioGeneralCodificacionTabla = round(($notaCodificaTabla/count($scriptsTotalesTabla))*15.3);

        $archivosBdTotalesTabla = DB::table('TBL_CalificacionBd')->groupBy('FK_ArchivoBdId')->selectRaw('sum(calificacion) as suma')->get();
        $notaBDTabla = 0;
        foreach($archivosBdTotalesTabla as $nota){
            $notaBDTabla += $nota->suma;
        }
        $promedioGeneralBDTabla = round((($notaBDTabla/9)/count($archivosBdTotalesTabla))*$categoria->base_datos);

        $promedioGeneralTotalTabla = round((
            $promedioGeneralDocumentosTabla * $categoria->modelado +
            $promedioGeneralCasosTabla * $categoria->plataforma +
            $promedioGeneralCodificacionTabla * $categoria->codificacion+
            $promedioGeneralBDTabla * $categoria->base_datos
                ) / 100);

        $pdf = \PDF::loadView('pdf.tabla-general-student',compact('proyecto',
            'promedioGeneralDocumentosTabla','promedioGeneralCasosTabla',
            'promedioGeneralCodificacionTabla','promedioGeneralBDTabla',
            'promedioGeneralTotalTabla','modeladoTabla','codificacionTabla',
            'plataformaTabla','resultadoBDTabla','totalTabla','nombrePj'));
        
        return $pdf->stream('tabla-general-student.pdf');

                
    }
    public function resultadoEvaluado(){
        $idEvaluator = auth()->id();
        $idProyecto[] = array();
        $nombreProyecto[] = array();
        $idProyecto = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_UsuarioId',$idEvaluator)->pluck('FK_ProyectoId');

        $nombreProyecto = DB::table('TBL_Proyectos')
            ->join('TBL_ProyectosAsignados','TBL_Proyectos.PK_Id','=','TBL_ProyectosAsignados.FK_ProyectoId')
            ->where('TBL_ProyectosAsignados.FK_UsuarioId',$idEvaluator)
            ->where('TBL_Proyectos.state','completado')
            ->select('TBL_Proyectos.nombre')->get();
        
        $pdf = \PDF::loadView('pdf.resultado-evaluado',compact('idProyecto','nombreProyecto'));
        
        return $pdf->stream('resultado-evaluado.pdf');
    }

    public function listaProyectosAdmin (){

        $proyecto = Proyecto::where('state','completado')->get();
        $pdf = \PDF::loadView('pdf.lista-proyectos-evaluados-admin',compact('proyecto'));
        
        return $pdf->stream('lista-proyectos-evaluados.pdf');
    }
    
    public function porcentajeGeneralAdmin(Request $request){

        $proyecto = Crypt::decryptString($request->id);
        $pj = Proyecto::where('PK_id',$proyecto)->get();

        $proyecto=$pj[0]->PK_id;
        $nombrePj=$pj[0]->nombre;
        $fechaCreado = $pj[0]->created_at;
        $clasificacion = $pj[0]->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();
        
        $integranteId = array();
        $integranteId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','integrante')->pluck('FK_UsuarioId');
        foreach($integranteId as $medio){
            $integrante = User::where('PK_id','=',$medio)->get();
        }
        $evaluadorId = array();
        $evaluadorId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','evaluador')->pluck('FK_UsuarioId');
        foreach($evaluadorId as $medio){
            $evaluador = User::where('PK_id','=',$medio)->get();
        }
        
        $modeladoPorcentaje = (new Calificaciones($pj[0]))->modelacion();
        
        $codificacionPorcentaje = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $codificacionPorcentaje = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }
        if($codificacionPorcentaje == null){
            $codificacionPorcentaje = 0;
        }

        $plataformaPorcentaje = CasoPrueba::where('FK_ProyectoId',$proyecto)->pluck('calificacion');
        if($plataformaPorcentaje == null){
            $plataformaPorcentaje = 0;
        }
        
        try{
            $plataformaPorcentaje = (new Calificaciones($pj[0]))->plataforma(); 
        }catch(Exception $e){
            $plataformaPorcentaje = 0;
        }
        
        $idSql = ArchivoSql::where('FK_ProyectoId',$proyecto)->pluck('PK_id');
        if((count($idSql) >= 1)){
            $contadorBD = calificacionBD::where('calificacion','>',0)->where('FK_ArchivoBdId',$idSql)->pluck('calificacion');
            $mediador = 0;
            $counter = 0;
            foreach($contadorBD as $num){
                $mediador += $num;
                $counter += 1;
            }
            if(($counter)== 0){
                $interventor = 0;
                $resultadoBDPorcentaje = round($interventor*20);
            }else{
                $interventor = $mediador/$counter;
                $resultadoBDPorcentaje = round($interventor*20);
            }
            
        }else{
            $resultadoBDPorcentaje = 0;
        }

        $totalPorcentaje = round((
            $modeladoPorcentaje * $categoria->modelado +
            $plataformaPorcentaje * $categoria->plataforma +
            $codificacionPorcentaje * $categoria->codificacion +
            $resultadoBDPorcentaje * $categoria->base_datos
                ) / 100);

        $sumatoriaPorcentaje =   $modeladoPorcentaje + $plataformaPorcentaje + $codificacionPorcentaje + $resultadoBDPorcentaje;
        if(!$sumatoriaPorcentaje == 0){
            $modeladoPorcentaje = round((100*$modeladoPorcentaje)/$sumatoriaPorcentaje);
            $plataformaPorcentaje = round((100*$plataformaPorcentaje)/$sumatoriaPorcentaje);
            $codificacionPorcentaje = round((100*$codificacionPorcentaje)/$sumatoriaPorcentaje);
            $resultadoBDPorcentaje = round((100*$resultadoBDPorcentaje)/$sumatoriaPorcentaje);
        }else{
            $modeladoPorcentaje = 0;
            $plataformaPorcentaje = 0;
            $codificacionPorcentaje = 0;
            $resultadoBDPorcentaje = 0;
        }
        
        $pdf = \PDF::loadView('pdf.porcentaje-general-admin',
        compact('proyecto','modelado','plataforma','codificacion','resultadoBD','total',
        'modeladoPorcentaje', 'codificacionPorcentaje','plataformaPorcentaje',
        'resultadoBDPorcentaje','totalPorcentaje','nombrePj','integrante','evaluador',
        'fechaCreado','categoria'));
        
        return $pdf->setPaper('a4', 'landscape')->stream('porcentaje-proyecto-evaluado.pdf');
    }

    public function tablaGeneralAdmin(Request $request){

        $idProyecto = Crypt::decryptString($request->id);
        $proyecto = Proyecto::where('PK_id',$idProyecto)->get();

        $nombrePj = $proyecto[0]->nombre;
    
        $clasificacion = $proyecto[0]->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();

        $modelado = (new Calificaciones($proyecto[0]))->modelacion();
        if($modelado == null){
            $modelado = 0;
        }
        
        $codificacion = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$idProyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $codificacion = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }
        if($codificacion == null){
            $codificacion = 0;
        }
        
        try{
            $plataforma = (new Calificaciones($proyecto[0]))->plataforma(); 
        }catch(Exception $e){
            $plataforma = 0;
        }
        
        $idSql = ArchivoSql::where('FK_ProyectoId',$idProyecto)->pluck('PK_id');
        if((count($idSql) >= 1)){
            $contadorBD = calificacionBD::where('calificacion','>',0)->where('FK_ArchivoBdId',$idSql)->pluck('calificacion');
            $mediador = 0;
            $counter = 0;
            foreach($contadorBD as $num){
                $mediador += $num;
                $counter += 1;
            }
            if(($counter)== 0){
                $interventor = 0;
                $resultadoBD = round($interventor*20);
            }else{
                $interventor = $mediador/$counter;
                $resultadoBD = round($interventor*20);
            }                
        }else{
            $resultadoBD = 0;
        }

        $total = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
            ) / 100);

        $totalTabla = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
            ) / 100);

        $tamanoModeladoTabla = Documento::groupBy('FK_ProyectoId')->selectRaw('sum(nota) as suma')->get();
        $documentosTotalesTabla = DB::table('TBL_Documentos')->selectRaw('sum(nota) as suma')->get();
        $noteTabla=0;
        foreach($documentosTotalesTabla as $nota){
            $noteTabla += $nota->suma;
        }
        if($tamanoModeladoTabla != null){
            $promedioGeneralDocumentosTabla =round(($noteTabla*$categoria->modelado)/count($tamanoModeladoTabla));
        }else{
            $promedioGeneralDocumentosTabla = 0;
        }

        $tamanoPlataformaTabla = DB::table('TBL_CasoPrueba')->pluck('calificacion');
        $casosPruebaTotalesTabla = DB::table('TBL_CasoPrueba')->selectRaw('sum(calificacion) as nota')->get();
        $notaCasosTabla=0;
        foreach($casosPruebaTotalesTabla as $suma){
            $notaCasosTabla += $suma->nota;
        }
        if($tamanoPlataformaTabla != null){
            $promedioGeneralCasosTabla = round(($notaCasosTabla)/count($tamanoPlataformaTabla));
        }else{
            $promedioGeneralCasosTabla = 0;
        }

        $scriptsTotalesTabla = DB::table('TBL_NotaCodificacion')->groupBy('FK_ScriptsId')->selectRaw('sum(nota) as suma')->get();;
        $notaCodificaTabla = 0;
        foreach($scriptsTotalesTabla as $nota){
            $notaCodificaTabla += $nota->suma;
        }
        if($scriptsTotalesTabla != null){
            $promedioGeneralCodificacionTabla = round(($notaCodificaTabla/count($scriptsTotalesTabla))*15.3);
        }else{
            $promedioGeneralCodificacionTabla = 0;
        }

        $archivosBdTotalesTabla = DB::table('TBL_CalificacionBd')->groupBy('FK_ArchivoBdId')->selectRaw('sum(calificacion) as suma')->get();
        $notaBDTabla = 0;
        foreach($archivosBdTotalesTabla as $nota){
            $notaBDTabla += $nota->suma;
        }
        if($archivosBdTotalesTabla != null){
            $promedioGeneralBDTabla = round((($notaBDTabla/9)/count($archivosBdTotalesTabla))*$categoria->base_datos);
        }else{
            $promedioGeneralBDTabla = 0;
        }

        $promedioGeneralTotalTabla = round((
            $promedioGeneralDocumentosTabla * $categoria->modelado +
            $promedioGeneralCasosTabla * $categoria->plataforma +
            $promedioGeneralCodificacionTabla * $categoria->codificacion+
            $promedioGeneralBDTabla * $categoria->base_datos
            ) / 100);

            
        $pdf = \PDF::loadView('pdf.tabla-general-admin',
        compact('proyecto','modelado','plataforma','codificacion','resultadoBD','total',
        'nombrePj','integrante','evaluador','fechaCreado','categoria','promedioGeneralDocumentosTabla',
        'promedioGeneralCasosTabla','promedioGeneralCodificacionTabla', 'promedioGeneralBDTabla',
        'promedioGeneralTotalTabla','modeladoTabla','codificacionTabla', 'plataformaTabla',
        'resultadoBDTabla','totalTabla'));
                    
        return $pdf->stream('tabla-proyecto-evaluado.pdf');

    }

    public function porcentajeGeneralEvaluador(Request $request){

        $proyecto = Crypt::decryptString($request->id);
        $pj = Proyecto::where('PK_id',$proyecto)->get();

        $proyecto=$pj[0]->PK_id;
        $nombrePj=$pj[0]->nombre;
        $fechaCreado = $pj[0]->created_at;
        $clasificacion = $pj[0]->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();
        
        $integranteId = array();
        $integranteId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','integrante')->pluck('FK_UsuarioId');
        foreach($integranteId as $medio){
            $integrante = User::where('PK_id','=',$medio)->get();
        }
        $evaluadorId = array();
        $evaluadorId = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_ProyectoId','=',$proyecto)->where('TBL_ProyectosAsignados.tipo','=','evaluador')->pluck('FK_UsuarioId');
        foreach($evaluadorId as $medio){
            $evaluador = User::where('PK_id','=',$medio)->get();
        }
        
        $modeladoPorcentaje = (new Calificaciones($pj[0]))->modelacion();
        
        $codificacionPorcentaje = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $codificacionPorcentaje = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }
        if($codificacionPorcentaje == null){
            $codificacionPorcentaje = 0;
        }

        $plataformaPorcentaje = CasoPrueba::where('FK_ProyectoId',$proyecto)->pluck('calificacion');
        if($plataformaPorcentaje == null){
            $plataformaPorcentaje = 0;
        }
        
        try{
            $plataformaPorcentaje = (new Calificaciones($pj[0]))->plataforma(); 
        }catch(Exception $e){
            $plataformaPorcentaje = 0;
        }
        
        $idSql = ArchivoSql::where('FK_ProyectoId',$proyecto)->pluck('PK_id');
        if((count($idSql) >= 1)){
            $contadorBD = calificacionBD::where('calificacion','>',0)->where('FK_ArchivoBdId',$idSql)->pluck('calificacion');
            $mediador = 0;
            $counter = 0;
            foreach($contadorBD as $num){
                $mediador += $num;
                $counter += 1;
            }
            if(($counter)== 0){
                $interventor = 0;
                $resultadoBDPorcentaje = round($interventor*20);
            }else{
                $interventor = $mediador/$counter;
                $resultadoBDPorcentaje = round($interventor*20);
            }
            
        }else{
            $resultadoBDPorcentaje = 0;
        }

        $totalPorcentaje = round((
            $modeladoPorcentaje * $categoria->modelado +
            $plataformaPorcentaje * $categoria->plataforma +
            $codificacionPorcentaje * $categoria->codificacion +
            $resultadoBDPorcentaje * $categoria->base_datos
                ) / 100);

        $sumatoriaPorcentaje =   $modeladoPorcentaje + $plataformaPorcentaje + $codificacionPorcentaje + $resultadoBDPorcentaje;
        if(!$sumatoriaPorcentaje == 0){
            $modeladoPorcentaje = round((100*$modeladoPorcentaje)/$sumatoriaPorcentaje);
            $plataformaPorcentaje = round((100*$plataformaPorcentaje)/$sumatoriaPorcentaje);
            $codificacionPorcentaje = round((100*$codificacionPorcentaje)/$sumatoriaPorcentaje);
            $resultadoBDPorcentaje = round((100*$resultadoBDPorcentaje)/$sumatoriaPorcentaje);
        }else{
            $modeladoPorcentaje = 0;
            $plataformaPorcentaje = 0;
            $codificacionPorcentaje = 0;
            $resultadoBDPorcentaje = 0;
        }
        
        $pdf = \PDF::loadView('pdf.porcentaje-general-evaluator',
        compact('proyecto','modelado','plataforma','codificacion','resultadoBD','total',
        'modeladoPorcentaje', 'codificacionPorcentaje','plataformaPorcentaje',
        'resultadoBDPorcentaje','totalPorcentaje','nombrePj','integrante','evaluador',
        'fechaCreado','categoria'));
        
        return $pdf->setPaper('a4', 'landscape')->stream('porcentaje-proyecto-evaluado.pdf');
    }
    public function tablasEvaluador(Request $request){

        $proyecto = Crypt::decryptString($request->id);
        $pj = Proyecto::where('PK_id',$proyecto)->get();

        $nombrePj=$pj[0]->nombre;
        $fechaCreado = $pj[0]->created_at;
        $clasificacion = $pj[0]->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();
        
        try{
            $modelado = (new Calificaciones($pj[0]))->modelacion();
        if($modelado == null){
            $modelado = 0;
        }
        if($modelado >= 100){
            $modelado = 100;
        }
        }catch(Exception $e){
            $modelado = 0;
        }
        

        $codificacion = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $codificacion = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }
        if($codificacion == null){
            $codificacion = 0;
        }
        if($codificacion >= 100){
            $codificacion = 100;
        }

        try{
            $plataforma = (new Calificaciones($pj[0]))->plataforma(); 
            if($plataforma >= 100){
                $plataforma = 100;
            }
        }catch(Exception $e){
            $plataforma = 0;
            if($plataforma >= 100){
                $plataforma = 100;
            }
        }
        
        $idSql = ArchivoSql::where('FK_ProyectoId',$proyecto)->pluck('PK_id');
        if((count($idSql) >= 1)){
            $contadorBD = calificacionBD::where('calificacion','>',0)->where('FK_ArchivoBdId',$idSql)->pluck('calificacion');
            $mediador = 0;
            $counter = 0;
            foreach($contadorBD as $num){
                $mediador += $num;
                $counter += 1;
            }
            if(($counter)== 0){
                $interventor = 0;
                $resultadoBD = round($interventor*20);
            }else{
                $interventor = $mediador/$counter;
                $resultadoBD = round($interventor*20);
            }
            
        }else{
            $resultadoBD = 0;
        }
        if($resultadoBD >= 100){
            $resultadoBD = 100;
        }

        $total = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);
        if($total >= 100){
            $total = 100;
        }

        $totalTabla = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);
        if($totalTabla >= 100){
            $totalTabla = 100;
        }

        $tamanoModeladoTabla = Documento::groupBy('FK_ProyectoId')->selectRaw('sum(nota) as suma')->get();
        $documentosTotalesTabla = DB::table('TBL_Documentos')->selectRaw('sum(nota) as suma')->get();
        $noteTabla=0;
        foreach($documentosTotalesTabla as $nota){
            $noteTabla += $nota->suma;
        }
        if($tamanoModeladoTabla != null){
            $promedioGeneralDocumentosTabla =round(($noteTabla*$categoria->modelado)/count($tamanoModeladoTabla));
            if($promedioGeneralDocumentosTabla >= 100){
                $promedioGeneralDocumentosTabla = 100;
            }
        }else{
            $promedioGeneralDocumentosTabla = 0;
        }

        $tamanoPlataformaTabla = DB::table('TBL_CasoPrueba')->pluck('calificacion');
        $casosPruebaTotalesTabla = DB::table('TBL_CasoPrueba')->selectRaw('sum(calificacion) as nota')->get();
        $notaCasosTabla=0;
        foreach($casosPruebaTotalesTabla as $suma){
            $notaCasosTabla += $suma->nota;
        }
        if($tamanoPlataformaTabla != null){
            $promedioGeneralCasosTabla = round(($notaCasosTabla)/count($tamanoPlataformaTabla));
        }else{
            $promedioGeneralCasosTabla = 0;
        }
        
        $scriptsTotalesTabla = DB::table('TBL_NotaCodificacion')->groupBy('FK_ScriptsId')->selectRaw('sum(nota) as suma')->get();;
        $notaCodificaTabla = 0;
        foreach($scriptsTotalesTabla as $nota){
            $notaCodificaTabla += $nota->suma;
        }
        if($scriptsTotalesTabla != null){
            $promedioGeneralCodificacionTabla = round(($notaCodificaTabla/count($scriptsTotalesTabla))*15.3);
        }else{
            $promedioGeneralCodificacionTabla = 0;
        }
        
        $archivosBdTotalesTabla = DB::table('TBL_CalificacionBd')->groupBy('FK_ArchivoBdId')->selectRaw('sum(calificacion) as suma')->get();
        $notaBDTabla = 0;
        foreach($archivosBdTotalesTabla as $nota){
            $notaBDTabla += $nota->suma;
        }
        if($archivosBdTotalesTabla != null){
            $promedioGeneralBDTabla = round((($notaBDTabla/9)/count($archivosBdTotalesTabla))*$categoria->base_datos);
        }else{
            $promedioGeneralBDTabla = 0;
        }
        

        $promedioGeneralTotalTabla = round((
            $promedioGeneralDocumentosTabla * $categoria->modelado +
            $promedioGeneralCasosTabla * $categoria->plataforma +
            $promedioGeneralCodificacionTabla * $categoria->codificacion+
            $promedioGeneralBDTabla * $categoria->base_datos
                ) / 100);

        $pdf = \PDF::loadView('pdf.tabla-evaluator',
        compact('proyecto','modelado','plataforma','codificacion','resultadoBD','total',
        'promedioGeneralDocumentosTabla',
        'promedioGeneralCasosTabla','promedioGeneralCodificacionTabla', 'promedioGeneralBDTabla',
        'promedioGeneralTotalTabla','modeladoTabla','codificacionTabla', 'plataformaTabla',
        'resultadoBDTabla','totalTabla','nombrePj'));
        
        return $pdf->stream('tablas-proyecto-evaluado.pdf');
    }
    public function sugerencias(Request $request){

        $id = $request->proyecto;
        $proyecto = Proyecto::where('PK_id',$id)->get();

        $documento = Documento::where('FK_ProyectoId',$id)->get();
        $cumplidoModelado = 0; $requiredModelado = 0; $totalesModelado = Componente::all(); $componenteSugeridos = null;
        foreach($documento as $d){
            $cumplidoModelado = $cumplidoModelado + DocEvaluation::
            join('TBL_ComponentesDocumento','TBL_EvaluacionDocumento.FK_ComponenteId','=','TBL_ComponentesDocumento.PK_id')
            ->where('TBL_EvaluacionDocumento.FK_DocumentoId',$d->PK_id)
            ->where('TBL_EvaluacionDocumento.checked',1)
            ->where('TBL_ComponentesDocumento.required',1)
            ->count('TBL_EvaluacionDocumento.checked');
            $requiredModelado = Componente::where('required',1)->count('required');
        }
        $modeladoFaltante = Documento::
            join('TBL_TiposDocumento','TBL_Documentos.FK_TipoDocumentoId','=','TBL_TiposDocumento.PK_id')
            ->where('TBL_Documentos.nota',0.00)
            ->where('TBL_Documentos.FK_ProyectoId',$id)
            ->select('TBL_Documentos.nota','TBL_TiposDocumento.nombre')
            ->get();
        $modelado = $proyecto[0]->documentos()->with('tipo','evaluaciones')->get();
        $minimoModel=1; $maxModel=0; $noSubioModelado =0;
        foreach($modelado as $d)
        {
            if($d->nota <= $minimoModel){
                $minimoModel=$d->nota;
                $lessModelado = $d;
            }
            
        }   
        foreach($modelado as $d)
        {
            if($d->nota >= $maxModel){
                $maxModel=$d->nota;
                $maxModelado = $d;
            }
        }
        $scripts = $proyecto[0]->scripts()->get();
        $minScript = 1; $totalesCodificacion = 0; $cumplidoCodificacion=0;$maxScript = 0;
        foreach($scripts as $s){
            $codificacion = DB::table('TBL_NotaCodificacion')
            ->join('TBL_ItemsCodificacion','TBL_NotaCodificacion.FK_ItemsId','=','TBL_ItemsCodificacion.PK_id')
            ->where('TBL_NotaCodificacion.FK_ScriptsId',$s->PK_id)
            ->select('nota','item','total','acertadas')
            ->get();
        }
        foreach($codificacion as $scrip){
            if($scrip->nota <= $minScript){
                $minScript = $scrip->nota;
                $lessCodificacion = $scrip;
            }
            $totalesCodificacion = $totalesCodificacion + $scrip->total;
            $cumplidoCodificacion = $cumplidoCodificacion + $scrip->acertadas;
        }
        foreach($codificacion as $scrip){
            if($scrip->nota >= $maxScript){
                $maxScript = $scrip->nota;
                $maxCodificacion = $scrip;
            }
        }
        $componenteSugeridos = DocEvaluation::
        join('TBL_ComponentesDocumento','TBL_EvaluacionDocumento.FK_ComponenteId','=','TBL_ComponentesDocumento.PK_id')
        ->join('TBL_Documentos','TBL_EvaluacionDocumento.FK_DocumentoId','=','TBL_Documentos.PK_id')
        ->join('TBL_TiposDocumento','TBL_Documentos.FK_TipoDocumentoId','=','TBL_TiposDocumento.PK_id')
        ->where('TBL_Documentos.FK_ProyectoId',$id)
        ->where('TBL_EvaluacionDocumento.checked',0)
        ->where('TBL_ComponentesDocumento.required',1)
        ->select('TBL_EvaluacionDocumento.observacion','TBL_ComponentesDocumento.nombre','TBL_TiposDocumento.nombre AS nombreDiagrama')
        ->get();
        $requiredModelado = Componente::where('required',1)->count('required');
            
        $codificacionSugeridos = Script::
        join('TBL_NotaCodificacion','TBL_Scripts.PK_id','=','TBL_NotaCodificacion.FK_ScriptsId')
        ->join('TBL_ItemsCodificacion','TBL_NotaCodificacion.FK_ItemsId','=','TBL_ItemsCodificacion.PK_id')
        ->where('TBL_Scripts.FK_ProyectoId',$id)
        ->where('TBL_NotaCodificacion.nota','<',1)
        ->select('TBL_Scripts.comentario','TBL_NotaCodificacion.total',
        'TBL_NotaCodificacion.acertadas','TBL_NotaCodificacion.nota',
        'TBL_ItemsCodificacion.item')
        ->get();

        $bdSugeridos = ArchivoSql::
        join('TBL_CalificacionBd','TBL_ArchivoBd.PK_id','=','TBL_CalificacionBd.FK_ArchivoBdId')
        ->join('TBL_TipoNomenclatura','TBL_CalificacionBd.FK_TipoNomenclaturaId','=','TBL_TipoNomenclatura.PK_id')
        ->where('TBL_ArchivoBd.FK_ProyectoId',$id)
        ->where('TBL_CalificacionBd.calificacion','<',5)
        ->select('TBL_TipoNomenclatura.nombre','TBL_TipoNomenclatura.estandar',
        'TBL_CalificacionBd.total','TBL_CalificacionBd.acertadas',
        'TBL_CalificacionBd.calificacion','TBL_ArchivoBd.observacion')
        ->get();
        
        $minSql=1; $maxSql=0;
        $sqls = Proyecto::
        join('TBL_ArchivoBd','TBL_Proyectos.PK_id','=','TBL_ArchivoBd.FK_ProyectoId')
        ->join('TBL_CalificacionBd','TBL_ArchivoBd.PK_id','=','TBL_CalificacionBd.FK_ArchivoBdId')
        ->join('TBL_TipoNomenclatura','TBL_CalificacionBd.FK_TipoNomenclaturaId','=','TBL_TipoNomenclatura.PK_id')
        ->where('TBL_Proyectos.PK_id',$id)
        ->select('TBL_CalificacionBd.calificacion','TBL_TipoNomenclatura.nombre','TBL_TipoNomenclatura.estandar')
        ->get();
        foreach($sqls as $sql){
            if($sql->calificacion <= $minSql){
                $minSql = $sql->calificacion;
                $lessBD = $sql;
            }
            if($sql->calificacion >= $maxSql){
                $maxSql = $sql->calificacion;
                $maxBD = $sql;
            }
        }

        $pdf = \PDF::loadView('pdf.sugerencia',
        compact('proyecto','aciertos','cumplidoModelado','totalesModelado',
        'requiredModelado','lessModelado','maxModelado','scripts',
        'lessCodificacion','maxCodificacion','totalesCodificacion',
        'cumplidoCodificacion','minScript','maxScript','codificacion',
        'noSubioModelado','modeladoFaltante','componenteSugeridos',
        'codificacionSugeridos','bdSugeridos','lessBD','maxBD'));
        
        return $pdf->stream('sugerencia.pdf');  
    }
    public function especifico(Request $request){
        $proyecto = auth()->user()->proyectos()->first();
        $id = $proyecto->PK_id;

        $clasificacion = $proyecto->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();

        $documentos = $proyecto->documentos()->with('tipo', 'evaluaciones')->get();
        $modelado = (new Calificaciones($proyecto))->modelacion();
        if($modelado == null){
            $modelado = 0;
        }
        if($modelado >= 100){
            $modelado = 100;
        }

        $script = Script::where('FK_ProyectoId',$id)->pluck('PK_id');
        $codificacion = array();
        $notaCodificacion = 0;
        foreach($script as $c){
            $codificacion = DB::table('TBL_NotaCodificacion')->join('TBL_Scripts','TBL_NotaCodificacion.FK_ScriptsId','=','TBL_Scripts.PK_id')
            ->join('TBL_ItemsCodificacion','TBL_NotaCodificacion.FK_ItemsId','=','TBL_ItemsCodificacion.PK_id')
            ->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->select('TBL_NotaCodificacion.*','TBL_Scripts.url','TBL_ItemsCodificacion.item')->get();

            $notaCodificacion = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }

        $plataforma = CasoPrueba::where('FK_ProyectoId',$id)->select('nombre','prioridad','calificacion','observacion')->get();
        if($plataforma != null){
            $plataforma = $plataforma[0];
        }

        $archivoBd = ArchivoSql::where('FK_ProyectoId',$id)->pluck('PK_id');
        $resultadoBd = DB::table('TBL_TipoNomenclatura')
            ->join('TBL_CalificacionBd','TBL_TipoNomenclatura.PK_id','=','TBL_CalificacionBd.FK_TipoNomenclaturaId')
            ->where('TBL_CalificacionBd.FK_ArchivoBdId',$archivoBd)
            ->select('TBL_CalificacionBd.*','TBL_TipoNomenclatura.nombre')
            ->get();
        $notaBd = 0;
        try{
            $count = 0;
            foreach($resultadoBd as $r){
                $notaBd += $r->calificacion;
                if($r->calificacion > 0){
                    $count += 1;
                }
            }
            if($count == 0){
                $notaBd = 0;
            }else{
                $notaBd = round(($notaBd/$count)*20);
            }
        }catch(Excepton $e){
            $notaBd = 0;
        }

        $pdf = \PDF::loadView('pdf.especifico',
        compact('proyecto','documentos','categoria','modelado','codificacion','notaCodificacion',
        'plataforma','notaBd','resultadoBd'));
        
        return $pdf->stream('especifico.pdf');  
    }
    
}


<?php

namespace App\Container\Calisoft\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\TiposDocumento;
use App\Container\Calisoft\Src\Categoria;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\Documento;
use App\Container\Calisoft\Src\CasoPrueba;
use App\Container\Calisoft\Src\ArchivoSql;
use App\Container\Calisoft\Src\calificacionBD;
use App\Container\Calisoft\Src\Repositories\Calificaciones;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function semilleros()
    {
        return view('calisoft.admin.admin-semilleros');
    }

    public function categorias()
    {
        return view('calisoft.admin.admin-categorias');
    }

    public function usuarios()
    {
        return view('calisoft.admin.admin-usuarios');
    }

    public function tipoDocumento()
    {
        return view('calisoft.admin.admin-tipo-documento');
    }

    public function componentes(TiposDocumento $tdocumento)
    {
        return view('calisoft.admin.admin-componentes', compact('tdocumento'));
    }

    public function proyectos()
    {
        return view('calisoft.admin.admin-proyectos', ['categorias' => Categoria::all()]);
    }
    public function baseDatos()
    {
        return view('calisoft.admin.admin-base-datos');
    }
    public function  codificacion()
    {
        return view('calisoft.admin.admin-codificacion');
    }
    public function resultados()
    {
        $proyecto = Proyecto::where('state','completado')->paginate(4);
        $proyecto->withPath('resultadosAdmin');
        return view('calisoft.admin.admin-resultados',compact('proyecto'));
    }
    public function resultadoIndividual(Request $request){

        $idProyecto = Crypt::decryptString($request->id);
        $proyecto = Proyecto::where('PK_id',$idProyecto)->get();

        //Categoria del proyecto
        $clasificacion = $proyecto[0]->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();

        //Modelado
        $modelado = (new Calificaciones($proyecto[0]))->modelacion();
        if($modelado == null){
            $modelado = 0;
        }
        if($modelado >= 100){
            $modelado = 100;
        }

        //Nota de la codificacion
        $codificacion = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$idProyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $codificacion = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
        }
        if($codificacion == null){
            $codificacion = 0;
        }
        if($codificacion >= 100){
            $codificacion = 100;
        }

        //Plataforma
        try{
            $plataforma = (new Calificaciones($proyecto[0]))->plataforma(); 
            if($plataforma >= 100){
                $plataforma = 100;
            }
        }catch(Exception $e){
            $plataforma = 0;
            if($plataforma >= 100){
                $plataforma = 100;
            }
        }
        

        //Base de datos
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
        if($resultadoBD >= 100){
            $resultadoBD = 100;
        }

        //Nota final total
        $total = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);
        if($total >= 100){
            $total = 100;
        }

        /*------------------------------- PARA LOS PORCENTAJES--------------------------*/
        //Nota del modelado para los porcentajes

        $totalPorcentaje = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);
        if($totalPorcentaje >= 100){
            $totalPorcentaje = 100;
        }


        $sumatoriaPorcentaje =   $modelado + $plataforma + $codificacion + $resultadoBD;

        if($sumatoriaPorcentaje != 0){
            $modeladoPorcentaje = round((100*$modelado)/$sumatoriaPorcentaje);
            $plataformaPorcentaje = round((100*$plataforma)/$sumatoriaPorcentaje);
            $codificacionPorcentaje = round((100*$codificacion)/$sumatoriaPorcentaje);
            $resultadoBDPorcentaje = round((100*$resultadoBD)/$sumatoriaPorcentaje);
        }else{
            $modeladoPorcentaje = 0;
            $plataformaPorcentaje = 0;
            $codificacionPorcentaje = 0;
            $resultadoBDPorcentaje = 0;
        }
        
        
        /*-------------------------- RESULTADOS PARA TABLAS COMPARATIVAS -------------------------------*/
        $totalTabla = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);
        if($totalTabla >= 100){
            $totalTabla = 100;
        }

        //Promedio de modelado para tablas
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

        //Promedio plataforma para tablas
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
        

        //Promedio de codificacion para tablas
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
        

        //promedio base de datos para tablas
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
        
        return view('calisoft.admin.admin-resultado-individual',
        compact('proyecto','modelado','plataforma','codificacion','resultadoBD','total',
        'modeladoPorcentaje', 'codificacionPorcentaje','plataformaPorcentaje',
        'resultadoBDPorcentaje','totalPorcentaje','promedioGeneralDocumentosTabla',
        'promedioGeneralCasosTabla','promedioGeneralCodificacionTabla', 'promedioGeneralBDTabla',
        'promedioGeneralTotalTabla','modeladoTabla','codificacionTabla', 'plataformaTabla',
        'resultadoBDTabla','totalTabla'));
    }
    public function resultadoGraficoGeneral(Request $request){

        $proyecto= Crypt::decryptString($request->id);
        $pj = Proyecto::where('PK_id',$proyecto)->get();

        
        $nombrePj=$pj[0]->nombre;
        
        $clasificacion = $pj[0]->categoria->PK_id;
        $categoria = DB::table('TBL_Categorias')->where('PK_id', $clasificacion)->first();

        //Modelado
        $modelado = (new Calificaciones($pj[0]))->modelacion();
        if($modelado == null){
            $modelado = 0;
        }
        if($modelado >= 100){
            $modelado = 100;
        }

        //Nota de la codificacion
        $codificacion = array();
        $scriptId = DB::table('TBL_Scripts')->where('TBL_Scripts.FK_ProyectoId',$proyecto)->pluck('PK_id');
        foreach ($scriptId as $script) {
            $codificacion = round((DB::table('TBL_NotaCodificacion')->where('TBL_NotaCodificacion.FK_ScriptsId',$script)->sum('nota'))*15.3);
            if($codificacion >= 100){
                $codificacion = 100;
            }
        }
        if($codificacion == null){
            $codificacion = 0;
        }

        //Nota de la plataforma
        try{
            $plataforma = CasoPrueba::where('FK_ProyectoId',$proyecto)->pluck('calificacion');
            $plataforma = round($plataforma[0]);
            if($plataforma >= 100){
                $plataforma = 100;
            }
        }catch(Exception $e){
            $plataforma = 0;
        }

        //Base de datos
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

        $total = round((
            $modelado * $categoria->modelado +
            $plataforma * $categoria->plataforma +
            $codificacion * $categoria->codificacion +
            $resultadoBD * $categoria->base_datos
                ) / 100);

        //Promedio de modelado total
        $tamanoModelado = Documento::groupBy('FK_ProyectoId')->selectRaw('sum(nota) as suma')->get();
        $documentosTotales = DB::table('TBL_Documentos')->selectRaw('sum(nota) as suma')->get();
        $note=0;
        foreach($documentosTotales as $nota){
            $note += $nota->suma;
        }
        $promedioGeneralDocumentos =round(($note*$categoria->modelado)/count($tamanoModelado));

        //Promedio de los casos de prueba de proyectos
        $tamanoPlataforma = DB::table('TBL_CasoPrueba')->pluck('calificacion');
        $casosPruebaTotales = DB::table('TBL_CasoPrueba')->selectRaw('sum(calificacion) as nota')->get();
        $notaCasos=0;
        foreach($casosPruebaTotales as $suma){
            $notaCasos += $suma->nota;
        }
        $promedioGeneralCasos = round(($notaCasos)/count($tamanoPlataforma));

        //promedio de la codificacion de los proyectos
        $scriptsTotales = DB::table('TBL_NotaCodificacion')->groupBy('FK_ScriptsId')->selectRaw('sum(nota) as suma')->get();;
        $notaCodifica = 0;
        foreach($scriptsTotales as $nota){
            $notaCodifica += $nota->suma;
        }
        $promedioGeneralCodificacion = round(($notaCodifica/count($scriptsTotales))*15.3);

        //promedio base de datos total
        $archivosBdTotales = DB::table('TBL_CalificacionBd')->groupBy('FK_ArchivoBdId')->selectRaw('sum(calificacion) as suma')->get();
        $notaBD = 0;
        foreach($archivosBdTotales as $nota){
            $notaBD += $nota->suma;
        }
        $promedioGeneralBD = round((($notaBD/9)/count($archivosBdTotales))*$categoria->base_datos);

        $promedioGeneralTotal = round((
            $promedioGeneralDocumentos * $categoria->modelado +
            $promedioGeneralCasos * $categoria->plataforma +
            $promedioGeneralCodificacion * $categoria->codificacion+
            $promedioGeneralBD * $categoria->base_datos
                ) / 100);
        return view('calisoft.admin.admin-resultado-general-grafico',compact('proyecto','pj','modelado','codificacion','plataforma','resultadoBD','total','nombrePj','promedioGeneralDocumentos','promedioGeneralCasos','promedioGeneralCodificacion','promedioGeneralBD','promedioGeneralTotal'));
    }
}

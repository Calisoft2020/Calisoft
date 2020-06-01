<?php
namespace App\Container\Calisoft\Src\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\NomenclaturaBd;
use App\Container\Calisoft\Src\Script;
use App\Container\Calisoft\Src\Documento;
use App\Container\Calisoft\Src\CasoPrueba;
use App\Container\Calisoft\Src\CalificacionBD;
use App\Container\Calisoft\Src\Requests\CalificacionBDRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Container\Calisoft\Src\Repositories\Calificaciones;
use App\Container\Calisoft\Src\ArchivoSql;


class EvaluatorController extends Controller
{

    public function categorias()
    {
        return view('calisoft.evaluator.evaluator-categoria');
    }

    public function documentacion(Proyecto $proyecto)
    {
        return view('calisoft.evaluator.evaluator-modelacion', compact('proyecto'));
    }

    public function plataforma(Proyecto $proyecto)
    {
        return view('calisoft.evaluator.evaluator-plataforma', compact('proyecto'));
    }

    public function evaluar(Documento $documento)
    {
        return view('calisoft.evaluator.evaluator-docs', compact('documento'));
    }
    public function codificacion(Proyecto $proyecto)
    {
        return view('calisoft.evaluator.evaluator-codificacion', compact('proyecto'));
    }

    public function evaluarScripts(Script $script)
    {
        return view('calisoft.evaluator.evaluator-scripts',compact('script'));
    }
    public function basedatos(Proyecto $proyecto){

        return view('calisoft.evaluator.evaluator-basedatos',compact('proyecto'));
    }

    public function escenario(Proyecto $proyecto, CasoPrueba $casoPrueba)
    {
        $json = json_decode($casoPrueba->formulario);
        $save = json_decode($casoPrueba->formulario);
        $tot =0;
        $matriz[]="";
        $i=0;
        $j=0;
        foreach ($json as $regla){
            if(array_key_exists('pattern', $regla)){
                $matriz[$i]=$regla->pattern;
            }else{
                $matriz[$i]="1";
            }
            $i=$i+1;    
        }
        $matrix= json_encode($matriz);
        //Retorna el Json con la informaci¨®n del tipo de input seleccionado por el desarrollador
        return view('calisoft.evaluator.evaluator-escenario', compact('proyecto','casoPrueba','matrix'));
    }

    public function analizesql(Proyecto $proyecto)
    {
        $nomenclaturabd = NomenclaturaBd::
                    select('TBL_TipoNomenclatura.nomenclatura')
                          ->get();
        
        $valorItem = NomenclaturaBd::
                    select('TBL_TipoNomenclatura.valor')
                    ->get();

        $arrayItem = array();

        foreach($valorItem as $valorItems)
        {
            $arrayItem[] = $valorItems->valor;
        }

        $palabra_info = "";
        $palabra_infos = "";
        $palabra = "";
        $palabras = "";
        $totalImpostantesBD ="";
        $totalEstandarBD ="";
  
        $importantesBD = array('CREATE DATABASE','CREATE SCHEMA', 'CREATE TABLE', 'VIEWS', 'PRIMARY KEY', 'FOREIGN KEY', 'PGS_', 'CTB_', 'PSN_');
        $estandarBD = array();

        foreach($nomenclaturabd as $nomenbds)
        {
            $estandarBD[] = $nomenbds->nomenclatura;
        }

        $rutaArchivo = storage_path() . "/app/uploads/sql/".$proyecto->sql->url;
        $rutalecturaArchivo = file($rutaArchivo);
        $abrirArchivo=fopen($rutaArchivo, "r+");

        $obtenerArchivo = fgets($abrirArchivo);
        $leerArchivo = fread($abrirArchivo, 350000);

        foreach ($importantesBD as $i) 
        {

            $repeticion = substr_count($leerArchivo, $i); 
            $palabra_infos .= "$repeticion,";
            $array = explode(",", $palabra_infos);
            $palabras .= "$i ($repeticion)<br>";


        }

        foreach ($estandarBD as $k) 
        {
            $repeticiones = substr_count($leerArchivo, $k); 
            $palabra_info .= "$repeticiones,"; 
            $array1 = explode(",", $palabra_info);
            $palabra .= "$k ($repeticiones)<br>"; 
        }

        // array total en la calificacion
        $total = $array[0];
        $total1 = $array[1];
        $total2 = $array[2];
        $total3 = $array[3];
        $total4 = $array[4];
        $total5 = $array[5];
        $total6 = $array[6];
        $total7 = $array[7];
        $total8 = $array[8];

        // array acertadas en la calificacion
        $acertadas  = $array1[0];
        $acertadas1 = $array1[1];
        $acertadas2 = $array1[2];
        $acertadas3 = $array1[3];
        $acertadas4 = $array1[4];
        $acertadas5 = $array1[5];
        $acertadas6 = $array1[6];
        $acertadas7 = $array1[7];
        $acertadas8 = $array1[8];

        // array valor de cada item

        $valor  = $arrayItem[0];
        $valor2 = $arrayItem[1];
        $valor3 = $arrayItem[2];
        $valor4 = $arrayItem[3];
        $valor5 = $arrayItem[4];
        $valor6 = $arrayItem[5];
        $valor7 = $arrayItem[6];
        $valor8 = $arrayItem[7];
        $valor9 = $arrayItem[8];

        $CalificacionBDS = $total  == 0 ? 0 : ((($acertadas/$total)*$valor)*5)/$valor;
        $CalificacionSCH = $total1 == 0 ? 0 : ((($acertadas1/$total1)*$valor2)*5)/$valor2;
        $CalificacionTBL = $total2 == 0 ? 0 : ((($acertadas2/$total2)*$valor3)*5)/$valor3;
        $CalificacionVWS = $total3 == 0 ? 0 : ((($acertadas3/$total3)*$valor4)*5)/$valor4;
        $CalificacionPK  = $total4 == 0 ? 0 : ((($acertadas4/$total4)*$valor5)*5)/$valor5;
        $CalificacionFK  = $total5 == 0 ? 0 : ((($acertadas5/$total5)*$valor6)*5)/$valor6;
        $CalificacionPGS = $total6 == 0 ? 0 : ((($acertadas6/$total6)*$valor7)*5)/$valor7;
        $CalificacionCTB = $total7 == 0 ? 0 : ((($acertadas7/$total7)*$valor8)*5)/$valor8;
        $CalificacionPSN = $total8 == 0 ? 0 : ((($acertadas8/$total8)*$valor9)*5)/$valor9; 


        $DiCalificacionBDS = round($CalificacionBDS, 2);
        $DiCalificacionSCH = round($CalificacionSCH, 2);
        $DiCalificacionTBL = round($CalificacionTBL, 2);
        $DiCalificacionVWS = round($CalificacionVWS, 2);
        $DiCalificacionPK  = round($CalificacionPK,  2);
        $DiCalificacionFK  = round($CalificacionFK,  2);
        $DiCalificacionPGS = round($CalificacionPGS, 2);
        $DiCalificacionCTB = round($CalificacionCTB, 2);
        $DiCalificacionPSN = round($CalificacionPSN, 2);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 1)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total, 'acertadas' => $acertadas, 'calificacion' => $DiCalificacionBDS]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 2)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total1, 'acertadas' => $acertadas1, 'calificacion' => $DiCalificacionSCH]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 3)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total2, 'acertadas' => $acertadas2, 'calificacion' => $DiCalificacionTBL]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 4)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total3, 'acertadas' => $acertadas3, 'calificacion' => $DiCalificacionVWS]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 5)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total4, 'acertadas' => $acertadas4, 'calificacion' => $DiCalificacionPK]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 6)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total5, 'acertadas' => $acertadas5, 'calificacion' => $DiCalificacionFK]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 7)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total6, 'acertadas' => $acertadas6, 'calificacion' => $DiCalificacionPGS]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 8)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total7, 'acertadas' => $acertadas7, 'calificacion' => $DiCalificacionCTB]);

            $sql = DB::table('TBL_CalificacionBd')
            ->where('FK_TipoNomenclaturaId' , 9)
            ->where('FK_ArchivoBdId', $proyecto->sql->PK_id)
            ->update(['total' => $total8, 'acertadas' => $acertadas8, 'calificacion' => $DiCalificacionPSN]);


        return view('calisoft.evaluator.evaluator-sql',compact('proyecto'),[
            'nomenclaturabd' => $nomenclaturabd,
          ]);
    }

    public function evaluadorGeneral(){
        $idEvaluator = auth()->id();
        $idProyecto[] = array();
        $idProyecto = DB::table('TBL_ProyectosAsignados')->where('TBL_ProyectosAsignados.FK_UsuarioId',$idEvaluator)->pluck('FK_ProyectoId');
        
        $proyecto = DB::table('TBL_Proyectos')
        ->join('TBL_ProyectosAsignados','TBL_Proyectos.PK_Id','=','TBL_ProyectosAsignados.FK_ProyectoId')
        ->where('TBL_ProyectosAsignados.FK_UsuarioId',$idEvaluator)
        ->where('TBL_Proyectos.state','completado')
        ->select('*')
        ->get();    
        
        return view('calisoft.evaluator.evaluator-resultados-generales', compact('proyecto'));
    }
    public function resultadoGeneralProyecto(Request $request){
        $idProyecto = Crypt::decryptString($request->id);

        $proyecto = Proyecto::where('PK_id', $idProyecto)->get();
        
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

        //------------------------------- PARA LOS PORCENTAJES--------------------------/
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
        
        
        //-------------------------- RESULTADOS PARA TABLAS COMPARATIVAS -------------------------------/
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

        return view('calisoft.evaluator.evaluator-resultado-general-individual',
        compact('proyecto','modelado','plataforma','codificacion','resultadoBD','total',
        'modeladoPorcentaje', 'codificacionPorcentaje','plataformaPorcentaje',
        'resultadoBDPorcentaje','totalPorcentaje','promedioGeneralDocumentosTabla',
        'promedioGeneralCasosTabla','promedioGeneralCodificacionTabla', 'promedioGeneralBDTabla',
        'promedioGeneralTotalTabla','modeladoTabla','codificacionTabla', 'plataformaTabla',
        'resultadoBDTabla','totalTabla'));

    }

    public function resultadoGeneralGraficas(Request $request){

        $proyecto = Crypt::decryptString($request->id);

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
            $plataforma = round($plataforma->avg());
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

                return view('calisoft.evaluator.evaluator-graficas',compact('pj','modelado','codificacion','plataforma','resultadoBD','total','nombrePj','promedioGeneralDocumentos','promedioGeneralCasos','promedioGeneralCodificacion','promedioGeneralBD','promedioGeneralTotal'));        
    }
}


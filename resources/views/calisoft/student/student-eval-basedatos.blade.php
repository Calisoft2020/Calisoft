@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
                'icon' => 'fa fa-database', 
                'title' => 'Evaluacion de Base de Datos', 
                'pdf' => route('pdf.basedatos', compact('proyecto'))
        ])

        <div id="app" class="row">
        <button type="button"  class="btn green-jungle center-block" data-toggle="modal" data-target="#ModalAutomatica">
                                    <i class="fa fa-arrow-circle-right"></i>
                                    Ver Resultados Calificados
                                </button><br>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <tabla-componente :read="true"></tabla-componente>  
            </div>
            <div class="col-md-1"></div>                           
        </div>


                                    <!-- Modal -->
                                    <div id="ModalAutomatica" class="modal fade"  role="dialog">
                            <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" align="center"><b>Calificación Nomenclatura Base de datos - Proyecto: "{{$proyecto->nombre}}"</b> </h4>

                                </div>
                                <div class="modal-body" >
                                <?php
                                $palabra_info = "";
                                $palabra_infos = "";
                                $palabra = "";
                                $palabras = "";
                                $totalImpostantesBD ="";
                                $totalEstandarBD ="";
                                $palabrasAlone = "";
                                $palabrasRepeat = "";
                                $palabraAlone = "";
                                $palabraRepeat = "";
                                $mensajeEncontradas = "Palabras Encontradas: ";
                                $mensajePropias = "Palabras Encontradas Propias del SQL: ";
                                $mensajeLineas = "Las palabras estan en la linea: ";
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
                                    $totalImpostantesBD = array_sum($array);
                                    $palabras .= "$i ($repeticion)<br>";
                                    $palabrasAlone .= "<b>$i<br><br></b>";
                                    $palabrasRepeat .= "<b>$repeticion<br><br></b>";
                            
                                    if(strpos($leerArchivo, $i)> -1)
                                    {
                                    $mensajePropias .= $i . ', ';
                                    }

                                }

                                foreach ($estandarBD as $k) 
                                {

                                    $repeticiones = substr_count($leerArchivo, $k); 
                                    $palabra_info .= "$repeticiones,"; 
                                    $array1 = explode(",", $palabra_info);
                                    $totalEstandarBD = array_sum($array1);
                                    $palabra .= "$k ($repeticiones)<br>"; 
                                    $palabraAlone .= "<b>$k<br><br></b>"; 
                                    $palabraRepeat .= "<b>$repeticiones<br><br></b>"; 

                                    if(strpos($leerArchivo, $k)> -1)
                                    {
                                        $mensajeEncontradas .= $k . ', ';
                                    }
                                }

                                ?>

                                
                            
                                <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th width="10%"><b><center>Linea N°</center></b> </th>
                                        <th width="20%"><b><center>Componente</center></b> </th>
                                        <th width="60%"><b><center>Contenido Linea</center></b> </th>
                                        <th width="10%"><b><center>Calificación</center></b> </th>
                                        </tr>
                                    </thead>

                                <?php

                                    $baseDatos  = 'BDS_';
                                    $esquemas   = 'SCH_';
                                    $table      = 'CREATE TABLE `TBL_';
                                    $vistas     = 'VWS_';
                                    $primaryKey = 'PRIMARY KEY (`PK_';
                                    $foreignKey = 'FOREIGN KEY (`FK_';
                                    $cDescripcion = 'PGS_';
                                    $cValMoneda  = 'CTB_';
                                    $cObservaciones = 'PSN_';

                                    $pos = 1;

                                    foreach($rutalecturaArchivo as $linea)
                                    {
                                        for ( $x = 0; $x < count ( $importantesBD ); $x++ )
                                        {
                                            if (strstr($linea,$importantesBD[$x]))
                                            {    
                                                echo  "<table class='table table-bordered'>
                                                        <thead>
                                                            <tr>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>";

                                                            echo "<td width='10%'><b><center>$pos</center></b></td>";

                                                            if(strpos($linea, "BDS_") !== false){
                                                                echo "<td width='20%'><b><center>$pos</center>Base de Datos</b></td>";
                                                            }else if(strpos($linea, "SCH_") !== false){
                                                                echo "<td width='20%'><b><center>Esquema</center></b></td>";
                                                            }else if(strpos($linea, "CREATE TABLE") !== false){
                                                                echo "<td width='20%'><b><center>Tabla</center></b></td>";
                                                            }else if(strpos($linea, "VWS_") !== false){
                                                                echo "<td width='20%'><b><center>Vista</center></b></td>";
                                                            }else if(strpos($linea, "PRIMARY KEY") !== false){
                                                                echo "<td width='20%'><b><center>Llaves Primaria</center></b></td>";
                                                            }else if(strpos($linea, "FOREIGN KEY") !== false){
                                                                echo "<td width='20%'><b><center>Llaves Foranea</center></b></td>";
                                                            }else if(strpos($linea, "PGS_") !== false){
                                                                echo "<td width='20%'><b><center>Campo Descripcion</center></b></td>";
                                                            }else if(strpos($linea, "CTB_") !== false){
                                                                echo "<td width='20%'><b><center>Campo ValorMoneda</center></b></td>";
                                                            }else if(strpos($linea, "PSN_") !== false){
                                                                echo "<td width='20%'><b><center>Campo Observacion</center></b></td>";
                                                            }else{
                                                                echo "<td width='20%'><b><center>Componente</center></b></td>";
                                                            }
                                                            echo "<td width='60%'><b><center>$linea</center></b></td>";
                                                            if(strpos($linea, $baseDatos) !== false || strpos($linea, $esquemas) !== false
                                                             || strpos($linea, $table) !== false || strpos($linea, $vistas) !== false
                                                             || strpos($linea, $primaryKey) !== false || strpos($linea, $foreignKey) !== false 
                                                             || strpos($linea, $cDescripcion) !== false ||  strpos($linea, $cValMoneda) !== false 
                                                             ||  strpos($linea, $cObservaciones) !== false){
                                                                echo "<td width='10%' align='center'><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
                                                            }else{
                                                                echo "<td width='10%' align='center'><span class='glyphicon glyphicon-remove' style='color:red'></span></td>";
                                                            }

                                                            echo "</tr>
                                            
                                                        </tbody>
                                                        </table>";
                                            }
                                                
                                        }
                                        $pos++;
                                    }

                                ?>
                                </div>
                                </div>
                                </div>

                            </div>
                            </div>

        @endcomponent
    </div>
@endsection
@push('functions')
    <script>window.archivoId = "{{ $proyecto->sql->PK_id }}"</script>
    <script src="/assets/global/plugins/jquery.media.js"></script>
    <script src="/js/base-datos.js"></script>
@endpush
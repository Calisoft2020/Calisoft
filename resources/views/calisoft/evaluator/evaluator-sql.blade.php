@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-files-o', 
            'title' => 'Nomenclatura: ' . $proyecto->nombre
            ])
            <div id="app">
                <div class="row">
                    <div class="col-md-6">
                        <h5><center><strong>Codigo SQL</strong></center></h5>
                        <code-preview url="{{$proyecto->sql->url}}" prefix="/api/sql/preview/" mode="text/x-sql"></code-preview>                  
                    </div>
                    <div class="col-md-6">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn green-jungle center-block" data-toggle="modal" data-target="#ModalAutomatica">Calificación Automática <i class="fa fa-arrow-circle-right"></i></button>

                            <!-- Modal -->
                            <div id="ModalAutomatica" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
                            <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title" align="center"><b>Calificación Nomenclatura Base de datos - Proyecto: "{{$proyecto->nombre}}"</b> </h4>
                                    
                                </div>
                                <div class="modal-body" >
                                <button type="button" class="btn green-jungle center-block" data-toggle="modal" data-target="#ModalSeguro" data-dismiss="modal">Calificación Automática <i class="fa fa-arrow-circle-right"></i></button>
                                <br>
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

                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th class="text-center"><b>Palabras Reservadas SQL</b></th>
                                    <th class="text-center"><b>Total</b> </th>
                                    <th class="text-center"><b>Palabras Encontradas</b></th>
                                    <th class="text-center"><b>Total</b> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td align="center"><?php echo $palabrasAlone; 
                                    echo "<br><b>Total Palabras Reservadas del SQL: </b><br>";?></td>
                                    <td align="center"><?php echo $palabrasRepeat; 
                                    echo "<br>"."<b>".$totalImpostantesBD."</b>";?></td>
                                    <td align="center"><?php echo $palabraAlone; 
                                    echo "<br><b>Total Palabras Encontradas del SQL: </b><br>";?></td>
                                    <td align="center"><?php echo $palabraRepeat; 
                                    echo "<br>"."<b>".$totalEstandarBD."</b>";?></td>
                                    </tr>
                    
                                </tbody>
                                </table>

                                <legend></legend>
                            
                                <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th><b>Contenido Linea</b> </th>
                                        <th class="text-right"><b>Linea N°</b> </th>
                                        </tr>
                                    </thead>

                                <?php

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
                                                            <tr>
                                                            <td><b>$linea</b></td>
                                                            <td align='right'><b>$pos</b></td>
                                                            </tr>
                                            
                                                        </tbody>
                                                        </table>";
                                            }
                                                
                                        }
                                        
                                        $pos++;
                                    }

                                ?>
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn green-jungle center-block" data-toggle="modal" data-target="#ModalSeguro" data-dismiss="modal">Calificación Automática <i class="fa fa-arrow-circle-right"></i></button> 
                                </div>
                                </div>

                            </div>
                            </div>
                        <h5><center><strong>Información</strong></center></h5>
                        <tabla-componente :read="false"></tabla-componente>  
                        <form method="POST" action="{{route('observacion-bd',['sql'=>$proyecto->sql->PK_id])}}">
                            {{csrf_field()}}               
                                    @component('components.textarea',[
                                        'name'=>'observacion',
                                        'attributes'=>'required',
                                        'label'=>'Comentario',
                                        'value'=>$proyecto->sql->observacion,
                                    ])
                                    @endcomponent
                            <button type="submit"  class="btn green-jungle center-block">
                            <i class="fa fa-edit"></i> Aceptar Calificación</button>
                        </form>   

                            
                        
                                             
                    </div>

                    <!-- Modal -->
                    <div id="ModalSeguro" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
                            <div class="modal-dialog modal-lg" >

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title" align="center"><b>¡Advertencia!</b> </h4>
                                    
                                </div>
                                <div class="modal-body" >
                                <h4 class="modal-title" align="center"> <b>El proyecto: "{{$proyecto->nombre}}", Fue calificado correctamente.</b></h4>
                                </div>
                                
                                <div class="modal-footer">
                                    <a href="/proyectos/{{$proyecto->PK_id}}/basedatos"><button type="button"  class="btn green-jungle center-block">
                                        <i class="fa fa-arrow-circle-right"></i>
                                        ¡Aceptar!
                                    </button></a> 
                                </div>
                            </div>

                    </div>
                    </div>

                </div>
                @include('partials.modal-help-calificar-bd')
            </div>                
        @endcomponent  
    </div>
@endsection
@push('functions')
    <script>window.archivoId = "{{ $proyecto->sql->PK_id }}"</script>
    <script src="/assets/global/plugins/jquery.media.js"></script>
    <script src="/js/base-datos.js"></script>
    <script src="/assets/apps/scripts/modal.js"></script>
@endpush
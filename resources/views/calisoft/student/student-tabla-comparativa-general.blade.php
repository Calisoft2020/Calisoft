<!--<style type="text/css">
    tr:hover { background-color: #2C3A47; color: #218c74}
    </style>-->
@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-bar-chart', 
            'title' => 'Proyecto: ' .$nombrePj
            ])
            <div id="app">
                <div class="row">
                    <div class="col-md-6">
                        <!-- BARRA DE NAVEGACION -->
                        <nav class="navbar navbar-default" style="width: 200%;">
                            <div class="container-fluid">
                              <div class="navbar-header">
                                <h4 class="navbar-brand">{{link_to_route('resultados', 'Resultados')}}</h4>
                              </div>
                                <ul class="nav nav-pills">
                                    <li><a>{{link_to_route('porcentaje-general', 'Porcentajes')}}</a></li>
                                    <li class="active"><a>{{link_to_route('tabla-general', 'Tablas')}}</a></li>
                                    <li><a>{{link_to_route('grafica-general', 'Gráficas')}}</a></li>
                                    <li><a>{{link_to_route('grafica-general', 'Sugerencias')}}</a></li>
                                  <li><a></a></li>
                                </ul>
                            </div>
                        </nav>                        
                    </div>
                        <!-- RESULTADOS -->
                    <br/>
                    <br/>
                    <div align="center">
                        <br/>
                        <br/>
                        <br/>
                        <table class="table table-borderless">
                            <thead>
                                    <td style="width:50%">
                                        <h2 align="center">Proyecto: <b>{{$nombrePj}}</b></h2>
                                    </td>
                                    <td style="width: 50%">
                                        <h2 align="center">Promedio General</h2>
                                    </td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <!--TABLA QUE CONTIENE EL PROYECTO DEL ESTUDIANTE-->
                                        <table class="table table-hover" 
                                        style=" ;width: 100%;
                                        <?php if( $promedioGeneralTotal > $total){
                                            ?>background-color: #fab1a0 <?php
                                            } else{
                                                ?> background-color: #7bed9f<?php 
                                            } ?>">
                                            <tbody>
                                                <!--MODELACION-->
                                                <tr>
                                                    <td align="center">
                                                        <h5>Modelacion</h5>
                                                    </td>
                                                    <td align="left">
                                                        {{$modelado}}
                                                    </td>
                                                </tr>
                                                <!--PLATAFORMA-->
                                                <tr>
                                                    <td align="center">
                                                        <h5>Plataforma</h5>
                                                    </td>
                                                    <td align="left">
                                                        {{$plataforma}}
                                                    </td>
                                                </tr>
                                                <!--CODIFICACION-->
                                                <tr>
                                                    <td align="center">
                                                        <h5>Codificacion</h5>
                                                    </td>
                                                    <td align="left">
                                                        {{$codificacion}}
                                                    </td>
                                                </tr>
                                                <!--BASEDATOS-->
                                                <tr>
                                                    <td align="center">
                                                        <h5>Base de Datos</h5>
                                                    </td>
                                                    <td align="left">
                                                        {{$resultadoBD}}
                                                    </td>
                                                </tr>
                                                <!--TOTAL-->
                                                <tr>
                                                    <td align="center" style="<?php if( $promedioGeneralTotal > $total){
                                                        ?>background-color: #f06f51 <?php
                                                        } else{
                                                            ?> background-color: #58e886<?php 
                                                        } ?>">
                                                        <h4><b>Total</b></h4>
                                                    </td>
                                                    <td align="left" style="<?php if( $promedioGeneralTotal > $total){
                                                        ?>background-color: #f06f51 <?php
                                                        } else{
                                                            ?> background-color: #58e886<?php 
                                                        } ?>">
                                                        <h4><b>{{$total}}</b></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <!--TABLA QUE CONTIENE EL PROMEDIO DE LOS PROYECTOS-->
                                    <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <h5>Modelacion</h5>
                                                    </td>
                                                    <td align="left">
                                                        <h5>{{$promedioGeneralDocumentos}}</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <h5>Plataforma</h5>
                                                    </td>
                                                    <td align="left">
                                                        <h5>{{$promedioGeneralCasos}}</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <h5>Codificacion</h5>
                                                    </td>
                                                    <td align="left">
                                                        <h5>{{$promedioGeneralCodificacion}}</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <h5>Base de Datos</h5>
                                                    </td>
                                                    <td align="left">
                                                        <h5>{{$promedioGeneralBD}}</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <h4><b>Total</b></h4>
                                                    </td>
                                                    <td align="left">
                                                        <h4><b>{{$promedioGeneralTotal}}</b></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcomponent  
    </div>
@endsection
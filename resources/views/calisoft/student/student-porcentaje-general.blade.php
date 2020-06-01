<!--Estilos para la tabview-->
<style>
    body {font-family: Arial;}
    .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    }
    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
    }
    .tab button:hover {
    background-color: #ddd;
    }
    .tab button.active {
    background-color: #ccc;
    }
    .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
    }
    </style>
    <!--Fin de estilos para la tabview-->

    <!--Evento que muestra el tabOption de la visualizacion escogida-->
    <script>
        function Modulo(evt, visual) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(visual).style.display = "block";
          evt.currentTarget.className += " active";
        }
    </script>
    <!--Fin del evento tabOption--> 
@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-calculator', 
            'title' => 'Proyecto: '.$nombrePj
            ])
            <div id="app">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                </div>
            </div>

            <div class="tab">
                <button style="color: #2980b9;" class="tablinks"><b>{{link_to_route('resultados', 'Resultados')}}</b></button>
                <button style="color: #2980b9;" class="tablinks" onclick="Modulo(event, 'Porcentajes')">Porcentajes</button>
                <button style="color: #2980b9;" class="tablinks" onclick="Modulo(event, 'Tablas')">Tablas Comparativas</button>
                <button style="color: #2980b9;" class="tablinks">{{link_to_route('grafica-general', 'Graficas')}}</button>
                <button style="color: #2980b9;" class="tablinks">{{link_to_route('resultados-especificos-sugerencias', 'Sugerencias')}}</button>
            </div>
            <!--Porcentajes Generales-->
            <div id="Porcentajes" class="tabcontent">
                @component('components.porlet-post-action', [ 
                    'title' => 'Generar reporte de porcentajes',
                    'icon' => 'fa fa-file-pdf-o',
                    'id' => 'pdf-form',
                    'color' => '#e74c3c',
                    'colorIcon' => '#e74c3c',
                    'url' => route('pdf.resultado-general-porcentaje')
                ])
                @endcomponent
                <br/>
                <br/>
                <ul class="list-group" style="width: 100%;">
                    <li class="list-group-item">Modelado: 
                        
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{$modeladoPorcentaje.'%'}}">
                            </div>
                        </div>

                        &nbsp;&nbsp;<span class="badge"> {{$modeladoPorcentaje}}%</span>
                    </li>
                    <li class="list-group-item">Plataforma: 
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{$plataformaPorcentaje.'%'}}">
                            </div>
                        </div>
                        &nbsp;&nbsp;<span class="badge">{{$plataformaPorcentaje}}%</span>
                    </li>
                    <li class="list-group-item">Codificacion: 
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{$codificacionPorcentaje.'%'}}">
                            </div>
                        </div>
                        &nbsp;&nbsp;<span class="badge">{{$codificacionPorcentaje}}%</span>
                    </li>
                    <li class="list-group-item">Base de datos: 
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                               aria-valuemin="0" aria-valuemax="100" style="width:{{$resultadoBDPorcentaje.'%'}}">
                            </div>
                        </div>
                        &nbsp;&nbsp;<span class="badge">{{$resultadoBDPorcentaje}}%</span>
                    </li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item" style="width: 100%; background-color: #82ccdd"><h4><strong>Total: </strong></h4> 
                        <div class="progress">
                            <div class="progress-bar @if ($totalPorcentaje >= 50)
                                
                                @else
                                    progress-bar-danger
                                @endif" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{$totalPorcentaje.'%'}}">
                            </div>
                        </div>
                    &nbsp;&nbsp;<p class="badge" style="tex">{{$totalPorcentaje}}%</p>
                    </li>
                </ul>
            </div>
            <!--Fin Porcentajes Generales-->

            <!--Tablas comparativas Generales-->
            <div id="Tablas" class="tabcontent">
                @component('components.porlet-post-action', [ 
                    'title' => 'Generar reporte de tablas comparativas',
                    'icon' => 'fa fa-file-pdf-o',
                    'id' => 'pdf-form1',
                    'color' => '#e74c3c',
                    'colorIcon' => '#e74c3c',
                    'url' => route('pdf.tabla-resultado-general')
                    ])
                @endcomponent
                <div align="center">
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
                                    @if ($promedioGeneralTotalTabla > $totalTabla)
                                        background-color: #fab1a0
                                    @else
                                        background-color: #7bed9f
                                    @endif">
                                        <tbody>
                                            <!--MODELACION-->
                                            <tr>
                                                <td align="center">
                                                    <h5>Modelacion</h5>
                                                </td>
                                                <td align="left">
                                                    {{$modeladoTabla}}
                                                </td>
                                            </tr>
                                            <!--PLATAFORMA-->
                                            <tr>
                                                <td align="center">
                                                    <h5>Plataforma</h5>
                                                </td>
                                                <td align="left">
                                                    {{$plataformaTabla}}
                                                </td>
                                            </tr>
                                            <!--CODIFICACION-->
                                            <tr>
                                                <td align="center">
                                                    <h5>Codificacion</h5>
                                                </td>
                                                <td align="left">
                                                    {{$codificacionTabla}}
                                                </td>
                                            </tr>
                                            <!--BASEDATOS-->
                                            <tr>
                                                <td align="center">
                                                    <h5>Base de Datos</h5>
                                                </td>
                                                <td align="left">
                                                    {{$resultadoBDTabla}}
                                                </td>
                                            </tr>
                                            <!--TOTAL-->
                                            <tr>
                                                <td align="center" style="
                                                    @if ($promedioGeneralTotalTabla > $totalTabla)
                                                        background-color: #f06f51
                                                    @else
                                                        background-color: #58e886
                                                    @endif">
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <td align="left" style="
                                                    @if ($promedioGeneralTotalTabla > $totalTabla)
                                                        background-color: #f06f51
                                                    @else
                                                        background-color: #58e886
                                                    @endif">
                                                    <h4><b>{{$totalTabla}}</b></h4>
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
                                                    <h5>{{$promedioGeneralDocumentosTabla}}</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <h5>Plataforma</h5>
                                                </td>
                                                <td align="left">
                                                    <h5>{{$promedioGeneralCasosTabla}}</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <h5>Codificacion</h5>
                                                </td>
                                                <td align="left">
                                                    <h5>{{$promedioGeneralCodificacionTabla}}</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <h5>Base de Datos</h5>
                                                </td>
                                                <td align="left">
                                                    <h5>{{$promedioGeneralBDTabla}}</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <td align="left">
                                                    <h4><b>{{$promedioGeneralTotalTabla}}</b></h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <!--Fin Tablas comparativas Generales-->
            <!--Graficas Generales-->
            <div id="Graficas" class="tabcontent">
                
            </div>
            <!--Fin de las Graficas Generales-->
            <!--Sugerencias-->
            <div id="Sugerencias" class="tabcontent">
                <button>{{$nombrePj}}</button>
            </div>
            <!--Fin de las Sugerencias-->
        
        @endcomponent
        @include('partials.modal-help-student-resultado-general')
    </div>
@endsection
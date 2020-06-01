<style>
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
<script>
    function openCity(evt, cityName) {
  
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-list', 
            'title' => 'Proyectos evaluados'
        ])
        <div id="app">           
        
        <div align="center">
            <table class="table table-bordered" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 20%;">
                            @foreach ($proyecto as $p)
                            <h4><b>{{$p->nombre}}</b></h4>
                            @endforeach
                        </td>

                        <td style="width: 20%;">
                            <h4> Modelado</h4>
                        </td>

                        <td style="width: 20%;">
                            <h4> Plataforma</h4>
                        </td>

                        <td style="width: 20%;">
                            <h4> Codificacion</h4>
                        </td>

                        <td style="width: 20%;">
                            <h4> Base de datos</h4>
                        </td>
                            
                    </tr>
                    <tr>
                        
                        <td>
                        <h4> Total: <b> {{$total}}</b></h4>
                        </td>
                        <td>
                            <h4> {{$modelado}}</h4>
                        </td>
                        <td>
                            <h4> {{$plataforma}}</h4>
                        </td>
                        <td>
                            <h4> {{$codificacion}}</h4>
                        </td>
                        <td>
                            <h4> {{$resultadoBD}}</h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
              
    </div>
    <!-- Tab links -->
        <div class="tab">
            <button style="color: #2980b9;" class="tablinks" >{{link_to_route('evaluador-general','Lista de proyectos')}}</button>
            <button style="color: #2980b9;" class="tablinks" onclick="openCity(event, 'Porcentajes')">Porcentajes</button>
            <button style="color: #2980b9;" class="tablinks" onclick="openCity(event, 'Tablas')">Tablas</button>
            <button style="color: #2980b9;" class="tablinks">{{link_to_route('resultado-graficas','Graficas',['id' => Crypt::encryptString($proyecto[0]->PK_id)])}}</button>
        </div>
        
         <!--Porcentajes Generales-->
        <div id="Porcentajes" class="tabcontent">
            @component('components.porlet-post-action', [ 
                    'title' => 'Generar reporte de porcentaje',
                    'icon' => 'fa fa-file-pdf-o',
                    'id' => 'pdf-form1',
                    'color' => '#e74c3c',
                    'colorIcon' => '#e74c3c',
                    'url' => route('pdf.porcentaje-evaluator',['id' => Crypt::encryptString($proyecto[0]->PK_id)])
                    ])
            @endcomponent
            <br/>
            <br/>
            <ul class="list-group" style="width: 100%;">
                <li class="list-group-item">Modelacion: 
                    
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
                    'id' => 'pdf-form2',
                    'color' => '#e74c3c',
                    'colorIcon' => '#e74c3c',
                    'url' => route('pdf.tablas-evaluator-general',['id' => Crypt::encryptString($proyecto[0]->PK_id)])
                    ])
            @endcomponent
            <div align="center">
                <br/>
                <table class="table table-borderless">
                    <thead>
                        <td style="width:50%">
                            <h2 align="center">Proyecto: <b>{{$proyecto[0]->nombre}}</b></h2>
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
        </div>
        <!--Fin Tablas comparativas Generales-->
        <!--Graficas Generales-->
        <div id="Graficas" class="tabcontent">
           
            <div>
                <div id="horizon" align='center' style="width: 150%; height: 150%"></div>
            </div>
            
        </div>
        <!--Fin de las Graficas Generales-->

        
    @include('partials.modal-help-evaluator-resultado-general')
    @endcomponent
@endsection

@push('styles')  
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
@endpush
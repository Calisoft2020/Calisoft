@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
                'icon' => 'fa fa-lightbulb-o', 
                'title' => 'Sugerencias: ' . $proyecto->nombre,
                'pdf' => route('pdf.student-sugerencia', compact('proyecto'))
        ])
        <div id="app" class="row">
            <div class="col-sm-6">                
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Modelado</h4>
                    </li>
                    <li class="list-group-item">
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    <td width="33%"><h5><b>Componentes<br/><h4>{{count($totalesModelado)}}</h4></b></h5></td>
                                    <td width="33%" style="background-color: #dff9fb"><h5><b>Minimos:<br/><h4> {{$requiredModelado}}</h4></h5></td>
                                    <td width="33%" style="background-color: #7bed9f"><h5><b>Cumplidos: <br/><h4>{{$cumplidoModelado}}<b>&nbsp;&nbsp;&nbsp;({{round(($cumplidoModelado*100)/$requiredModelado)}}%)</b></h4></h5></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-sm-6">
                            <b>Debilidad</b> 
                            @if($lessModelado->nota == null)
                                <h4>
                                    Sin documento ({{$lessModelado->tipo->nombre}})&nbsp;&nbsp;&nbsp;
                                    <span style="background-color: #ff7979" class="badge">
                                        {{0}}%
                                    </span>
                                </h4>
                                <br>
                            @else
                                <h4>
                                    {{$lessModelado->nombre}} ({{$lessModelado->tipo->nombre}})&nbsp;&nbsp;&nbsp;
                                    <span style="background-color: #ff7979" class="badge">
                                        {{$lessModelado->nota*100}}%
                                    </span>
                                </h4>
                                <br>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <b>Fortaleza</b>
                            <h4>
                                {{$maxModelado->nombre}} ({{$maxModelado->tipo->nombre}})&nbsp;&nbsp;&nbsp;
                                <span style="background-color: #7bed9f" class="badge">
                                {{$maxModelado->nota*100}}%
                            </span>
                            </h4>
                        </div>
                        <br/>
                        <hr/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        @if(count($modeladoFaltante) >= 1)
                        <ul class="list-group" width="100%">
                            <li class="list-group-item list-group-item-danger text-center">
                                <h4 class="list-group-item-heading">Diagramas que presentaron inconvenientes</h4>
                            </li>
                            <li class="list-group-item">
                                @foreach ($modeladoFaltante as $model)
                                        <h5>
                                            &raquo;&nbsp;&nbsp;{{$model->nombre}}  
                                        </h5>
                                @endforeach
                            </li>
                        </ul>
                        @endif
                        @if(count($componenteSugeridos) >= 1)
                        <ul class="list-group" width="100%">
                            <li class="list-group-item list-group-item-warning text-center">
                                <h4 class="list-group-item-heading">Componentes que pueden implementarse</h4>
                            </li>
                            <li class="list-group-item">
                                <table class="table table-borderless table-condensed table-hover">
                                    @foreach ($componenteSugeridos as $c)
                                    <tr>
                                    <h5>
                                        <td>
                                            <span class="badge">
                                                {{$c->nombreDiagrama}}
                                            </span>
                                        </td>
                                        <td>
                                            <span style="background-color: #ff7979" class="badge">
                                                {{$c->nombre}}
                                            </span>
                                        </td>
                                        @if($c->observacion == "")
                                            <td></td>
                                        @else
                                        <td > 
                                            &raquo;
                                            {{$c->observacion}}
                                        </td>
                                        @endif
                                    </h5>
                                    </tr>
                                    @endforeach
                                </table>
                            </li>
                        </ul>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Codificacion</h4>
                    </li>
                    <li class="list-group-item">
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    @if($totalesCodificacion != 0)
                                        <td width="50%"><h5><b>Componentes<br/><h4>{{$totalesCodificacion}}</h4></b></h5></td>
                                        <td width="50%" style="background-color: #7bed9f"><h5><b>Cumplidos: <br/><h4>{{$cumplidoCodificacion}}<b>&nbsp;&nbsp;&nbsp;({{round(($cumplidoCodificacion*100)/$totalesCodificacion)}}%)</b></h4></h5></td>
                                    @else
                                        <td width="50%"><h5><b>Componentes<br/><h4>{{$totalesCodificacion}}</h4></b></h5></td>
                                    <td width="50%" style="background-color: #7bed9f"><h5><b>Cumplidos: <br/><h4>{{$cumplidoCodificacion}}<b>&nbsp;&nbsp;&nbsp;(0%)</b></h4></h5></td>
                                    @endif
                                    
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-sm-6">
                            <b>Debilidad</b>
                            @if($lessCodificacion->nota == null)
                                <h4>
                                    <br/>
                                    {{$lessCodificacion->item}} &nbsp;&nbsp;&nbsp;
                                    <span style="background-color: #ff7979" class="badge">
                                        {{0}}%
                                    </span>
                                </h4>
                                <br>
                            @else
                                <h4>
                                    <br/>
                                    {{$lessCodificacion->item}}&nbsp;&nbsp;&nbsp;
                                    <span style="background-color: #ff7979" class="badge">
                                        {{$minScript*100}}%
                                    </span>
                                </h4>
                                <br>
                            
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <b>Fortaleza</b>
                            <h4>
                                <br/>
                                {{$maxCodificacion->item}}&nbsp;&nbsp;&nbsp;
                                <span style="background-color: #7bed9f" class="badge">
                                {{$maxCodificacion->nota*100}}%
                            </span>
                            <br>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        @if(count($codificacionSugeridos) >= 1)
                        <ul class="list-group" width="100%">
                            <li class="list-group-item list-group-item-danger text-center">
                                <h4 class="list-group-item-heading">Items para mejorar</h4>
                            </li>
                            <li class="list-group-item">
                                <table class="table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Fallidos</th>
                                            <th>Porcentaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    @foreach ($codificacionSugeridos as $sugerido)
                                    <h5>
                                    <tr>
                                        <td>
                                            &raquo;{{$sugerido->item}}&nbsp;({{$sugerido->total}})
                                        </td>
                                        <td>
                                            @if((($sugerido->total)-($sugerido->acertadas)) == 0)
                                                No aplica
                                            @else
                                                {{($sugerido->total)-($sugerido->acertadas)}}
                                            @endif
                                            
                                        </td>
                                        <td>
                                            {{$sugerido->nota*100}}%
                                        </td>
                                    </tr>
                                    </h5>
                                    @endforeach
                                </table>
                            </li>
                        </ul>
                        <ul class="list-group" width="100%">
                            <li class="list-group-item list-group-item-warning text-center">
                                <h4 class="list-group-item-heading">El evaluador dice</h4>
                            </li>
                            <li class="list-group-item">
                                @foreach ($codificacionSugeridos as $sugerido)
                                    @if($sugerido->comentario == null)
                                    <h5>
                                        No hay comentarios.
                                    </h5>
                                    @break
                                    @else
                                    <h5>
                                        &raquo;&nbsp;{{$sugerido->comentario}}
                                        @break
                                    </h5>
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
            @if(count($bdSugeridos) >= 1)
            <div class="col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Base de datos</h4>
                    </li>
                    <li class="list-group-item">
                        <table width="100%">
                            <tr>
                                <td width="50%">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-danger text-center">
                                            <h4 class="list-group-item-heading">Nomeclatura para mejorar</h4>
                                        </li>
                                        <li class="list-group-item">
                                            <table class="table table-borderless table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre nomenclatura</th>
                                                        <th>Fallidos</th>
                                                        <th>Porcentaje</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                    
                                                </tbody>
                                                @foreach ($bdSugeridos as $sugerido)
                                                <h5>
                                                <tr>
                                                    <td>
                                                        &raquo;{{$sugerido->nombre}}&nbsp;({{$sugerido->total}})
                                                    </td>
                                                    <td>
                                                        @if((($sugerido->total)-($sugerido->acertadas)) == 0)
                                                            No aplica
                                                        @else
                                                            {{($sugerido->total)-($sugerido->acertadas)}}
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        {{($sugerido->calificacion*100)/5}}%
                                                    </td>
                                                </tr>
                                                </h5>
                                                @endforeach
                                            </table>
                                        </li>
                                    </ul>
                                </td>
                                <td width="50%">
                                    <table width="100%" class="text-center">
                                        <tr>
                                            <td width="50%" style="background: #ffd0cc">
                                                <b>Debilidad</b> 
                                                @if($lessBD->calificacion == null)
                                                    <h4>
                                                        {{$lessBD->nombre}} ({{$lessBD->estandar}})&nbsp;&nbsp;&nbsp;
                                                        <span style="background-color: #ff7979" class="badge">
                                                            {{0}}%
                                                        </span>
                                                    </h4>
                                                    <br>
                                                @else
                                                    <h4>
                                                        {{$lessBD->nombre}} ({{$lessBD->estandar}})&nbsp;&nbsp;&nbsp;
                                                        <span style="background-color: #ff7979" class="badge">
                                                            {{$lessBD->calificacion*100}}%
                                                        </span>
                                                    </h4>
                                                    <br>
                                                @endif
                                            </td>
                                            <td width="50%" style="background: #adffc3">
                                                <b>Fortaleza</b>
                                                <h4>
                                                    {{$maxBD->nombre}} ({{$maxBD->estandar}})&nbsp;&nbsp;&nbsp;
                                                    <span style="background-color: #7bed9f" class="badge">
                                                    {{$maxBD->calificacion*20}}%
                                                </span>
                                                </h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-warning text-center">
                                            <h4 class="list-group-item-heading">El evaluador sugiere</h4>
                                        </li>
                                        <li class="list-group-item">
                                            @foreach ($bdSugeridos as $sugerido)
                                                @if($sugerido->observacion == null)
                                                    <h5>
                                                        No hay comentarios.
                                                    </h5>
                                                    @break
                                                    @else
                                                    <h5>
                                                        &raquo;&nbsp;{{$sugerido->observacion}}
                                                        @break
                                                    </h5>
                                                @endif
                                            @endforeach
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </li>
                </ul>
            </div>
            @endif
        @include('partials.modal-help-student-sugerencia')
        @endcomponent
        </div>
    </div>
@endsection
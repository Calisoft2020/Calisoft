@extends('pdf.master')

@section('body')

<h2 align="center">{{$proyecto[0]->nombre}}</h2>
<br/>
<br/>
<div class="col-sm-12">                
    <ul class="list-group">
        <li class="list-group-item list-group-item-success text-center">
            <h4  class="list-group-item-heading">Modelado</h4>
        </li>
        <li class="list-group-item">
            <table class="table table-bordered text-center">
                <tbody>
                    <tr>
                        <td width="33%"><h5><b>Componentes<br/><h4>{{count($totalesModelado)}}</h4></b></h5></td>
                        <td width="33%" style="background-color: #dff9fb"><h5><b>Minimos:<br/><h4> {{$requiredModelado}}</h4></b></h5></td>
                        <td width="33%" style="background-color: #7bed9f"><h5><b>Cumplidos: <br/><h4>{{$cumplidoModelado}}&nbsp;&nbsp;&nbsp;({{round(($cumplidoModelado*100)/$requiredModelado)}}%)</b></h4></h5></td>
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
                    <br/>
                @else
                    <h4>
                        {{$lessModelado->nombre}} ({{$lessModelado->tipo->nombre}})&nbsp;&nbsp;&nbsp;
                        <span style="background-color: #ff7979" class="badge">
                            {{$lessModelado->nota*100}}%
                        </span>
                    </h4>
                    <br/>
                @endif
            </div>
            <div class="col-sm-12">
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
                    <h5>
                        <li class="list-group-item">
                            @foreach ($componenteSugeridos as $c)
                                <span>
                                    {{$c->nombreDiagrama}}
                                </span>
                                &nbsp;&nbsp;
                                <span>
                                    ->&nbsp;&nbsp;({{$c->nombre}})
                                </span>
                            <br/>
                            @endforeach
                        </li>
                    </h5>
                </li>
            </ul>
            @endif
        </li>
    </ul>
</div>

@if(count($bdSugeridos) >= 1)
<div class="col-sm-12">
    <ul class="list-group">
        <li class="list-group-item list-group-item-success text-center">
            <h4  class="list-group-item-heading">Codificacion</h4>
        </li>
        <li class="list-group-item">
            <table class="table table-bordered text-center">
                <tbody>
                    <tr>
                        <td width="50%"><h5><b>Componentes<br/><h4>{{$totalesCodificacion}}</h4></b></h5></td>
                        @if($totalesCodificacion == 0 || $totalesCodificacion == null)
                        <td width="50%" style="background-color: #7bed9f"><h5><b>Cumplidos: <br/><h4>0<b>&nbsp;&nbsp;&nbsp;(0%)</b></h4></h5></td>
                        @else   
                        <td width="50%" style="background-color: #7bed9f"><h5><b>Cumplidos: <br/><h4>{{$cumplidoCodificacion}}<b>&nbsp;&nbsp;&nbsp;({{round(($cumplidoCodificacion*100)/$totalesCodificacion)}}%)</b></h4></h5></td>
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
                    <br/>
                @else
                    <h4>
                        <br/>
                        {{$lessCodificacion->item}}&nbsp;&nbsp;&nbsp;
                        <span style="background-color: #ff7979" class="badge">
                            {{$minScript*100}}%
                        </span>
                    </h4>
                    <br/>
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
                <br/>
            </div>
            @if(count($codificacionSugeridos) >= 1)
            <ul class="list-group" width="100%">
                <li class="list-group-item list-group-item-danger text-center">
                    <h4 class="list-group-item-heading">Items para mejorar</h4>
                </li>
                @foreach ($codificacionSugeridos as $sugerido)
                <li class="list-group-item">
                    Item:&nbsp;&raquo;{{$sugerido->item}}&nbsp;({{$sugerido->total}})
                    <br/>
                    Fallido:&nbsp;&raquo;
                    @if((($sugerido->total)-($sugerido->acertadas)) == 0)
                        No aplica
                    @else
                        {{($sugerido->total)-($sugerido->acertadas)}}
                    @endif
                    <br/>
                    Porcentaje:&nbsp;&raquo;{{$sugerido->nota*100}}%
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        <li class="list-group-item">
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
</div>
@endif

@if(count($bdSugeridos) >= 1)
<div class="col-sm-12">
    <ul class="list-group">
        <li class="list-group-item list-group-item-success text-center">
            <h4  class="list-group-item-heading">Base de datos</h4>
        </li>
        <li class="list-group-item">
            <ul class="list-group">
                @foreach ($bdSugeridos as $sugerido)
                <li class="list-group-item">
                    <h5>
                        Item:&nbsp;&raquo;({{$sugerido->total}})
                        Nombre nomenclatura:&nbsp;&raquo;{{$sugerido->nombre}}&nbsp;({{$sugerido->total}})
                        <br/>
                        Fallidos:&nbsp;&nbsp;
                        @if((($sugerido->total)-($sugerido->acertadas)) == 0)
                            No aplica
                        @else
                            {{($sugerido->total)-($sugerido->acertadas)}}
                        @endif
                        <br/>
                        Porcentaje:&nbsp;&nbsp;{{($sugerido->calificacion*100)/5}}%
                    </h5>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="list-group-item">
            <ul class="list-group">
                <li class="list-group-item">
                    Debilidad&nbsp;&nbsp;
                    @if($lessBD->calificacion == null)
                        <h4>
                            {{$lessBD->nombre}} ({{$lessBD->estandar}})&nbsp;&nbsp;&nbsp;
                            <span style="background-color: #ff7979" class="badge">
                                {{0}}%
                            </span>
                        </h4>
                        <br/>
                    @else
                        <h4>
                            {{$lessBD->nombre}} ({{$lessBD->estandar}})&nbsp;&nbsp;&nbsp;
                            <span style="background-color: #ff7979" class="badge">
                                {{$lessBD->calificacion*100}}%
                            </span>
                        </h4>
                        <br/>
                    @endif
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fortaleza&nbsp;&nbsp;
                    <h4>
                        {{$maxBD->nombre}} ({{$maxBD->estandar}})&nbsp;&nbsp;&nbsp;
                        <span style="background-color: #7bed9f" class="badge">
                        {{$maxBD->calificacion*20}}%
                    </span>
                    </h4>
                </li>
            </ul>            
        </li>
        <li class="list-group-item">
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
        </li>
    </ul>
</div>
@endif

@endsection
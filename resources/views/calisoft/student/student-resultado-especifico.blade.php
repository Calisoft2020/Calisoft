@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
                'icon' => 'fa fa-book', 
                'title' => 'Resultados especificos '.$proyecto->nombre,
                'pdf' => route('pdf.student-especifico', compact('proyecto'))
        ])
        <div id="app" class="row">
            <div class="col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Vista</h4>
                    </li>
                    <li class="list-group-item">
                        <div class="btn-group-justified">
                            <button style="width: 25%" class="btn btn-warning" type="submit" onclick="location.href = '{{ route('resultados-especificos-sugerencias')}}'">Sugerencias &nbsp;&nbsp;&nbsp;<i class="fa fa-lightbulb-o" aria-hidden="true"></i></button>
                                <button style="width: 25%" class="btn btn-primary" type="submit" onclick="location.href = '{{ route('porcentaje-general')}}'">Porcentajes &nbsp;&nbsp;&nbsp;<i class="fa fa-percent" aria-hidden="true"></i></button>
                                <button style="width: 25%" class="btn btn-info" type="submit" onclick="location.href = '{{ route('porcentaje-general')}}'">Tablas comparativas &nbsp;&nbsp;&nbsp;<i class="fa fa-table" aria-hidden="true"></i></button>
                                <button style="width: 25%" class="btn btn-success" type="submit" onclick="location.href = '{{ route('grafica-general')}}'">Graficas &nbsp;&nbsp;&nbsp;<i class="fa fa-pie-chart" aria-hidden="true"></i></button>
                          </div>
                        <br/>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Modelado: {{$proyecto->nombre}} ({{$modelado}} %)</h4>
                    </li>
                    <li class="list-group-item">
                        @foreach ($documentos as $d)
                            <h4>
                            <a class="list-group-item-info">
                                    {{$d->nombre}}   ({{$d->tipo->nombre}})
                                <span class="badge">{{($d->nota)*100}}%</span>
                                </a>
                            </h4>
                            <br/>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Codificacion: {{$proyecto->nombre}} ({{$notaCodificacion}} %)</h4>
                    </li>
                    <li class="list-group-item">
                        @foreach ($codificacion as $c)
                            <h4>
                            <a class="list-group-item-info">
                                    {{substr($c->url,5)}}   ({{$c->item}})
                                <span class="badge">{{($c->nota*100)}}%</span>
                                </a>
                            </h4>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-md-7">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Base de datos: {{$proyecto->nombre}} ({{$notaBd}} %)</h4>
                    </li>
                    <li class="list-group-item">
                        @foreach ($resultadoBd as $r)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive">
                                <thead>
                                    <th class="text-center">Componente</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Acertadas</th>
                                    <th class="text-center">Calificacion</th>
                                    <th class="text-center">Cumple</th>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td style="width: 20%">{{$r->nombre}}</td>
                                        <td style="width: 20%">{{$r->total}}</td>
                                        <td style="width: 20%">{{$r->acertadas}}</td>
                                        <td style="width: 20%">{{$r->calificacion}}</td>
                                        <td style="width: 20%">
                                            @if(($r->acertadas*2) < $r->total || $r->total == 0)
                                                <i class="glyphicon glyphicon-remove" style="color : red;"></i>         
                                            @else
                                                <i class="glyphicon glyphicon-ok" style="color : green;"></i>         
                                            @endif
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-md-5">
                @if($plataforma == null)
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Plataforma: {{$proyecto->nombre}} ({{$plataforma->calificacion}}%)</h4>
                    </li>
                    <li class="list-group-item">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive">
                                <thead>
                                    <th class="text-center">No se hizo prueba de plataforma</th>
                                </thead>
                            </table>
                        </div>
                    </li>
                </ul>
                @else
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Plataforma: {{$proyecto->nombre}} ({{$plataforma->calificacion}}%)</h4>
                    </li>
                    <li class="list-group-item">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dt-responsive">
                                <thead>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Prioridad</th>
                                    <th class="text-center">Calificacion</th>
                                    <th class="text-center">Observacion</th>
                                    <th class="text-center">Promedio</th>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>{{$plataforma->nombre}}</td>
                                        <td>{{$plataforma->prioridad}}</td>
                                        <td>{{$plataforma->calificacion}}</td>
                                        <td>{{$plataforma->observacion}}</td>
                                        <td> 
                                            @if($plataforma->calificacion <= 60)
                                                <i class="glyphicon glyphicon-remove" style="color : red;"></i>         
                                            @else
                                                <i class="glyphicon glyphicon-ok" style="color : green;"></i>         
                                            @endif
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
                @endif
            </div>
        </div>

        @include('partials.modal-help-calificacion-modelado')
        @endcomponent
    </div>
@endsection

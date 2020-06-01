@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>{{ $proyecto->nombre }} - Resultados especificos</h3>
        <hr>
        <div id="app" class="row">
            <div class="col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Modelado: {{$proyecto->nombre}} ({{$modelado}} %)</h4>
                    </li>
                    <li class="list-group-item">
                        @foreach ($documentos as $d)
                            <h4>
                            <a class="list-group-item">
                                    {{$d->nombre}}   ({{$d->tipo->nombre}})
                                    <br/>
                                <span class="badge">{{($d->nota)*100}}%</span>
                                </a>
                            </h4>
                            <br/>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Codificacion: {{$proyecto->nombre}} ({{$notaCodificacion}} %)</h4>
                    </li>
                    <li class="list-group-item">
                        @foreach ($codificacion as $c)
                            <h4>
                            <a class="list-group-item">
                                    {{substr($c->url,5)}}   ({{$c->item}})
                                    <br/>
                                <span class="badge">{{($c->nota*100)}}%</span>
                                </a>
                            </h4>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success text-center">
                        <h4  class="list-group-item-heading">Base de datos: {{$proyecto->nombre}} ({{$notaBd}} %)</h4>
                    </li>
                    <li class="list-group-item">
                        @foreach ($resultadoBd as $r)
                        <div class="table-responsive">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Componente:&nbsp;&nbsp;{{$r->nombre}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Total:&nbsp;&nbsp;{{$r->total}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Acertadas:&nbsp;&nbsp;{{$r->acertadas}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Calificacion:&nbsp;&nbsp;{{$r->calificacion}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Cumple:&nbsp;&nbsp;
                                    @if(($r->acertadas*2) < $r->total || $r->total == 0)
                                        <a style="color : red;">No</a>         
                                    @else
                                        <a style="color : green;">Si</a>         
                                    @endif
                                    <br/>
                                </li>
                            </ul>
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
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Nombre&nbsp;&nbsp;{{$plataforma->nombre}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Prioridad&nbsp;&nbsp;{{$plataforma->prioridad}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Calificacion&nbsp;&nbsp;{{$plataforma->calificacion}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Observacion&nbsp;&nbsp;{{$plataforma->observacion}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    Promedio&nbsp;&nbsp;
                                    @if($plataforma->calificacion <= 60)
                                        <a style="color : red;">No alcanza</a>         
                                    @else
                                        <a style="color : green;">Alcanza</a>         
                                    @endif
                                    <br/>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
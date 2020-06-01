@extends('pdf.master')

@section('body')
    <div class="text-center">
    <h2><b>Porcentaje general</b></h2>
    <br/>
    <table class="table table-bordered" align="center" style="width: 50%">
        <tbody align="center">
            <tr>
                <td>
                    <h4>Nombre del proyecto</h4>
                </td>
                <td align="left">
                    <h4>{{$nombrePj}} </h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Integrantes</h4>
                </td>
                <td align="left">
                    @foreach ($integrante as $i)
                        <h4><span class="badge" style="background-color: steelblue;">{{$i->name}}</span></h4>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Evaluador</h4>
                </td>
                <td align="left">   
                    @foreach ($evaluador as $e)
                        <h4><span class="badge" style="background-color: steelblue;">{{$e->name}}</span></h4>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Creado</h4>
                </td>
                <td align="left">
                    <h4>{{$fechaCreado}}</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Categoria</h4>
                </td>
                <td align="left">
                    <h4>{{$categoria->nombre}}</h4>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <hr>
    <br/>
    <h3>Modelado</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
            aria-valuemin="0" aria-valuemax="100" style="width:{{$modeladoPorcentaje.'%'}}">
        </div>
    </div>        
    &nbsp;&nbsp;<span class="badge">{{$modeladoPorcentaje}}%</span>
    <br/>
    <br/>

    <h3>Casos de prueba o plataforma</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
            aria-valuemin="0" aria-valuemax="100" style="width:{{$plataformaPorcentaje.'%'}}">
        </div>
    </div>
    &nbsp;&nbsp;<span class="badge">{{$plataformaPorcentaje}}%</span>
    <br/>
    <br/>

    <h3>Codificacion</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
            aria-valuemin="0" aria-valuemax="100" style="width:{{$codificacionPorcentaje.'%'}}">
        </div>
    </div>
    &nbsp;&nbsp;<span class="badge">{{$codificacionPorcentaje}}%</span>
    <br/>
    <br/>

    <h3>Base de datos</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
            aria-valuemin="0" aria-valuemax="100" style="width:{{$resultadoBDPorcentaje.'%'}}">
        </div>
    </div>
    &nbsp;&nbsp;<span class="badge">{{$resultadoBDPorcentaje}}%</span>
    <br/>
    <br/>

    <h3><b>Total</b></h3>
    <div class="progress">
        <div class="progress-bar @if ($totalPorcentaje >= 50)
                            
            @else
            progress-bar-danger
        @endif" role="progressbar"
            aria-valuemin="0" aria-valuemax="100" style="width:{{$totalPorcentaje.'%'}}">
        </div>
    </div>
    &nbsp;&nbsp;<p class="badge" style="tex">{{$totalPorcentaje}}%</p>
@endsection
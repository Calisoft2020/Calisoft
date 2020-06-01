@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-calculator', 
            'title' => 'Proyecto: '.$nombrePj,
            'pdf' => route('pdf.resultado-general')
            ])
            <div id="app">
                <div class="row">
                    <div align="center">
                        <table class="table table-bordered" style="width: 50%">
                            <thead>
                            <h2>Resultados: {{$nombrePj}}</h2>
                            </thead>
                            <br/>
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
                                    <td align="center">
                                        <h5><b>Total</b></h5>
                                    </td>
                                    <td align="left">
                                        <b>{{$total}}</b>
                                    </td>
                                </tr>
                                <!--RESULTADOS GENERALES/ESPECIFICOS-->
                            </tbody>
                        </table>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" onclick="location.href = '{{ route('porcentaje-general') }}'">Resultados generales</button>
                            <button type="button" class="btn btn-primary" onclick="location.href = '{{ route('resultados-especificos') }}'">Resultados especificos</button>
                        </div>
                    </div>
                </div>
                @include('partials.modal-help-student-resultados-home')
            </div>
        @endcomponent  
    </div>
@endsection
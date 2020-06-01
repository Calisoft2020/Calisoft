@extends('pdf.master')

@section('body')
    <div class="text-center">
        <br/>
        <br/>
        <br/>
        <h2><b>Resultado general por modulo</b></h2>
        <br/>
        <br/>
        <h4 align="justify"><b>Nota:</b> Si la tabla que contiene los resultados de la evaluación de su proyecto 
            aparece pintada de color verde, significa que si proyecto está por encima del 
            promedio de los demas, por el contrario si es de color rojo, su proyecto está 
            por debajo del promedio</h4>
        <hr>
    </div>
    <table class="table table-borderless" align="center" style="width:100%">
        <thead>
            <tr>
                <th style="width:50%">
                    <h1 align="center">Proyecto: <b>{{$nombrePj}}</b></h1>
                </th>
                <th style="width:50%">
                    <h1 align="center">Promedio General</h1>
                </th>
            </tr>
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
                        @endif">>
                        <tbody>
                            <!--MODELACION-->
                            <tr>
                                <td align="center">
                                    <h4>Modelacion</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$modeladoTabla}}</h4>
                                </td>
                            </tr>
                            <!--PLATAFORMA-->
                            <tr>
                                <td align="center">
                                    <h4>Plataforma</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$plataformaTabla}}</h4>
                                </td>
                            </tr>
                            <!--CODIFICACION-->
                            <tr>
                                <td align="center">
                                    <h4>Codificacion</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$codificacionTabla}}</h4>
                                </td>
                            </tr>
                            <!--BASEDATOS-->
                            <tr>
                                <td align="center">
                                    <h4>Base de Datos</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$resultadoBDTabla}}</h4>
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
                                    <h3><b>Total</b></h3>
                                </td>
                                <td align="left" style="
                                    @if ($promedioGeneralTotalTabla > $totalTabla)
                                        background-color: #f06f51
                                    @else
                                        background-color: #58e886
                                    @endif">
                                    <h3><b>{{$totalTabla}}</b></h3>
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
                                    <h4>Modelacion</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$promedioGeneralDocumentosTabla}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <h4>Plataforma</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$promedioGeneralCasosTabla}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <h4>Codificacion</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$promedioGeneralCodificacionTabla}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <h4>Base de Datos</h4>
                                </td>
                                <td align="left">
                                    <h4>{{$promedioGeneralBDTabla}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <h3><b>Total</b></h3>
                                </td>
                                <td align="left">
                                    <h3><b>{{$promedioGeneralTotalTabla}}</b></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
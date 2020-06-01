@extends('pdf.master')

@section('body')
    <div class="text-center">
        <br/>
        <br/>
        <br/>
        <h2><b>Resultado general por modulo</b></h2>
        <br/>
        <br/>
        <hr>
    </div>
    <table align="center" class="table table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>
                <h3>Proyecto</h3>
            </th>
            <th>
                <h4>{{$nombrePj}}</h4>
            </th>
        </tr>
        <tr>
            <th>
                <h3>Integrantes</h3>
            </th>
            <th>
                <h3>
                    @foreach ($integrante as $i)
                        <span class="badge badge-secondary" style="background-color: steelblue;">{{$i}}</span><br/>
                    @endforeach
                </h3>
            </th>
        </tr>
        </thead>
        <br/>
        <tbody>
            <tr>
                <td align="center">
                    <h4>Modelacion</h4>
                </td>
                <td align="left">
                    {{$modelado}}
                </td>
            </tr>
            <tr>
                <td align="center">
                    <h4>Plataforma</h4>
                </td>
                <td align="left">
                    {{$plataforma}}
                </td>
            </tr>
            <tr>
                <td align="center">
                    <h4>Codificacion</h4>
                </td>
                <td align="left">
                    {{$codificacion}}
                </td>
            </tr>
            <tr>
                <td align="center">
                    <h4>Base de Datos</h4>
                </td>
                <td align="left">
                    {{$resultadoBD}}
                </td>
            </tr>
            <tr style="background-color: #82ccdd;">
                <td align="center">
                    <h4><b>Total</b></h4>
                </td>
                <td align="left">
                    <b>{{$total}}</b>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
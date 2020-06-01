@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3> Evaluación General Codificacion </h3>
        <hr>
    </div>

    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Nombre del proyecto</th>
                <th class="text-center">Calificacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calificaciones as $calificacion)
                <tr>
                    <td>{{ $calificacion['nombre'] }}</td>
                    <td class="text-center" >{{ $calificacion['nota']*100 }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <table class="table table-borderless">
        <tbody>
            <tr class="info">
                <th>Promedio General Proyectos</th>
                <th>{{ round($promedio,3)*100 }}%</th>
            </tr>
        </tbody>
    </table>
@endsection
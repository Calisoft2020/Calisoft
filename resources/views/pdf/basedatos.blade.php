@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>{{ $proyecto->nombre }} - Evaluación de Base de Datos</h3>
        <hr>
    </div>        
        <table class="table">
            <thead>
                <tr>
                    <th>Componente</th>
                    <th>Total</th>
                    <th>Acertadas</th>
                    <th>Calificacion</th>
                </tr>
            </thead>
            <tbody>
            @foreach($sql->componentes as $componente)
                <tr>
                    <td>
                         {{$componente->nombre}}
                    </td>
                    <td>
                        {{$componente->pivot->total}}
                    </td>
                    <td>
                        {{$componente->pivot->acertadas}}
                    </td>
                    <td>
                        {{$componente->pivot->calificacion}}
                    </td>
                </tr>
                @endforeach 
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td><b>Obsevacion</b></td>
                    <td colspan="3">{{$sql->observacion}}</td>
                </tr> 
                <tr>
                    <td><b>Calificacion Total</b></td>
                    <td colspan="3">{{$promedio}}</td>
                </tr> 
                
            </tbody>            
        </table>
@endsection
@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>{{ $proyecto->nombre }} - Evaluación de plataforma</h3>
        <hr>
    </div>
    @foreach ($casos as $caso)
        <div class="panel panel-default @unless($loop->last) page-break @endunless">
            <div class="panel-heading">
                {{ $caso->nombre }}
            </div>
            @include('pdf.sections.caso', compact('caso'))
            <div class="panel-body">
                @each('pdf.sections.prueba', $caso->pruebas, 'prueba')
            </div>
        </div>
    @endforeach
    <table class="table table-borderless">
        <tbody>
            <tr class="info">
                <th>Promedio General (Plataforma)</th>
                <th>{{ $total }}%</th>
            </tr>
        </tbody>
    </table>
@endsection
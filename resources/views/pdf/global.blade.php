@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>{{ $proyecto->nombre }} - Resultados</h3>
        <hr>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Nombre:</th>
                <td>{{ $proyecto->nombre }}</td>
            </tr>
            <tr>
                <th>Integrantes:</th>
                <td>
                    @foreach ($proyecto->integrantes()->get() as $integrante)
                        <span class="badge badge-info" style="margin-right: 1%">
                            {{ $integrante->name }}
                        </span>
                    @endforeach
                </td>
            </tr>

            <tr>
                <th>Evaluadores:</th>
                <td>
                    @foreach ($proyecto->evaluadores()->get() as $evaluador)
                        <span class="badge badge-info" style="margin-right: 1%">
                            {{ $evaluador->name }}
                        </span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td class="text-uppercase">{{ $proyecto->state }}</td>
            </tr>
            <tr>
                <th>Categoria:</th>
                <td>{{ $proyecto->categoria->nombre }}</td>
            </tr>
            <tr>
                <th>Semillero</th>
                <td>{{ $proyecto->semillero->nombre }}</td>
            </tr>
            <tr>
                <th>Grupo de investigación:</th>
                <td>{{ $proyecto->grupoDeInvestigacion->nombre }}</td>
            </tr>
            <tr>
                <th>Creado el:</th>
                <td>{{ $proyecto->created_at }}</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Modelacion</th>
                <td>{{ $modelacion }}</td>
            </tr>
            <tr>
                <th>Plataforma</th>
                <td>{{ $plataforma }}</td>
            </tr>
            <tr>
                <th>Codificacion</th>
                <td>{{ $codificacion }}</td>
            </tr>
            <tr>
                <th>Base de Datos</th>
                <td>{{ $basedatos }}</td>
            </tr>
            <tr class="info">
                <th>Total</th>
                <th>{{ $total }}</th>
            </tr>
        </tbody>
    </table>
@endsection
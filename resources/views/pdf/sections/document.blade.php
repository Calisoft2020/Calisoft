<table class="table table-bordered table-condensed">
    <thead>
        <tr class="info">
            <th>Evaluador</th>
            <th colspan="2">{{ $key }}</th>
        </tr>
        <tr class="warning">
            <th>Promedio</th>
            <th colspan="2">{{ round($evaluaciones->avg('checked') * 100) }}%</th>
        </tr>
        <tr>
            <th>Componente</th>
            <th>Validación</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($evaluaciones as $evaluacion)
            <tr>
                <td>{{ $evaluacion->componente->nombre }}</td>
                <td>
                    @if ($evaluacion->checked)
                        <i class="text-success">Correcto</i>    
                    @else
                        <i class="text-danger">Incorrecto</i>
                    @endif
                </td>
                <td>{{ $evaluacion->observacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
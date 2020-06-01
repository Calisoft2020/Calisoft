<table class="table table-condensed table-bordered">
    <thead>
        <tr class="active">
            <th class="text-center">Prueba #{{$key + 1}}</th>
            <th class="text-center">Calificación</th>
            <th class="text-center">{{ $prueba->calificacion }}%</th>
        </tr>
        <tr class="active">
            <th class="text-center">Nombre</th>
            <th class="text-center">Entrada</th>
            <th class="text-center">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prueba->contexto as $input)    
            <tr class="text-center">
                <td>{{ $input['nombre'] }}</td>
                <td>{{ $input['entrada'] }}</td>
                <td>
                    @if ($input['estado'])
                        <i class="text-success">Correcto</i>      
                    @else
                        <i class="text-danger">Incorrecto</i>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
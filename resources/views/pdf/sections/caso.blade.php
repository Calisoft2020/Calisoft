<table class="table-bordered table table-condensed">
    <tbody>
        <tr>
            <td>Proposito:</td>
            <td>{{ $caso->proposito }} </td>
        </tr>
        <tr>
            <td>Alcance:</td>
            <td>{{ $caso->alcance }} </td>
        </tr>
        <tr>
            <td>Resultado Esperado:</td>
            <td>{{ $caso->resultado_esperado }} </td>
        </tr>
        <tr>
            <td>Criterios:</td>
            <td>{{ $caso->criterios }} </td>
        </tr>
        <tr>
            <td>Prioridad:</td>
            <td>{{ $caso->prioridad }} </td>
        </tr>
        <tr class="active">
            <th>Calificación:</th>
            <th>{{ $caso->calificacion }}%</th>
        </tr>
    </tbody>
</table>
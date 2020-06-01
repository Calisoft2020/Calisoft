@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>Listado proyectos evaluados</h3>
        <hr>
    </div>
    <div align="center">
        <table style="width: 100%" class="table table-borderless"> 
            <thead>
                <tr>
                    <th>
                        Nombre proyecto
                    </th>
                    <th>
                        integrantes
                    </th>
                    <th>
                        Evaluadores
                    </th>
                    <th>
                        Semillero
                    </th>
                    <th>
                        Fecha de creacion
                    </th>
                </tr>
            </thead>
            <br/>
            <br/>
            <tbody>
                @foreach ($proyecto as $p)
                    <tr>
                        <td>
                            {{$p->nombre}}
                        </td>
                        <td>
                            @foreach ($p->integrantes()->get() as $integrante)
                                <span class="badge badge-info" style="margin-right: 1%; background-color: #487eb0;">
                                    {{ $integrante->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($p->evaluadores()->get() as $evaluador)
                                <span class="badge badge-info" style="margin-right: 1%; background-color: #487eb0;">
                                        {{ $evaluador->name}}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($p->semillero()->get() as $semillero)
                                {{ $semillero->nombre}}
                            @endforeach
                        </td>
                        <td>
                            {{$p->created_at}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection    
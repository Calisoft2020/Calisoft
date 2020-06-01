@extends('pdf.master')

@section('body')
    <br/>
    <div class="text-center">
        <ul class="list-group">
            <li class="list-group-item list-group-item-info text-center">
                <h4  class="list-group-item-heading">Lista de proyectos</h4>
            </li>
            @foreach ( $nombreProyecto as $n)
            <li class="list-group-item">    
                <h4>{{$n->nombre}}</h4>
            </li>
            @endforeach
        </ul>
    </div>
    
@endsection    
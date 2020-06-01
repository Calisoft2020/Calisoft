@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>Usuarios</h3>
        <hr>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)    
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->role }}</td>
                    <td>{{ $usuario->created_at }}</td>
                    <td>{{ $usuario->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
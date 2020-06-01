@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>{{ $proyecto->nombre }} - Evaluación de codificacion</h3>
        <hr>
    </div>
    
    @foreach($scripts as $script)
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>{{ $script->url }}</th>
                        
                    </tr>
                    <tr>
                        <th>
                            Items
                        </th>
                        <th >
                            Total
                        </th>
                        <th >
                            Acertadas
                        </th>
                        <th >
                            Nota
                        </th>

                        
                        
                    </tr>
                       
                </thead>
                <tbody>
                @foreach($script->items as $item)
                    <tr>
                        <td>
                            {{$item->item}}
                        </td>
                        <td>
                            {{$item->pivot->total}}
                        </td>
                        <td>
                            {{$item->pivot->acertadas}}
                        </td>    
                        <td>
                        {{$item->pivot->nota}}
                        </td>
                    </tr>
                 @endforeach
                 <tr>
                    <td><b>Observación</b></td>  
                    <td colspan="3">{{$script->comentario}}</td>   
                </tr>   
                </tbody>
                
            </table>
          
    @endforeach
    <table class="table table-borderless">
        <tbody>
            <tr class="info">
                <th>Promedio General (Codificación)</th>
                <th>{{ $nota*100 }}%</th>
            </tr>
        </tbody>
    </table>
@endsection
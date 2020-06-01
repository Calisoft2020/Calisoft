@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-list', 
            'title' => 'Proyectos evaluados',
            'pdf' => route('pdf.lista-general-evaluado')
        ])

        <div id="app">
           
        @endcomponent
        <div  class="panel panel-primary">
            @foreach ($proyecto as $p)
            <div class="portlet-body">
                <div class="mt-element-list">
                    <div class="mt-list-container list-news ext-2">

                        <ul id="listaProyectos">
                            <li class="mt-list-item">
                                <!--Rutas de los diferentes proyectos-->                                                    
                                <div class="list-icon-container">
                                    <a href="{{route('resultado-general-individual',['id' => Crypt::encryptString($p->PK_id)])}}">
                                        <i class="fa fa-angle-right"></i>
                                    </a>    
                                </div>
                                <!--Fin de rutas de los diferentes proyectos-->

                                <!--Imagenes de proyecto-->   
                                <div class="list-thumb">
                                    <a href="{{route('resultado-general-individual',['id' => Crypt::encryptString($p->PK_id)])}}">
                                        <img class="img-circle" alt="" src="{{url('/img/proyecto-completado.png')}}"/>
                                    </a>
                                </div>     
                                    
                                <!--Fin imagenes de proyecto-->    

                                <!--Titulo proyecto-->    
                                <div class="list-datetime bold uppercase font-yellow-casablanca">Creado el {{$p->created_at}}</div>
                                    <div class="list-item-content">
                                        <p>
                                        <strong>{{$p->nombre}}</strong>
                                        </p>
                                    </div>
                                <!--Fin titulo proyecto-->    
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach 
            </div>

            
        </div>
    </div>
    @include('partials.modal-help-evaluator-resultado-general')
@endsection

@push('styles')  
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
@endpush

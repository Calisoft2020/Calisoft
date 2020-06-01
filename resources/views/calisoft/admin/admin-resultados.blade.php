@extends('layouts.dash')

@section('content')
<div class="col-md-12">
    @component('components.portlet', 
    ['icon' => 'fa fa-line-chart',
     'title' => 'Resultados - Administrador:   Lista de proyectos terminados',
      'pdf' => route('pdf.lista-proyectos-evaluados-admin')])
    <div id="app">
        <div id="resultados" class="row">
            <br/>
            <br/>
            <br/>
            <div  class="panel panel-primary">
                @foreach ($proyecto as $p)
                <div class="portlet-body">
                    <div class="mt-element-list">
                        <div class="mt-list-container list-news ext-2">
    
                            <ul id="listaProyectos">
                                <li class="mt-list-item">
                                    <!--Rutas de los diferentes proyectos-->                                                    
                                    <div class="list-icon-container">
                                        <a href="{{route('informe-individual',['id' => Crypt::encryptString($p->PK_id)])}}">
                                            <i class="fa fa-angle-right"></i>
                                        </a>    
                                    </div>
                                    <!--Fin de rutas de los diferentes proyectos-->
    
                                    <!--Imagenes de proyecto-->   
                                    <div class="list-thumb">
                                        <a href="{{route('informe-individual',['id' => Crypt::encryptString($p->PK_id)])}}">
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
            <div align="center">
                {{$proyecto->links("pagination::bootstrap-4")}}
            </div>
        @include('partials.modal-help-resultados-admin')
    </div>
    @endcomponent
  </div>
@endsection
@push('styles')

<link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
<link rel="stylesheet" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
@endpush

@push('functions')

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/js/admin-proyectos.js"></script>
@endpush

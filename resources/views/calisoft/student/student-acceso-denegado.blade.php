@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-minus-circle', 'title' => 'Acceso Denegado'])
         <div class="row">
            
            <div class="col-sm-6" >
                        
                        <img  alt="" class="img-responsive" src="{{auth()->user()->foto ?: '/img/accesodenegado.png' }}"/>
                        
            </div>
            <div class="col-sm-6 center-text">
                <h1>Señor estudiante</h1>
                <h2>No puede subir la documentación hasta que su proyecto se encuentre 
                    <font style="color:#FF0000;">activo</font>.
                </h2>
                <h3>Gracias.</h3>
            </div>
         </div
        @endcomponent
    </div>
@endsection

@push('styles')


@endpush

@push('functions')
   
@endpush
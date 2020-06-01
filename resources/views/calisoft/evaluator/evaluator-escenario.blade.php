@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-files', 
            'title' => 'Escenario prueba: ' . $casoPrueba->nombre 
        ])
        
        <div id="app">
            <input-list :formulario="json" :caso-prueba-id="casoPruebaId" :npruebas="10" :matrix="{{$matrix}}"></input-list>
        </div>
        
            @include('partials.modal-help-evaluador-plataforma-testing')
        @endcomponent
    </div>
@endsection

@push('styles')  
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">

    
@endpush

    
@push('functions')
    
            
    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    <script src="/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/ui-general.min.js" type="text/javascript"></script>
            
    
    <script>window.casoPruebaId = {{ $casoPrueba->PK_id }};</script>
    <script>window.proyectoId = {{ $proyecto->PK_id }};</script>
    <script src="/js/escenario.js"></script>
@endpush
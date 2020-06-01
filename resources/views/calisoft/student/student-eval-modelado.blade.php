@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
                'icon' => 'fa fa-book', 
                'title' => 'Evaluacion de Modelado', 
                'pdf' => route('pdf.modelacion', compact('proyecto'))
        ])

        <div id="app" class="row">
            <div class="col-sm-6">
                <doc-list :documentos="documentos" :active="selected" @selected="selected = $event"></doc-list>
            </div>
            <div class="col-sm-6" v-if="selected">
                <evaluation-panel :evaluaciones="selected.evaluaciones" :doc="selected.nombre"></evaluation-panel>
            </div>
        </div>

        @include('partials.modal-help-calificacion-modelado')
        @endcomponent
    </div>
@endsection

@push('functions')
    <script src="{{ asset('js/evaluacion-modelado.js') }}"></script>
@endpush
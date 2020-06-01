@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-files-o', 
            'title' => 'Evaluar Documento: ' .  $documento->tipo->nombre 
        ])

        <div class="row">
            <div class="col-sm-7" id="pdf-container">
                <a href="{{ $documento->url }}" class="media"></a>
            </div>
            <div class="col-sm-5">
                <div id="app">
                    <document-evaluation documento-id="{{ $documento->PK_id }}" editable/>
                </div>
            </div>
        </div>


        
        
        @endcomponent
    </div>
@include('partials.modal-help-evaluador-modelacion-calificacion')
@endsection

@push('functions')
    <script src="/assets/global/plugins/jquery.media.js"></script>
    <script>
        $(() => {
            let pdf = $('#pdf-container');
            $('a.media').media({ width: pdf.width(), height: 500 });
        })
    </script>
    <script src="/js/evaluator-docs.js"></script>
@endpush
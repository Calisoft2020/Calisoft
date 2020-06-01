@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-gears', 'title' => 'Semilleros y Grupos de Investigacion'])
        <div id="app" class="row">
            <div class="col-sm-5 col-sm-offset-1" style="">
                <h3 class="text-center">Semilleros</h3>
                <list-group-crud rest="/api/semilleros"></list-group-crud>
            </div>
            <div class="col-sm-5" style="">
                <h3 class="text-center">Grupos de investigación</h3>
                <list-group-crud rest="/api/grupos-de-investigacion"></list-group-crud>
            </div>
            @include('partials.modal-help-semillero')
        </div>
    @endcomponent
    </div>
@endsection


@push('functions')
    <script src="/js/semilleros.js"></script>
@endpush

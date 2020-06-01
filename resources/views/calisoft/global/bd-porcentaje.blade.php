@extends('layouts.dash')

@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-pie-chart', 'title' => 'Base de Datos'])
        <div id="app">
            <porcentajebd :componentes="componentes">

            </porcentajebd>
            @include('partials.modal-help-porcentaje-bd')
        </div>

    @endcomponent
</div>
@endsection
 @push('functions')
 <script src="js/nomenclaturas-show.js"></script>
 @endpush
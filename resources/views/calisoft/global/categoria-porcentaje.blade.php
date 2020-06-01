@extends('layouts.dash')

@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-pie-chart', 'title' => 'Porcentajes'])
        <div id="app">
            <category-list :categorias="categorias">

            </category-list>
            @include('partials.modal-help-categoria')
        </div>

    @endcomponent
</div>
@endsection
 @push('functions')
 <script src="/js/categorias-show.js"></script>
 @endpush

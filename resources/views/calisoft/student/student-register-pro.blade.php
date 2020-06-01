@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-pencil-square', 'title' => 'Registro Proyecto'])
            <div class="row">
                <form action="{{ route('proyectos.store') }}" method="POST" class="col-md-8 col-md-offset-2" >

                    {{ csrf_field() }}

                    @component('components.text', [
                        'name' => 'nombre',
                        'attributes' => "required pattern='[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}'",
                        'label' => 'Nombre del proyecto',
                        'help' => 'Digita el nombre',
                        'icon' => 'fa fa-cubes'
                    ])
                    @endcomponent

                    @component('components.select', [
                        'name' => 'categoria',
                        'title' => 'Categoria',
                        'items' => $categorias,
                        'value' => 'PK_id',
                        'label' => 'nombre'
                    ])
                    @endcomponent

                    @component('components.select', [
                        'name' => 'semillero',
                        'title' => 'Semillero',
                        'items' => $semilleros,
                        'value' => 'PK_id',
                        'label' => 'nombre'
                    ])
                    @endcomponent

                    @component('components.select', [
                        'name' => 'grupo',
                        'title' => 'Grupo de investigacion',
                        'items' => $gruposDeInvestigacion,
                        'value' => 'PK_id',
                        'label' => 'nombre'
                    ])
                    @endcomponent


                    <div class="form-group">
                        <button type="submit" class="btn blue center-block">Enviar</button>
                    </div>

                </form>
            </div>
        @endcomponent
        @include('partials.modal-help-registro-proyecto', compact('categorias'))
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
@endpush

@push('functions')
    <script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="/js/bootstrap.js"></script>
@endpush

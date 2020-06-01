<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-home', 'title' => 'Proyecto de grado'])
        @can('create', 'App\Proyecto')
            <p class="text-justify">
                Todavía no ha creado una propuesta de proyecto,
                puede crearla <a href="{{ route('proyectos') }}">Aqui.</a>
            </p>
        @else
            <div id="app">
                <proyecto-vista></proyecto-vista>
            </div>
        @endcan
        @include('partials.modal-help-proyecto-grado')
    @endcomponent
</div>

@can('create', 'App\Proyecto')
    @push('functions')
        <script src="/js/bootstrap.js"></script>
    @endpush
@endcan

@cannot('create', 'App\Proyecto')
  @push('functions')
    <script src="/js/proyectos.js"></script>
  @endpush
@endcannot

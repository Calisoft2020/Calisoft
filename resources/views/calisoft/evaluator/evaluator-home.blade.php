<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-home', 'title' => 'Proyectos Asignados'])
        <div id="app" class="row">
            <div class="col-md-6" v-for="proyecto in proyectos" :key="proyecto.PK_id">
                <proyecto-panel :proyecto="proyecto" />
            </div>
        </div>
        @include('partials.modal-help-evaluador-proyectos-asignados')
    @endcomponent
</div>



@push('functions')
    <script src="/js/evaluator-proyectos.js"></script>
@endpush
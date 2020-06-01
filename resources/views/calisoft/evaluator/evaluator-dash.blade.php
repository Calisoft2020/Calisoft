@component('components.nav-dropdown', ['icon' => 'fa fa-percent', 'title' => 'Porcentajes'])
    @component('components.nav-link', ['icon' => 'fa fa-book', 'link' => route('porcentajes'),'title' => 'Categorias'])
    @endcomponent

    @component('components.nav-link', ['icon' => 'fa fa-code', 'link' => route('porcentajesCod'),'title' => 'Codificación'])
    @endcomponent

    @component('components.nav-link', ['icon' => 'fa fa-database', 'link' => route('porcentajesbd'),'title' => 'Bases de Datos'])
    @endcomponent

    
@endcomponent
@component('components.nav-dropdown', ['icon'=> 'fa fa-book','title'=>'Estandares'])
    @component('components.nav-link', ['icon' => 'fa fa-book','link'=>route('estandar-codificacion'),'title' => 'Codificación'])
    @endcomponent
    @component('components.nav-link', [
        'icon' => 'fa fa-database',
        'link'=>route('estandar-basedatos'),
        'title' => 'Base de Datos'])
    @endcomponent
@endcomponent
@component('components.nav-link', [
    'icon' => 'fa fa-line-chart',
     'link' => route('evaluador-general'),
     'title' => 'Resultados'])
@endcomponent
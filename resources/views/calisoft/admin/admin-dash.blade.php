@component('components.nav-link', [
    'icon' => 'fa fa-users',
    'title' => 'Usuarios',
    'link' => route('usuarios')
])
@endcomponent

@component('components.nav-link', [
    'icon' => 'fa fa-folder-open',
    'link' => route('proyecto.admin'),
    'title' => 'Proyectos'
])
@endcomponent



@component('components.nav-link', [
    'icon' => 'fa fa-book',
    'link' => route('tdocumentos'),
    'title' => 'Documentos'
])
@endcomponent

@component('components.nav-link', [
    'icon' => 'fa fa-gears',
    'title' => 'Semilleros',
    'link' => route('semilleros')
])
@endcomponent

@component('components.nav-dropdown', ['icon' => 'fa fa-percent', 'title' => 'Porcentajes'])

    @component('components.nav-link', [
        'icon' => 'fa fa-pie-chart',
        'link' => route('categorias'),
        'title' => 'Categorias'
    ])
    @endcomponent


    @component('components.nav-link', [
        'icon' => 'fa fa-database',
        'title' => 'Base de Datos',
        'link' => route('basedatos')
    ])
    @endcomponent
    @component('components.nav-link',[
        'icon' => 'fa fa-code',
        'title' => 'Codificaci¨®n',
        'link' => route('codificacion')
    ])
    @endcomponent
    
@endcomponent
@component('components.nav-dropdown', ['icon'=> 'fa fa-book','title'=>'Estandares'])
    @component('components.nav-link', ['icon' => 'fa fa-book','link'=>route('estandar-codificacion'),'title' => 'Codificaci¨®n'])
    @endcomponent
    @component('components.nav-link', [
        'icon' => 'fa fa-database',
        'link'=>route('estandar-basedatos'),
        'title' => 'Base de Datos'])
    @endcomponent
@endcomponent

@component('components.nav-link', [
    'link' =>route('resultadosAdmin'),
    'icon' => 'fa fa-line-chart',
    'title' => 'Resultados']) 
@endcomponent


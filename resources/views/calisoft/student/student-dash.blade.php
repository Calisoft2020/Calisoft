@can('create', 'App\Proyecto')
    @component('components.nav-link', [
        'icon' => 'fa fa-pencil-square',
        'title' => 'Registro Proyecto',
        'link' => route('proyectos'),
    ])
    @endcomponent
@endcan

@can('upload', 'App\Proyecto')
    @component('components.nav-dropdown', ['icon' => 'fa fa-book', 'title' => 'Documentos'])
        @component('components.nav-link', ['icon' => 'fa fa-book', 'link' => route('documentacion'), 'title' => 'Modelación'])
        @endcomponent

        @component('components.nav-link', ['icon' => 'fa fa-code', 'link' => route('documentosCodificacion'),'title' => 'Codificación'])
        @endcomponent

        @component('components.nav-link', ['icon' => 'fa fa-database', 'link' => route('documentosBd'),'title' => 'Base De Datos'])
        @endcomponent
    @endcomponent

    


    @component('components.nav-link', ['icon' => 'fa fa-database', 'link' => route('modelobd'), 'title' => 'Modelación Base de Datos'])
    @endcomponent
@endcan

@can('see_evaluations', 'App\Proyecto')
    @component('components.nav-dropdown', ['icon' => 'fa fa-check', 'title' => 'Evaluación'])

        @component('components.nav-link', [
            'icon' => 'fa fa-bar-chart-o', 
            'title' => 'Modelación',
            'link' => route('evalucion.modelacion')
        ])
        @endcomponent

        @component('components.nav-link', [
            'icon' => 'fa fa-cubes', 
            'title' => 'Plataforma',
            'link' => route('plataformaStudent')
        ]), 
        @endcomponent

        @component('components.nav-link', [
            'icon' => 'fa fa-database', 
            'title' => 'Base Datos',
            'link' => route('evaluacion.basedatos')
        ]), 
        @endcomponent

        @component('components.nav-link',[
            'icon'=> 'fa fa-code',
            'title' => 'Codificacion',
            'link' => route('evaluacion.codificacion')
        ]),
        @endcomponent

    @endcomponent
@endcan

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
@can('see_evaluations', 'App\Proyecto')
    @component('components.nav-link', [
        'icon' => 'fa fa-line-chart',
        'link' => route('resultados'),
        'title' => 'Resultados'])
    @endcomponent
@endcan





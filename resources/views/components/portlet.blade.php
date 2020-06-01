<div class="portlet portlet-sortable light bordered portlet-form">
    <div class="portlet-title">
        <div class="caption font-green">
            <i class=" {{ $icon }} font-green"></i>
            <span class="caption-subject bold uppercase"> {{ $title }} </span>
        </div>
        <div class="actions">
            @yield('actions')

            @if(isset($back))
                @component('components.porlet-action', [
                    'icon' => 'fa fa-undo',
                    'link' => url()->previous(),
                    'attributes' => "",
                    'title'=>'Volver',
                ])
                @endcomponent
            @endif

            @if(isset($pdf))
                @component('components.porlet-post-action', [ 
                    'title' => 'reporte',
                    'icon' => 'fa fa-file-pdf-o',
                    'id' => 'pdf-form',
                    'url' => $pdf
                ])
                @endcomponent
            @endif
            

            {{-- Boton de ayuda --}}
            @component('components.porlet-action', [
                'icon' => 'fa fa-question',
                'link' => '#ayuda',
                'attributes' => "data-toggle='modal'",
                'title'=>'Ayuda',
            ])
            @endcomponent

            <a class="btn btn-circle btn-icon-only btn-default fullscreen"  href="javascript:;"></a>
        </div>
    </div>
    <div class="portlet-body">
        {{ $slot }}
    </div>
</div>
<!-- empty sortable porlet required for each columns! -->
<div class="portlet portlet-sortable-empty"> </div>

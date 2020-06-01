<div class="page-sidebar-wrapper">
    {{-- BEGIN SIDEBAR --}}
    <div class="page-sidebar navbar-collapse collapse">

        {{-- BEGIN SIDEBAR MENU --}}
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
            @component('components.nav-link', [
                'icon' => 'icon-home',
                'title' => 'Home',
                'link' => Auth::user()->home()
            ])
            @endcomponent
            
        </ul>
        {{-- END SIDEBAR MENU --}}
    </div>
    {{-- END SIDEBAR --}}
</div>
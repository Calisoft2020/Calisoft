<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8"/>
    <title>{{ config( 'app.name' ) }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="{{ config( 'app.description' ) }}" name="description"/>
    <meta content="{{ config( 'app.author', 'Siaaf' ) }}" name="author"/>

    <meta content="{{ csrf_token() }}" name="csrf-token" />

    {{--  Pusher Config   --}}
    <meta name="pusher-key" content="{{ config('broadcasting.connections.pusher.key') }}">
    <meta name="pusher-cluster" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    
    
    @include('material.partials.head')

    {{-- BEGIN THEME LAYOUT STYLES --}}
    <link href="{{ asset('assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/layout2/css/custom.css') }}" rel="stylesheet" type="text/css" />
    {{-- END THEME LAYOUT STYLES --}}
</head>
{{-- END HEAD --}}
{{-- BEGIN BODY --}}
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md page-boxed page-sidebar-fixed">
    {{-- BEGIN HEADER --}}
        @include('material.partials.header')
    {{-- END HEADER --}}
    {{-- BEGIN HEADER & CONTENT DIVIDER --}}
        <div class="clearfix"> </div>
    {{-- END HEADER & CONTENT DIVIDER --}}
        <div class="">
            {{-- BEGIN PAGE CONTAINER --}}
            <div class="page-container">
                {{-- BEGIN SIDEBAR --}}
                <div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        {{-- BEGIN SIDEBAR MENU --}}
                        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
                            @component('components.nav-link', [
                                'icon' => 'icon-home',
                                'title' => 'Home',
                                'link' => '/'
                            ])
                            @endcomponent

                            {{-- Links --}}
                            @yield('links')

                        </ul>
                        {{-- END SIDEBAR MENU --}}

                    </div>
                    {{-- END SIDEBAR --}}
                </div>
                {{-- END SIDEBAR --}}
                {{-- BEGIN CONTENT --}}
                <div class="page-content-wrapper">
                    {{-- BEGIN CONTENT BODY --}}
                    <div class="page-content">
                        {{-- BEGIN PAGE HEADER --}}
                        {{-- BEGIN THEME PANEL --}}
                        {{--@ include('material.partials.theme-panel')--}}
                        {{-- END THEME PANEL --}}

                        {{-- BEGIN BREADCRUMB --}}
                        {{-- END BREADCRUMB --}}
                        {{-- END PAGE HEADER --}}
                        {{-- BEGIN CUSTOM CONTENT --}}
                        <div class="row" id="sortable_portlets">
                            @yield('content')
                        </div>
                        {{-- END CUSTOM CONTENT --}}
                    </div>
                    {{-- BEGIN CONTENT BODY --}}
                </div>
                {{-- END CONTENT --}}
                {{-- BEGIN QUICK SIDEBAR --}}
                {{-- @include('material.partials.quick-sidebar') --}}
                {{-- END QUICK SIDEBAR --}}
            </div>
            {{-- END PAGE CONTAINER --}}
            {{-- BEGIN FOOTER --}}
            @include('material.partials.footer')
            {{-- END FOOTER --}}
        </div>
    {{-- BEGIN SCRIPTS --}}
        @include('material.partials.dash-scripts')
    {{-- END SCRIPTS --}}
    {{-- BEGIN CUSTOM FUNCTIONS --}}
        
        @stack('functions')

    {{-- END CUSTOM FUNCTIONS --}}
</body>
{{-- END BODY --}}
</html>

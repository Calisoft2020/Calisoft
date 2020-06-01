<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <title>{{ config( 'app.name' ) }} @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="{{ config( 'app.description' ) }}" name="description"/>
    <meta content="{{ config( 'app.author', 'Siaaf' ) }}" name="author"/>
    <meta content="{{ csrf_token() }}" name="csrf-token"/>

    @include('material.partials.head')

    <link href="{{ asset('assets/pages/css/login-5.min.css') }}" rel="stylesheet" type="text/css" />

</head>
{{-- END HEAD --}}
{{-- BEGIN BODY --}}
<body>

    {{-- Body Content --}}
        <!-- BEGIN : LOGIN PAGE 5-1 -->
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-image:url({{ asset('assets/pages/img/login/bg1.jpg') }})">
                    <img class="login-logo" src="{{ asset('assets/pages/img/login/calisoft.png') }}" />
                </div>
            </div>
            <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                <!-- Login Content -->
                
                <div class="login-content">
                    @include('components.status')
                    <h1>{{ $title or config('app.name') }}</h1>
                    <p> {{ $description or config('app.description') }} </p>
                    @yield('content')
                </div>
                <!-- End Login Content -->
                <!-- Login Footer -->
                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-5 bs-reset">
                            <ul class="login-social">
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright © {{ $footer or config('app.author') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Login Footer -->

            </div>
        </div>
    </div>

    {{-- Core Scripts --}}
    @include('material.partials.scripts')

    {{-- Javascript Libraries --}}
    @stack('plugins')

    {{-- Javascript Functions --}}
    @stack('functions')

</body>
{{-- END BODY --}}
</html>

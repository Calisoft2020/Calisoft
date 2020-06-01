{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('layouts.master')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/pages/css/login-5.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta <title></title> de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Login')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
    <form action="{{ route('login') }}" id="form-login" role="form" method="post" novalidate>
        {{ csrf_field() }}
        <div class="form-body">
            <div class="row">
                <div class="col-xs-6">
                    @component('components.email', [
                        'name' => 'email',
                        'attributes' => "required autofocus",
                        'label' => 'Correo',
                        'help' => 'Digita el correo'
                    ])
                    @endcomponent
                </div>
                <div class="col-xs-6">
                    @component('components.password', [
                        'name' => 'password',
                        'attributes' => "required",
                        'label' => 'Contraseña',
                        'help' => 'Digita la contraseña'
                    ])
                    @endcomponent
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-6">
                <div class="rem-password">
                    @component('components.checkbox', [
                        'name' => 'remember',
                        'label' => 'Recordarme'
                    ])
                    @endcomponent

                    <div class="row text-danger text-center">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <input class="btn green" type="submit" value="Ingresar">
            </div>
            <div class="col-sm-12 text-right">
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}" class="forget-password">
                        ¿Ha olvidado su contraseña?
                    </a>
                    <br>
                    <a href="{{ route('register') }}" class="font-blue-dark">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </form>
    <!-- END : LOGIN PAGE 5-1 -->


@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/pages/scripts/login-5.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
@endpush

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
@push('functions')
    <script type="text/javascript">
        var rules = {
            email: { email: true, required: true },
        };
        var messages = { };
        var form = $('#form-forget');
        $(function() {
            FormValidationMd.init(form, rules, messages);
        });
    </script>
@endpush

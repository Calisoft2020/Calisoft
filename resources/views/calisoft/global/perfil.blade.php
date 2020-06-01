@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-user', 'title' => 'Perfil'])
        <div id="app" class="row">
            <div class="col-md-4">
                <div class="portlet light profile-sidebar-portle">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img alt="" class="img-responsive"
                            src="{{auth()->user()->foto ?: '/img/default.png' }}"/>

                      </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{auth()->user()->name}}  </div>
                        <div class="profile-usertitle-job"> {{auth()->user()->role}} </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-content">

                    <div class="portlet-title tabbable-line">

                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">Información Personal</a>
                            </li>
                            <li>
                                <a href="#tab_1_2" data-toggle="tab">Cambiar Foto</a>
                            </li>
                            <li>
                                <a href="#tab_1_3" data-toggle="tab">Cambiar Contraseña</a>
                            </li>


                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- PERSONAL INFO TAB -->
                            <div class="tab-pane active" id="tab_1_1">
                                <form action="{{route('perfil.update')}}" method="POST" >
                                    {{csrf_field()}}
                                   <input type="hidden" name="PK_id" value="{{ auth()->id() }}">

                                    @component('components.text', [
                                        'name' => 'name',
                                        'attributes' => "required pattern='[a-zA-ZáéíóúñÁÉÍÓÚ ]{2,50}'",
                                        'label' => 'Nombre',
                                        'help' => 'Cambiar el Nombre',
                                        'icon' => 'fa fa-user',
                                        'value'=> old('name') ?: auth()->user()->name,
                                    ])
                                    @endcomponent
                                     @component('components.email', [
                                    'name' => 'email',
                                    'attributes' => "required",
                                    'label' => 'Correo',
                                    'help' => 'Cambiar El Correo',
                                    'icon' => 'fa fa-envelope-o',
                                    'value'=> old('email') ?: auth()->user()->email,
                                    ])
                                    @endcomponent


                                        <div class="form-group">
                                        <button type="submit" class="btn blue center-block">Guardar Cambios</button>
                                        </div>


                                </form>
                                @if(session()->has('mensaje'))
                                <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <strong>{{session('mensaje')}}</strong>
                                </div>
                                @endif
                                @include('components.errors')
                              </div>

                            <!-- END PERSONAL INFO TAB -->
                            <!-- CHANGE AVATAR TAB -->
                            <div class="tab-pane" id="tab_1_2">

                                <form id="f_subir_imagen" name="f_subir_imagen" method="POST"  action="{{route('perfil.foto')}}" class="formarchivo" enctype="multipart/form-data">


                                    {{csrf_field()}}
                                    @component('components.fileinput-photo-profile',[
                                      'name'=>'foto',
                                      'attributes'=>'required',
                                      'title1' => 'Seleccione una imagen',
                                      'label1' => 'Cambiar',
                                      'label2' => 'Remover',
                                      'url' => auth()->user()->foto,
                                    ])
                                    @endcomponent

                                    <div class="margin-top-10">
                                        <button type="submit" class="btn red left-block">
                                        <i class="fa fa-refresh"></i>Actualizar foto
                                        </button>
                                        </div>

                                        @if(session()->has('mensaje'))
                                            <div class="alert alert-info alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>{{session('mensaje')}}</strong>
                                            </div>
                                        @endif
                                </form>


                            </div>
                            <!-- END CHANGE AVATAR TAB -->
                            <!-- CHANGE PASSWORD TAB -->
                            <div class="tab-pane" id="tab_1_3">
                                <form action="{{route('perfil.password')}}" method="POST">
                                  {{csrf_field()}}
                                    @component('components.password',[
                                      'name'=>'pass_actual',
                                      'attributes'=>"required pattern='[^=<> -]{5,30}'",
                                      'label' => 'Contraseña Actual',
                                      'help' => 'Digite Contraseña Actual',
                                      'icon' => 'fa fa-key',
                                    ])
                                    @endcomponent
                                    @component('components.password',[
                                      'name'=>'pass_new',
                                      'attributes'=>"required pattern='[^=<> -]{5,30}'",
                                      'label' => 'Contraseña Nueva',
                                      'help' => 'Digite Contraseña Nueva',
                                      'icon' => 'fa fa-key',
                                    ])
                                    @endcomponent
                                    @component('components.password',[
                                      'name'=>'pass_new_confirmation',
                                      'attributes'=>"required pattern='[^=<> -]{5,30}'",
                                      'label' => 'Confirmar Contraseña',
                                      'help' => 'Digite para Confirmar Contraseña',
                                      'icon' => 'fa fa-key',
                                    ])
                                    @endcomponent

                                    @if(session()->has('mensaje2'))
                                    <div class="alert alert-info alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>{{session('mensaje2')}}</strong>
                                    </div>
                                    @endif
                                    @if(session()->has('error'))
                                    <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong>{{session('error')}}</strong>
                                    </div>
                                    @endif
                                    <div class="margin-top-10">
                                        <button type="submit" class="btn green-jungle">
                                         <i class="fa fa-edit"></i>Editar Contraseña
                                        </button>
                                        <a href="javascript:;" class="btn default"> Cancelar </a>
                                    </div>
                                </form>
                            </div>
                            <!-- END CHANGE PASSWORD TAB -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('partials.modal-help-perfil')
    @endcomponent
    </div>
@endsection

@push('styles')
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
     <link href="/assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endpush

@push('functions')
    <script src="/assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="/js/bootstrap.js"></script>
@endpush

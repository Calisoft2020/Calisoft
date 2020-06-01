@extends('layouts.dash')

@section('content')

    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-university', 'title' => 'Peticiones'])
            <div id="app">
                <br>
                <div class="panel panel-primary">


                        <!-- BEGIN Portlet PORTLET-->


                            <div class="portlet box red-sunglo" v-for="peticion in peticiones">
                                <div class="portlet-title">
                                    <div class="caption" v-text="peticion.nombre">
                                        <i class="fa fa-gift"></i ></div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="" class="fullscreen"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="col-md-12">
                                        <div class="profile-sidebar" v-for="usuario in peticion.usuarios">
                                            <div class="portlet light profile-sidebar-portlet ">
                                                <!-- SIDEBAR USERPIC -->
                                                <div class="profile-userpic">
                                                <img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                                                <!-- END SIDEBAR USERPIC -->
                                                <!-- SIDEBAR USER TITLE -->
                                            <div class="profile-usertitle">
                                                <div class="profile-usertitle-name "  v-text="usuario.name" >  </div>
                                                <div class="profile-usertitle-job" v-text="usuario.email"> </div>
                                                <div class="profile-usertitle-job" v-text="usuario.role"> </div>

                                            </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                        </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-success">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" v-model="peticion.categoria.nombre" disabled>
                                                            <label for="form_control_1">Categoria</label>
                                                            <i class="fa fa-pie-chart"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" v-model="peticion.grupo_de_investigacion.nombre" disabled>
                                                            <label for="form_control_1">Grupo de investigación</label>
                                                            <i class="fa fa-gears"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-error">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" v-model="peticion.semillero.nombre" disabled>
                                                            <label for="form_control_1">Semillero</label>
                                                            <i class="fa fa-pagelines"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <div class="btn-group btn-group-vertical center-block">
                                    <button class="btn blue"  @click.prevent="asig(peticion)">Aceptar Propuesta</button>
                                   </div>



                            </div>
                            <!-- END Portlet PORTLET-->



                    </div>
            </div>



            <modal id="editar-proyecto" title="¿Está seguro de continuar?">
                <form @submit.prevent="update(fillPeticiones.PK_id)">

                    <button type="submit" class="btn blue"><i class="fa fa-check"></i>Aceptar</button>
                    <button type="button" class="btn red" data-dismiss="modal"><i class="fa fa-ban"></i>Cancelar</button>

                </form>
            </modal>


           </div>

        @endcomponent






</div>
@endsection

@push('styles')
    <link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />

@endpush

@push('functions')
    <script src="../assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
    <script src="/js/peticiones.js"></script>
@endpush



@push('plugins')
    <script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js" type="text/javascript"></script>
     <script src="../assets/pages/scripts/components-bootstrap-select-splitter.min.js" type="text/javascript"></script>

@endpush

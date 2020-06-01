@extends('layouts.dash')

@section('content')

    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-bell', 'title' => 'Notificaciones'])
            <div id="app">
                <div class="panel panel-primary">
                    <div class="portlet-body">
                        <div class="mt-element-list">
                            <div class="mt-list-container list-news ext-2">
                                <ul>
                                    <li class="mt-list-item" v-for="notificacion in notificaciones">

                                        <!--Rutas de las diferentes notificaciones-->                                                    
                                        <div class="list-icon-container">
                                            <a :href="notificacion.data.url">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                        
                                        <!--Fin de rutas de las diferentes notificaciones-->
                                        <!--Imagenes de perfil-->        
                                        <div class="list-thumb">
                                            <a href="javascript:;">
                                                <img class="img-circle" alt="" :src="notificacion.data.img" />
                                            </a>
                                        </div>
                                        
                                        
                                        <!--Fin imagenes de perfil-->    
                                        <!--Texto según notificación-->    
                                        <div class="list-datetime bold uppercase font-yellow-casablanca" v-text="notificacion.created_at"></div>
                                        <div class="list-item-content">
                                            <h3 class="uppercase bold">
                                                <strong v-text="notificacion.data.alert"></strong>
                                            </h3>
                                            <p v-if="notificacion.data.type === 'proyecto-creado'">
                                                Nueva propuesta de proyecto: <strong>@{{notificacion.data.proyecto}}</strong>
                                            </p>
                                            
                                            <p v-if="notificacion.data.type === 'proyecto-denegado'">
                                                Se eliminó el proyecto: <strong>@{{notificacion.data.proyecto}}</strong>. 
                                                Por la siguienre razón: <strong>@{{notificacion.data.text}}</strong> 
                                            </p>
                                            
                                            <p v-if="notificacion.data.type === 'invitacion-recibida'">
                                                <strong>@{{notificacion.data.user}}</strong> Ha sido invitado a ser parte del proyecto: 
                                                <strong>@{{notificacion.data.proyecto}}</strong>
                                            </p>
                                            
                                            <p v-if="notificacion.data.type === 'invitacion-rechazada'">
                                                <strong>@{{notificacion.data.user}}</strong> Ha rechazado la invitación del proyecto: 
                                                <strong>@{{notificacion.data.proyecto}}</strong>
                                            </p>                                                    
                                            <p v-if="notificacion.data.type === 'invitacion-aceptada'">
                                                <strong>@{{notificacion.data.user}}</strong> Ha aceptado la invitación al proyecto:
                                                <strong>@{{notificacion.data.proyecto}}</strong>
                                            </p>                                                  
                                            <p v-if="notificacion.data.type === 'proyecto-aceptado'">
                                                Se ha aceptado el proyecto: <strong>@{{notificacion.data.proyecto}} ¡Felicitaciones!</strong>
                                            </p>
                                            <p v-if="notificacion.data.type === 'evaluador-asignado'">
                                                Se ha asignado el evaluador: <strong>@{{notificacion.data.from}}</strong>
                                            </p>
                                            <p v-if="notificacion.data.type === 'proyecto-asignado'">
                                                Se ha asignado el proyecto: <strong>@{{notificacion.data.proyecto}}</strong>
                                            </p>
                                            <p v-if="notificacion.data.type === 'proyecto-evaluacion'">
                                                El proyecto <strong>@{{notificacion.data.proyecto}}</strong> 
                                                esta listo para ser evaluado
                                            </p>
                                            <p v-if="notificacion.data.type === 'caso-prueba-creado'">
                                                Se le ha añadido el caso prueba: <strong>@{{notificacion.data.caso}}</strong>, 
                                                al proyecto: <strong>@{{notificacion.data.proyecto}}</strong>. Por favor 
                                                continue a realizar la prueba correspondiente.
                                            </p>
                                            <p v-if="notificacion.data.type === 'caso-prueba-enviado'">
                                                <strong>@{{notificacion.data.estudiante}}</strong> ha enviado el caso prueba 
                                                <strong>@{{notificacion.data.caso}}</strong>, 
                                                del proyecto: <strong>@{{notificacion.data.proyecto}}</strong>. Por favor 
                                                proceda a realizar la evaluación.
                                            </p>
                                            <p v-if="notificacion.data.type === 'proyecto-completado'">
                                                La evaluación de su <strong>@{{notificacion.data.proyecto}}</strong> 
                                                a concluido. Por favor revise sus resultados y proceda a almacenar los informes.
                                            </p>
                                            <p v-if="notificacion.data.type === 'proyecto-activado'">
                                                Su proyecto <strong>@{{notificacion.data.proyecto}}</strong> 
                                                Cambió su estado a activado, por favor proceda a realizar las correciones necesarias 
                                                para su posterior envío.
                                            </p>
                                        </div>
                                        <!--Fin texto según notificación-->    
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="/js/notificaciones.js"></script>
@endpush



@push('plugins')
    <script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js" type="text/javascript"></script>
     <script src="../assets/pages/scripts/components-bootstrap-select-splitter.min.js" type="text/javascript"></script>

@endpush

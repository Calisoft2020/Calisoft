@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-files', 
            'title' => 'Plataforma: ' . $proyecto->nombre,
            'pdf' => route('pdf.plataforma', compact('proyecto'))
        ])

        <div id="app">

                {{-- Boton crear caso prueba --}}
                <button type="button" data-toggle="modal" data-target="#crear-caso" class="btn green-jungle center-block">
                    <i class="fa fa-plus"></i>
                    Crear Caso Prueba
                </button>
                <br> 
                
                <div class="panel panel-info" v-for="caso in casoPrueba">
                    <div class="panel-heading">
                        <h4 class="panel-header" style="display: inline">@{{ caso.nombre }}</h4>
                        <div class="btn-group pull-right">
                            <a data-toggle="collapse" :data-target="'#'+caso.PK_id" class="btn btn-xs btn-success">Detalles</a>
                          
                            <a v-if="caso.formulario !== ''" :href="'/proyectos/'+caso.FK_ProyectoId+'/plataforma/'+caso.PK_id"  class="btn btn-xs btn-primary">Calificar</a>
                            <a v-else class="btn btn-xs btn-danger" disabled>Calificar</a>
                            <a @click.prevent="destroy(caso)" class="btn btn-xs btn-danger" >Eliminar</a>
                        </div>
                    </div>
                    
                    <div :id="caso.PK_id" class="collapse panel-body">

                        <table class="table table-striped table-bordered table-hover" id="sample">
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: middle">Proposito:</td>
                                            <td style="vertical-align: middle">@{{ caso.proposito }} </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: middle">Alcance:</td>
                                            <td style="vertical-align: middle">@{{ caso.alcance }} </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: middle">Resultado Esperado:</td>
                                            <td style="vertical-align: middle">@{{ caso.resultado_esperado }} </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: middle">Criterios:</td>
                                            <td style="vertical-align: middle">@{{ caso.criterios }} </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: middle">Prioridad:</td>
                                            <td style="vertical-align: middle">@{{ caso.prioridad }} </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: middle">Estado:</td>
                                            <td style="vertical-align: middle">@{{ caso.estado }} </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: middle">Plazo:</td>
                                            <td style="vertical-align: middle">@{{ caso.limite }} </td>
                                        </tr>
                                        <tr v-if="caso.formulario !== ''">
                                            <td style="vertical-align: middle">Json subido:</td>
                                            <td style="vertical-align: middle">Total de Inputs: <span class="label label-sm label-danger circle">@{{ JSON.parse(caso.formulario).length }}</span> </td>
                                        </tr>
                                    </tbody>
                        </table>

                        <div v-if="caso.limite < dia && caso.formulario == ''">
                        <span  class="label label-sm label-danger"> El estudiante se ha pasado de la fecha límite para subir este caso prueba.</span>
                        
                        </div>
                        <div v-else>
                            <span v-if="caso.formulario == ''" class="label label-sm label-danger"> El estudiante no a subido el Caso Prueba </span>
                        </div>
                    </div>
                    
                </div>          

                <!--Modal crear caso prueba-->
                <modal id="crear-caso" title="Crear Caso Prueba">
                    <form @submit.prevent="store()" id="caso-create">
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea-input name="nombre" :error-messages="formErrors.nombre" v-model="newCasoPrueba.nombre" label="Nombre" maxlength="200" required></textarea-input>
                                <textarea-input name="proposito" :error-messages="formErrors.proposito" v-model="newCasoPrueba.proposito" label="Proposito" required></textarea-input>
                                <textarea-input name="alcance" :error-messages="formErrors.alcance" v-model="newCasoPrueba.alcance" label="Alcance" required></textarea-input>
                               
                            </div>  
                            <div class="col-sm-6">
                                
                                <textarea-input name="resultado_esperado" :error-messages="formErrors.descripcion" v-model="newCasoPrueba.resultado_esperado" label="Resultado esperado" maxlength="200" required></textarea-input>
                                <textarea-input name="criterios" :error-messages="formErrors.criterios" v-model="newCasoPrueba.criterios" label="Criterios" required></textarea-input>
                                <select-input v-model="newCasoPrueba.prioridad" name="prioridad" label="Prioridad" required>    
                                    <option value="alta">Alta</option>
                                    <option value="media">Media</option>
                                    <option value="baja">Baja</option>
                                </select-input>
                                
                                
                                    <label >Límite</label>
                                    <div >
                                        <input id="fecha" type="date" name="limite" v-model="newCasoPrueba.limite" class="form-control" required >    
                                        <!-- /input-group -->
                                    </div>
                                
                                
                            </div>
                            
                        </div>
                        

                        <div class="form-group modal-footer">
                            <button type="submit" class="btn green-jungle">
                                <i class="fa fa-plus"></i>Crear
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-ban"></i>Cancelar
                            </button>
                        </div>
                    </form>
                </modal>
                <!-- End modal crear usuarios-->
                
                
            </div>
        
            @include('partials.modal-help-evaluador-plataforma-caso-prueba')
        @endcomponent
    </div>
@endsection

@push('styles')  
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
@endpush

    
@push('functions')
    <script>
    

        var dt = new Date();
        // Validación de html para fechas limites.
        var m = dt.getMonth()+1;
        var d = dt.getDate();
        var y = dt.getFullYear();

        if (m<10 && d>=10){
            document.getElementById("fecha").min = y +'-0'+ m + '-' + d;
        }
        if(d<10 && m>=10){
            document.getElementById("fecha").min = y +'-'+ m + '-0' + d;
        }
        if(m<10 && d<10){
            document.getElementById("fecha").min = y +'-0'+ m + '-0' + d;
        }
        if(m>=10 && d>=10){
            document.getElementById("fecha").min = y +'-'+ m + '-' + d;
        }
        

    </script>

    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
            
    <script>window.proyectoId = {{ $proyecto->PK_id }};</script>
    <script src="/js/plataforma.js"></script>

    
@endpush
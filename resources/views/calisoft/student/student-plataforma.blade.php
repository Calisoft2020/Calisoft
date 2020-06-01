@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-files', 
            'title' => 'Plataforma: ' . $proyecto->nombre,
            'pdf' => route('pdf.plataforma', compact('proyecto'))
        ])
        <div id="app">
            <div class="portlet-body form">
                <div class="panel panel-info" v-for="caso in casoPrueba">
                    <div class="panel-heading">
                        <h4 class="panel-header" style="display: inline">@{{ caso.nombre }}</h4>
                        <div class="btn-group pull-right">
                            <button 
                                class="btn btn-xs btn-info" 
                                v-if="caso.pruebas && caso.pruebas.length" 
                                @click="selected = caso; showPruebas = true;">
                                Pruebas
                            </button>
                            <a data-toggle="collapse" :data-target="'#'+caso.PK_id" class="btn btn-xs btn-success">Detalles</a>
                        </div>
                    </div>
                    <div class="panel-collapse collapse" :id="caso.PK_id" >
                        
                        <tbl-caso :caso="caso"></tbl-caso>
                        
                        <div class="panel-body" v-if="caso.formulario == '' && caso.limite >= dia">
                            <div class="form-group">
                                <div class="row"> 
                                    <div class="col-sm-6">
                                        <textarea-input name="formulario" :error="formErrorsUpdate.formulario" 
                                                        v-model="fillCasoPrueba.formulario" label="Formulario" 
                                                        maxlength="20000" :id="'paste'+caso.PK_id" >
                                        </textarea-input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button @click.prevent="cadenaJson(fillCasoPrueba.formulario,caso)"  class="btn green-jungle">
                                            <i class="fa fa-message"></i>Siguiente
                                        </button>
                                    </div>
                                    
                                </div>   
                            </div>
                        </div>
                        
                        
                    </div>
                    <span v-if="caso.limite < dia && caso.formulario == ''" class="label label-sm label-danger"> Se ha pasado de la fecha límite para subir este caso prueba.</span>
                </div>          
            </div>
            
            <!--Modal de enviar caso prueba-->
            <modal v-model="enviarModalState" title="Enviar Caso Prueba" @hide="cerrarModalEnv()" :footer="false">
                <form @submit.prevent="update(fillCasoPrueba.PK_id)" class="formarchivo" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-sm-12">
                        <textarea-input name="observacion" :error-messages="formErrorsUpdate.observacion" 
                                        v-model="fillCasoPrueba.observacion" label="Observación (Opcional)" 
                                        maxlength="200">
                        </textarea-input>
                    </div>
                    <div class="row" v-for="(js, index) in json" v-if="json[0]">
                        <div class="col-sm-6">
                            <select id="tidoIn" :name="'t_' + js.name" class="form-control select2" v-model="fillCasoPrueba.testInput[index]" required>
                                <option v-for="tipos in tiposInputs" v-bind:value="tipos.PK_id"> @{{ tipos.nombre }}
                                </option>
                            </select>
                        </div>
                    <div class="col-sm-6">
                        <input type="button" class="btn red-mint btn-outline btn-block sbold uppercase" 
                                :value="'Nombre: '+ js.name + ' ID:' + js.id">
                    </div>             
                </div>
                <br>
                <button type="submit" class="btn green-jungle">
                    <i class="fa fa-message"></i>Subir Caso Prueba
                </button>
                </form>
            </modal>
            <!-- Fin Modal Enviar Casoprueba -->

            <!-- -->
            <modal :footer="false" :title="'Pruebas: ' + selected.nombre" v-model="showPruebas">
                <test-list :pruebas="selected.pruebas" v-if="selected && selected.pruebas"></test-list>
            </modal>
        </div>
    @endcomponent
</div>
@endsection

@push('styles')

@endpush
@push('functions')

    <script>window.proyectoId = {{ $proyecto->PK_id }};</script>
    <script src="/js/plataforma-student.js"></script>
  
@endpush
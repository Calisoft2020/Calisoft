@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
                'icon' => 'fa fa-book', 
                'title' => 'Documentos'
            ])


            <div id="app">
                
                {{--  Progreso de los documentos  --}}
                <document-progress :documentos="documentos" :tipos="tiposDocumentos"></document-progress>

                                   
                                

                {{--  Tabla de documentos  --}}
                <document-list :documentos="documentos" :tipos="tiposDocumentos">    
                    <template slot="buttons" scope="props">
                        <a title="editar" class="editar-categoria btn btn-warning btn-xs" @click.prevent="openEditModal(props.doc)">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>    
                        <a title="eliminar" class="editar-modal btn btn-danger btn-xs" @click.prevent="destroy(props.doc)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </template>
                </document-list>
         
                {{-- Boton de subir documento --}}
                <button type="button"  @click.prevent="modalState = true" class="btn blue center-block">
                    <i class="fa fa-plus"></i>
                    Subir Documento
                </button>             

                {{-- Creacion de documento   --}}
                <modal v-model="modalState" title="Subir documentación" :footer="false">
                    <form action="/api/documentacion" id="my-awesome-dropzone" method="post" class="dropzone">
                        {{ csrf_field() }}
                        
                        
                        {{--  Select Tipo Documento  --}}
                        
                            <div class="form-group">
                                <label>Tipo de documento</label>
                                <select name="FK_TipoDocumentoId" class="form-control" required>
                                    <option v-for="tiposDocumento in tiposDocumentos" v-bind:value="tiposDocumento.PK_id"> 
                                        @{{ tiposDocumento.nombre }}
                                    </option>
                                </select>
                            </div>
                       

                    </form>
                </modal>
                
                {{-- Modal de Edicion --}}
                <modal v-model="editModalState" title="Editar documentación" :footer="false">
                    <form @submit.prevent="update(fillDocumentos.PK_id)">
        
        
                        <div class="form-group" >
                            <h3 v-text="fillDocumentos.url"></h3>
                            <label class="control-label">Tipo de documento</label>
                            <select id="tidocu" name="FK_TipoDocumentoId" class="form-control select2" v-model="fillDocumentos.FK_TipoDocumentoId" required>
                                <option v-for="tiposDocumento in tiposDocumentos" v-bind:value="tiposDocumento.PK_id"> @{{ tiposDocumento.nombre }}
                                </option>
                            </select>
                            <span v-if="formErrorsUpdate['FK_TipoDocumentoId']" class="error text-danger">
                                @{{formErrorsUpdate.FK_TipoDocumentoId[0]}}
                            </span>
                            <input hidden type="text" name="url" v-model="fillDocumentos.url" required>
                            <span v-if="formErrorsUpdate['url']" class="error text-danger">
                                @{{formErrorsUpdate.url[0]}}
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn blue"><i class="fa fa-plus"></i>Modificar Documento</button>
                            <button type="button" class="btn red" @click="editModalState = false">
                                <i class="fa fa-ban"></i>
                                Cancelar
                            </button>
                        </div>
                
        
        
                    </form>
                </modal>
            </div>
            @include('partials.modal-help-subir-modelado')
        @endcomponent
    </div>
@endsection

@push('styles')

    <link href="../assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />

@endpush

@push('functions')
    <script src="/assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>
    <script src="/js/documentos.js"></script>
@endpush
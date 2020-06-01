@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-code', 'title' => 'Documentos de Codificación'])
            <div id="app">
            <div class="row">


                    <div class="col-sm-4 col-xs-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-xs-4">Mostrar</label>
                                <div class="col-xs-4 col-sm-5">
                                    <select  class="form-control" v-model="paginator.show">     
                                        <option value="5">5</option>
                                        <option value="10" selected>10</option>
                                        <option value="15">15</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="col-sm-offset-4 col-sm-4 col-xs-12" style="margin-bottom: 2%">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar" v-model="search">
                        <span class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                        </span>
                    </div>

                </div>
            </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                        <thead>
                            <th class="text-center">Nombre Del Archivo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Operaciones</th>
                        </thead>
                        <tbody >
                            <tr v-for="script in paginator.items" class="text-center">
                                <td v-text="script.url"></td>
                                <td v-text="script.estado"></td>
                                <td class="text-center">
                                    <button class="btn btn-primary" title="Vista Pervia" @click="preview(script)" >
                                        <span class="fa fa-eye"></span>
                                    </button>

                                    <button class="btn red" title="Eliminar documento" @click.prevent="openDeleteModal(script)">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">

                    <!-- Boton de crear usuario -->
                    <div class="col-sm-6">
                        <button type="button" @click.prevent="modalState = true" class="btn green-jungle center-block">
                            <i class="fa fa-plus"></i>
                            Subir Documentos
                        </button>
                    </div>
                    <!-- Pagination Buttons-->
                    <div class="col-sm-6 text-right" v-show="paginator.lastPage > 1">
                        <pagination v-model="paginator.page" :total-page="paginator.lastPage" boundary-links></pagination>
                    </div>
                    <!-- End Pagination Buttons-->
                </div>

                <modal v-model="modalState" title="Subir documentación De Codificación" @hide="refresh()" :footer="false">
                    <form action="/api/scripts" id="my-awesome-dropzone" method="post" class="dropzone">
                        {{ csrf_field() }}
                    </form>
                </modal>

                {{--  Modal de vista previa  --}}
                <modal v-model="prevModal" :title="prevScript.url" :footer="false" size="lg">
                        <codemirror :code="prevScript.code" :options="codeOptions"></codemirror>
                </modal>

                <!-- inicio modal eliminar-->
        <modal v-model="deleteModalState" title="Eliminar script">
            ¿Desea eliminar el script <strong>@{{elimiScript.url}}</strong>?

                    <div class="modal-footer" slot="footer">
                        <button class="btn green-jungle" @click="destroy(elimiScript)">
                            <i class="fa fa-edit"></i>Eliminar Script
                        </button>
                        <button type="button" class="btn red" @click.prevent="closeDeleteModal()">
                            <i class="fa fa-ban"></i>Cancelar
                        </button>
                    </div>
                </modal>
                <!-- Fin Modal Eliminar -->

            </div>
            @include('partials.modal-help-subir-codificacion')
        @endcomponent
    </div>
@endsection

@push('styles')
<link href="../assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('functions')
<script src="/js/scripts-codificacion.js"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>

<script>
        Dropzone.options.myAwesomeDropzone = {
            uploadMultiple: false,
            maxFilezise: 250,
            maxFiles: 20,
            acceptedFiles: '.php',
            addRemoveLinks: true,
            dictRemoveFile: "Retirar archivo",
            success: function(a) {
                toastr.info('Documento subido correctamente');
                return a.previewElement ? a.previewElement.classList.add("dz-success") : void 0
            },

        };
    </script>

@endpush

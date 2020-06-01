@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-database', 'title' => 'Documento de Base de Datos'])
            <div id="app">
            {{--tabla de sql--}}
            <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                        <thead>
                            <th class="text-center">Nombre Del Archivo</th>
                            <th class="text-center">Base de Datos</th>
                            <th class="text-center">Operaciones</th>
                        </thead>
                        <tbody >
                            <tr v-for="sql in sqls"class="text-center">
                                <td v-text="sql.url"></td>
                                <td v-text="sql.tipobd.nombre"></td>
                                <td  class="text-center">
                                    <button class="btn btn-primary " title="Vista Previa" @click="preview(sql)">
                                        <span class="fa fa-eye"></span>
                                    </button>
                                    <button class="editar-modal btn red " title="Eliminar documento" @click.prevent="openDeleteModal(sql)">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>                                    
                                </td>
                            </tr>    
                        </tbody>
                    </table>
                </div>
            {{--fin tabla de sql--}}
            {{--Boton subir archivo sql--}}
            <div  v-if="sqls.length == 0">
                <button type="button" @click.prevent="modalState = true"  class="btn blue center-block">
                    <i class="fa fa-plus"></i>
                        Subir Documento
                </button>
            </div>

            {{--modal dropzone cargar archivo sql--}}
            <modal  v-model="modalState" title="Subir Archivo Sql" @hide="refresh()" :footer="false">
                <form action="/api/sql" id="my-awesome-dropzone" method="post" class="dropzone">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Tipo de documento</label>
                            <select id="tidocu" name="FK_TipoBdId" class="form-control select2" required>
                                <option value="">Escoja Base de Datos</option>
                                <option value="1">MySql</option>
                                <option value="2">PostgreSql</option>
                            <select>
                    </div>
                </form>
            </modal>
            {{--fin modal dropzone--}}
            {{--Inicio modal eliminar archivo sql--}}
            <modal v-model="deleteModalState" title="Eliminar Archivo Sql">
                ¿Desea eliminar el archivo sql <strong>@{{eliminarSql.url}}</strong>?
                <div class="modal-footer" slot="footer">
                    <button class="btn green-jungle" @click="destroy(eliminarSql)">
                        <i class="fa fa-edit"></i>Eliminar
                    </button>
                    <button type="button" class="btn red" @click.prevent="closeDeleteModal()">
                        <i class="fa fa-ban"></i>Cancelar
                    </button>
                </div>
            </modal>
            {{--Fin modal eliminar archivo sql --}}
            {{--  Modal de vista previa  --}}
                <modal v-model="prevModal" :title="prevSql.url" :footer="false" size="lg">
                    <codemirror :code="prevSql.code" :options="codeOptions"></codemirror>
                </modal>
            </div>
            @include('partials.modal-help-subir-sql')
        @endcomponent
    </div>
@endsection

@push('styles')
<link href="../assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('functions')
<script src="/js/archivo-sql.js"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>

<script>
        Dropzone.options.myAwesomeDropzone = {
            uploadMultiple: false,
            maxFilezise: 1000,
            maxFiles: 1,
            acceptedFiles: '.sql',
            addRemoveLinks: true,
            dictRemoveFile: "Retirar archivo",
            success: function(a) {
                toastr.info('Documento subido correctamente');
                return a.previewElement ? a.previewElement.classList.add("dz-success") : void 0
            },
            
        };
    </script>

@endpush
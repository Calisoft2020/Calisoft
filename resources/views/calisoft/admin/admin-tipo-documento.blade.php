@extends('layouts.dash') @section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-book', 'title' => 'Documentos'])
    <div id="app">

        {{-- List Group --}}
        <div class="list-group">

            {{-- List Group TipoDocumento Form --}}
            <div class="list-group-item list-group-item-warning">
                <form class="form-inline" @submit.prevent="store()">
                    <div class="input-group">
                        <span class="input-group-addon">Nombre</span>
                        <input type="text" name="nombre" class="form-control" v-model="tdocForm.nombre" pattern="[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <bs-switch id="required" label="requerido" v-model="tdocForm.required">
                        </bs-switch>
                    </div>
                    <div class="form-group pull-right">
                        <button class="btn btn-md yellow-gold" type="submit">
                                <span class="fa fa-plus"></span> Agregar
                            </button>
                    </div>
                </form>
            </div>

            {{-- List Group Items --}}
            <template v-for="tdoc in tdocumentos">

                    {{-- List Group Item --}}
                    <template v-if="tdoc.PK_id != tdocEdit.PK_id">
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading" style="display: inline">
                                @{{ tdoc.nombre }}
                                <span class="label label-primary" v-if="tdoc.required">requerido</span>
                            </h4>

                            {{-- List Group Item Actions --}}
                            <div class="btn-group pull-right">
                                <a :href="`tdocumentos/${tdoc.PK_id}/componentes`" class="btn blue btn-xs" title="Agregar Componentes">
                                    componentes
                                </a>
                                <button type="button" class="btn btn-xs" title="Editar Documento" @click="selectEdit(tdoc)">

                                    editar
                                </button>
                                <button type="button" class="btn red btn-xs" title="Eliminar Documento" @click="selectDelete(tdoc)">
                                  Eliminar
                                </button>
                            </div>
                        </div>
                    </template> {{-- Edit List Group Item --}}
            <template v-else>
                        <div class="list-group-item list-group-item-info">
                            <form class="form-inline" @submit.prevent="update()">
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre</span>
                                    <input type="text" name="nombre" class="form-control"
                                        v-model="tdocEdit.nombre" pattern="[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}" required maxlength="50">
                                </div>
                                <div class="form-group">
                                    <bs-switch id="edit-required" label="requerido" v-model="tdocEdit.required">
                                    </bs-switch>
                                </div>
                                <div class="form-group pull-right">
                                    <button class="btn btn-md blue" type="submit">
                                        <span class="fa fa-save"></span> Guardar
                                    </button>
                                    <button class="btn btn-md default" @click.prevent="tdocEdit = {}">
                                      <i class="fa fa-ban"></i>
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </template>

            </template>
        </div>

        {{-- Modal de elminar tipo de documento --}}
        <modal id="destroy-tdoc" title="Eliminar tipo de documento">
            <p>
                ¿Está seguro de elminar el tipo de documento <strong>@{{ tdocDel.nombre }}</strong>? Esta accion eliminara todos los componentes asociados al documento.
            </p>

            <div class="modal-footer" slot="footer">
                <button class="btn red" @click="destroy()">  <i class="glyphicon glyphicon-trash"></i>Eliminar</button>
                <button class="btn default" data-dismiss="modal"><i class="fa fa-ban"></i>Cancelar</button>
            </div>
        </modal>
        @include('partials.modal-help-tipo-documento')
    </div>
    @endcomponent
</div>
@endsection @push('functions')
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/js/tipo-documento.js"></script>
@endpush @push('styles')
<link rel="stylesheet" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css"> @endpush
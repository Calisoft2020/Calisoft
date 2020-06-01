@extends('layouts.dash') @section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-pie-chart', 'title' => 'Categorias'])

    <div id="app">

        <!-- Table de categorias -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                <thead>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Plataforma</th>
                    <th class="text-center">Modelado</th>
                    <th class="text-center">Base de datos</th>
                    <th class="text-center">Codificación</th>

                    <th class="text-center">Operaciones</th>
                </thead>
                <tbody>
                    <tr v-for="categoria in categorias" class="text-center">
                        <td v-text="categoria.nombre"></td>
                        <td v-text="categoria.plataforma"></td>
                        <td v-text="categoria.modelado"></td>
                        <td v-text="categoria.base_datos"></td>
                        <td v-text="categoria.codificacion"></td>


                        <td class="text-center">
                            <popover title="Descripción" placement="bottom">
                                <button type="button" class="btn btn-default btn-xs" data-role="trigger" title="Descripción">
                            <span class="fa fa-map-o"></span>
                            </button>
                                <div slot="popover">
                                    @{{categoria.descripcion}}
                                </div>
                            </popover>

                            <button class="editar-categoria btn blue btn-xs" title="Editar Categoria" @click.prevent="openEditModal(categoria)">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>


                            <button class="editar-modal btn red btn-xs" title="Eliminar Categoria" @click.prevent="openDeleteModal(categoria)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed">

                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Tabla de Categorias -->
            <button type="button" data-toggle="modal" data-target="#crear-categoria" class="btn green-jungle center-block">
                    <i class="fa fa-plus"></i>
                    Crear Nueva Categoría
                </button>
        </div>

        <!--Modal de creacion de categoria -->
        <modal id="crear-categoria" title="Crear Categoria">
            <form @submit.prevent="store()">
                <text-input name="nombre" :error="formErrors.nombre" v-model="newCategoria.nombre" label="Nombre de la Categoría" icon="fa fa-pie-chart" required></text-input>
                <!-- Fila De Porcentajes -->
                <div class="row">
                    <text-input type="number" name="plataforma" :error="formErrors.plataforma" v-model="newCategoria.plataforma" label="Evaluación de plataforma" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                    <text-input type="number" name="modelado" :error="formErrors.modelado" v-model="newCategoria.modelado" label="Evaluación de modelado" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                </div>

                <div class="row">
                    <text-input type="number" name="base_datos" :error="formErrors.base_datos" v-model="newCategoria.base_datos" label="Evaluación de Base de datos" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                    <text-input type="number" name="codificacion" :error="formErrors.codificacion" v-model="newCategoria.codificacion" label="Evaluación de Codificación" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                </div>

                <textarea-input name="descripcion" :error="formErrors.descripcion" v-model="newCategoria.descripcion" label="Descripción" maxlength="200" required></textarea-input>

                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn green-jungle"><i class="fa fa-plus"></i>Crear Categoría</button>
                        <button type="button" class="btn red" data-dismiss="modal">
                            <i class="fa fa-ban"></i>
                            Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </modal>
        <!-- Fin Modal de creacion de categoria -->

        <!--Comienzo Modal de edicion -->
        <modal id="editar-categoria" title="Editar Categoria">
            <form @submit.prevent="update(fillCategoria.PK_id)">
                <text-input name="nombre" :error="formErrorsUpdate.nombre" v-model="fillCategoria.nombre" label="Nombre de la Categoría" icon="fa fa-pie-chart" required></text-input>
                <div class="row">
                    <text-input type="number" name="plataforma" :error="formErrorsUpdate.plataforma" v-model="fillCategoria.plataforma" label="Evaluación de plataforma" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                    <text-input type="number" name="modelado" :error="formErrorsUpdate.modelado" v-model="fillCategoria.modelado" label="Evaluación de modelado" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                </div>
                <div class="row">
                    <text-input type="number" name="base_datos" :error="formErrorsUpdate.base_datos" v-model="fillCategoria.base_datos" label="Evaluación de Base de datos" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                    <text-input type="number" name="codificacion" :error="formErrorsUpdate.codificacion" v-model="fillCategoria.codificacion" label="Evaluación de Codificación" icon="fa fa-percent" min="0" max="100" required>
                    </text-input>
                </div>

                <textarea-input name="descripcion" :error="formErrorsUpdate.descripcion" v-model="fillCategoria.descripcion" label="Descripción" maxlength="200" required></textarea-input>

                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn green-jungle">
                            <i class="fa fa-edit"></i>Editar Categoría
                        </button>
                        <button type="button" class="btn red" data-dismiss="modal">
                            <i class="fa fa-ban"></i>Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </modal>
        <!-- Fin de Modal de edicion -->

        <!-- inicio modal eliminar-->
        <modal id="eliminar-categoria" title="Eliminar Categoria">
            ¿Desea eliminar la categoría @{{elimiCategoria.nombre}}?

            <div class="modal-footer" slot="footer">
                <button class="btn green-jungle" @click="destroy(elimiCategoria)">
                    <i class="fa fa-edit"></i>Eliminar Categoria
                </button>
                <button type="button" class="btn red" data-dismiss="modal">
                    <i class="fa fa-ban"></i>Cancelar
                </button>
            </div>
        </modal>
        <!-- Fin Modal Eliminar -->

        @include('partials.modal-help-categoria')

    </div>

</div>

@endcomponent

</div>

@endsection 
@push('styles')
<link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
<link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" /> @endpush 
@push('functions')
<script src="/js/categorias.js"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
@endpush
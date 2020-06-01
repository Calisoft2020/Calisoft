@extends('layouts.dash') 

@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' =>
        'fa fa-cubes',
        'title' => 'Componentes de ' . $tdocumento->nombre])
        
        <div id="app">

            <!-- Table de categorias -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Obligatorio</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Operaciones</th>
                    </thead>
                    <tbody>
                        <tr v-for="componente in componentes" class="text-center">
                            <td v-text="componente.nombre"></td>
                            <td v-text="componente.required ? 'SI' : 'NO'"></td>
                            <td v-text="componente.descripcion"></td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-md blue" title="Editar Componente" @click.prevent="openEditModal(componente)">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button class="btn red btn" title="Eliminar Componente" @click.prevent="destroy(componente)">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" data-toggle="modal" data-target="#crear-componente" class="btn green-jungle center-block">
                <i class="fa fa-plus"></i>
                Crear Nuevo Componente
            </button>


            <!--Comienzo Modal de creación -->
            <modal id="crear-componente" title="Crear Componentes">
                <component-form id="createF" ref="createForm" @submit="store"></component-form>
            </modal>
            <!-- Fin de Modal de creación -->

            <!--Comienzo Modal de edicion -->
            <modal id="editar-componentes" title="Editar Componente">
                <section v-if="fillComponente">
                    <component-form id="editF" ref="editForm" @submit="update" :editable="fillComponente">
                    </component-form>
                </section>
            </modal>


            <!-- Fin de Modal de edicion -->
              @include('partials.modal-help-componentes')
          </div>
            @endcomponent
         </div>
        </div>


@endsection @push('styles')
<link rel="stylesheet" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css"> @endpush

@push('functions')
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script>
    window.documentId = {{ $tdocumento ->PK_id }};

</script>
<script src="/js/componentes.js"></script>
@endpush

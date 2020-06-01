@extends('layouts.dash')
@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-database', 'title' => 'Base de Datos'])
      <div id="app">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <th class="text-center">Componente</th>
                    <th class="text-center">Estandar</th>
                    <th class="text-center">Nomenclatura</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Operación</th>
                </thead>
                <tbody>
                    <tr v-for="componente in componentes" class="text-center">
                        <td v-text="componente.nombre"></td>
                        <td v-text="componente.estandar"></td>
                        <td v-text="componente.nomenclatura"></td>
                        <td v-text="componente.valor"></td>
                        <td>
                            <button class="editar-componente btn blue" title="Editar Componentes" @click.prevent="openEditModal(componente)">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--inicio modal editar estandar y valor de la nomenclatura de base de datos-->
            <modal id="editar-componente" :title="'Editar Componente: ' + fillNomenclatura.nombre">
                <form @submit.prevent="update(fillNomenclatura.PK_id)">
                    
                    <text-input name="estandar" label="Estandar" icon="fa fa-user" 
                        :error-messages="errorsUpdate.estandar" v-model="fillNomenclatura.estandar" 
                        required maxlength="5">
                    </text-input>              
                        
                    <text-input type="number" name="valor" label="Valor" icon="fa fa-sort-numeric-asc" 
                        :error-messages="errorsUpdate.valor" v-model="fillNomenclatura.valor" 
                        min="1" max="5" required>
                    </text-input>
                       
                    
                    
                    <button type="submit" class="btn green-jungle center-block">
                        <i class="fa fa-edit"></i>Editar Componente
                    </button>
                            
                </form>
            </modal>
            <!--Fin Modal editar estandar y valor de la nomenclatura de base de datos-->
        </div>
      </div>
      @include('partials.modal-help-base-datos')
    @endcomponent
</div>
@endsection

@push('functions')
<script src="js/tipo-nomenclatura.js"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
@endpush

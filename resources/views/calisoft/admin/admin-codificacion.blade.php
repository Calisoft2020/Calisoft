@extends('layouts.dash')
@section('content')
<div class="col-md-12">
    @component('components.portlet', [
        'icon' => 'fa fa-code', 
        'title' => 'Codificación',
        'pdf' => route('pdf.codificacion')
    ])
      <div id="app">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <th class="text-center">Items</th>
                    <th class="text-center">Prioridad</th>
                    <th class="text-center">Operación</th>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="item in items">
                        <td v-text="item.item"></td>
                        <td v-text="item.valor"></td>
                        
                        <td>
                            <button class="editar-item btn blue" title="editar codificacion" @click.prevent="openEditModal(item)">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <modal id="editar-item" :title="'Editar item: ' + fillItem.item">
            
            <form @submit.prevent="update(fillItem.PK_id)">
                <text-input type="number" name="Valor" label="Valor" icon="fa fa-sort-numeric-asc"
                    :error-messages="formErrorsUpdate.valor" v-model="fillItem.valor" 
                    min="1" max="5" required></text-input>

                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn green-jungle">
                            <i class="fa fa-edit"></i>Editar Item
                        </button>
                        <button type="button" class="btn red" data-dismiss="modal">
                            <i class="fa fa-ban"></i>Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </modal>
        </div>
      </div>
      @include('partials.modal-help-admin-codificacion')
    @endcomponent
</div>
@endsection

@push('functions')
<script src="js/items-codificacion.js"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
@endpush

@extends('layouts.dash')

@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-folder-open', 'title' => 'Proyectos'])
    <div id="app">

        <div class="row">
        
            <div class="col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 2%">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" v-model="search">
                    <span class="input-group-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    </span>
                </div>
            </div>

          <div class="form-group col-md-3 col-sm-3 col-xs-12">
            <bs-select id="estado" title="Estado" v-model="estado">
              <option value>Todos</option>
              <option value="activo">Activo</option>
              <option value="propuesta">Propuesta</option>
            </bs-select>
          </div>

        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="list-group">
                    
                        <a v-for="proyecto in paginator.items" class="list-group-item" :key="proyecto.PK_id"
                            
                            :class="{ 'bg-grey': seleccion == proyecto }"
                            @click.prevent="seleccion = {}; seleccion = proyecto">

                            @{{proyecto.nombre}}

                            <span title="propuesta" class="badge" v-if="proyecto.state == 'propuesta'">
                                P
                            </span>
                        </a>
                    
                </div>

                <div class="text-center" v-show="paginator.lastPage > 1">
                    <pagination v-model="paginator.page" :total-page="paginator.lastPage" ></pagination>
                </div>

            </div>
            
            
            <div class="col-sm-6" >
                <fade mode="out-in">
                    <proyecto-tabla v-if="seleccion.PK_id" :key="seleccion.PK_id" 
                        :proyecto="seleccion" @updated="update" @removed="remove"/>
                </fade>
            </div>
            
        </div>

        @include('partials.modal-help-proyecto')
    </div>
    @endcomponent
  </div>

@endsection
@push('styles')

<link rel="stylesheet" href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css">
<link rel="stylesheet" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
@endpush

@push('functions')

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/js/admin-proyectos.js"></script>
@endpush

@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', ['icon' => 'fa fa-home', 'title' => 'Invitaciones'])
          <div id="app" class="row">

            <p class="text-center" v-if="accepted.nombre">
                Ha aceptado la invitación del proyecto
                <strong>@{{accepted.nombre}}.</strong><br>
                Ya puedes ver el proyecto <a href="{{ route('home') }}">Aqui.</a>
            </p>

            <ul class="list-group col-xs-10 col-xs-offset-1" v-else>
              <li class="list-group-item" v-for="proyecto in invitaciones">
                <div class="row">
                  <div class="col-md-8 col-xs-12 text-center">
                    El proyecto <strong>@{{ proyecto.nombre }}</strong>, a enviado una solicitud,
                    para que haga parte del equipo de trabajo. 
                  </div>
                  <div class="col-md-4 col-xs-12 text-center">
                      <button class="btn blue" @click="accept(proyecto)">Aceptar</button>
                      <button class="btn" @click="reject(proyecto)">Rechazar</button>
                  </div>
                </div>
              </li>
            </ul>

          </div>
        @endcomponent
    </div>

@endsection

@push('functions')
  <script src="/js/invitaciones.js"></script>
@endpush

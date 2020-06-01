@extends('layouts.dash') 
@section('content')
<div class="col-md-12">
@component('components.portlet', ['icon' => 'fa fa-user', 'title' => 'Perfil'])
    @include('partials.perfil')
  @endcomponent

</div>

@endsection

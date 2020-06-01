@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-files-o', 
            'title' => 'Nomenclatura: ' . $proyecto->nombre,
            'pdf' => route('pdf.basedatos', compact('proyecto'))
        ])
            <div id="app">
                <div class="row">
                    <div class="col-md-6">
                        <h5><center><strong>Codigo SQL</strong></center></h5>
                        <code-preview url="{{$proyecto->sql->url}}" prefix="/api/sql/preview/" mode="text/x-sql"></code-preview>                  
                    </div>
                    <div class="col-md-6">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn green-jungle center-block" data-toggle="modal" data-target="#ModalSeguro">Calificación Automática <i class="fa fa-arrow-circle-right"></i></button>
                        <br>
                        <h5><center><strong>Información</strong></center></h5>
                        <tabla-componente :read="false"></tabla-componente>  
                        <form method="POST" action="{{route('observacion-bd',['sql'=>$proyecto->sql->PK_id])}}">
                            {{csrf_field()}}               
                                    @component('components.textarea',[
                                        'name'=>'observacion',
                                        'attributes'=>'required',
                                        'label'=>'Comentario',
                                        'value'=>$proyecto->sql->observacion,
                                    ])
                                    @endcomponent
                            <button type="submit"  class="btn green-jungle center-block">
                            <i class="fa fa-edit"></i> Aceptar Calificación</button>
                        </form>   
                                             
                    </div>

                    <!-- Modal -->
                    <div id="ModalSeguro" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
                            <div class="modal-dialog modal-lg" >

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title" align="center"><b>¡Advertencia!</b> </h4>
                                    
                                </div>
                                <div class="modal-body" >
                                <h4 class="modal-title" align="center"> <b>¿Está seguro de calificar la nomenclatura SQL de la base de datos del proyecto: "{{$proyecto->nombre}}"?</b></h4>
                                </div>
                                
                                <div class="modal-footer">
                                    <a href="/proyectos/{{$proyecto->PK_id}}/sql"><button type="button"  class="btn green-jungle center-block">
                                        <i class="fa fa-arrow-circle-right"></i>
                                        ¡Calificar!
                                    </button></a> 

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>  
                                </div>
                            </div>

                    </div>
                    </div>

                </div>
                @include('partials.modal-help-calificar-bd')
            </div>                
        @endcomponent  
    </div>
@endsection
@push('functions')
    <script>window.archivoId = "{{ $proyecto->sql->PK_id }}"</script>
    <script src="/assets/global/plugins/jquery.media.js"></script>
    <script src="/js/base-datos.js"></script>
@endpush
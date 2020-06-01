@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
                'icon' => 'fa fa-book', 
                'title' => 'Documentos'
            ])


            <div id="app">
                <form >
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="nombre persona" id="1" pattern="[a-zA-ZáéíóúñÁÉÍÓÚ ]{2,50}" required>
                                <input type="text" name="texto normal" id="nom" pattern="[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}" required>
                                <input type="email" name="email" id="otro" required >
                            </div>  
                            <div class="col-sm-6">
                                <input type="tel" name="telefono" id="6" pattern="[0-9 .+]{6,30}" required>
                                <input type="number" name="numero" id="desp" pattern="[0-9]{1,100}" required>
                                <input type="url" name="url" id="alas" required>
                            </div>
                            <div class="col-sm-12">
                                
                                <input type="password" name="pass" id="vega" pattern="[^=<> -]{5,30}" required>
                            </div>

                            
                        </div>
                        

                        <div class="form-group modal-footer">
                            <button type="submit" class="btn green-jungle">
                                <i class="fa fa-plus"></i>Crear
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-ban"></i>Cancelar
                            </button>
                        </div>
                    </form>
                
            </div>
           
        @endcomponent
    </div>
@endsection

@push('styles')

    <link href="../assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />

@endpush

@push('functions')
    <script src="/assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>
    <script src="/js/documentos.js"></script>
@endpush
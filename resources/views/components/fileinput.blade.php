
{{-- fileinput
    ** args
    icon -> Icono del desplegable
    title1 -> Titulo del desplegable
    title2 -> Titulo del componente
    nombre -> nombre del imput
    atributo -> atributo del input
--}}



<div class="form-group">
    <label class="control-label col-md-3">{{ $title1 }}</label>
        <div class="col-md-3">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="input-group input-large">
                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                        <i class="{{ $icon }}"></i>&nbsp;
                            <span class="fileinput-filename"> </span>
                    </div>
                    <span class="input-group-addon btn default btn-file">
                        <span class="fileinput-new"> {{ $title2 }} </span>
                        <span class="fileinput-exists"> Cambiar </span>
                        <input type="file" name="{{ $nombre }}" {{ $atributo }} > 
                    </span>
                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="ayuda">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ayuda Modulo Proyectos</h5>
      </div>
      <div class="modal-body">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#0E3D38;">
              <h4 class="panel-title" >
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                  <label class="font-white">Tipos de Categorias</label>
                </a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
              <div class="panel-body">
                <dl>
                  @foreach ($categorias as $categoria)
                    <dt>
                      <li>{{$categoria->nombre}}</li>
                    </dt>
                    <dd>{{$categoria->descripcion}}</dd>
                  @endforeach
                </dl>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#0E3D38;">
              <h4 class="panel-title" >
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                  <label class="font-white">Funciones Modulo Registro Proyecto</label>
                </a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
              <div class="panel-body">
                <ul>
                  <li>Ingresar nombre del proyecto a evaluar.</li>
                  <li>Elegir categoria a la que pertenece el Proyecto.</li>
                  <li>Elegir semillero al que pertence el Proyecto.</li>
                  <li>Elegir grupo de investigacion al que pertence el Proyecto.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="modal-footer" slot="footer">
          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

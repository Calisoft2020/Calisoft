<div class="modal fade" id="ayuda">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ayuda del módulo para la gestión de casos de prueba.</h5>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#0E3D38;">
                            <h4 class="panel-title" >
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseHelp">
                                    <label class="font-white">Funciones del módulo de Testing.</label>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseHelp" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul><li>En la parte superior se encuentra una barra de proceso que indica el porcentaje del proceso de Testing.
                                    </li>
                                    <li>En el apartado se enlistan los inputs que se encuentren en el formulario que subió el desarrollador.
                                    </li>
                                    <li>La tabla muestra el tipo de input, nombre, reglas html que implementó el desarrollador, input donde se ejecuta la prueba 
                                        y un estado que informa si pasa la prueba o no.
                                    </li>
                                    <li>Para generar el proceso de Testing basta con dar clic en "MODO ASISTIDO" y el software se encargará de realizar las 
                                        pruebas de manera automática. 
                                    </li>
                                    <li>La segunda opción es dar clic sobre el botón "CARGAR PRUEBA" donde de forma automática se cargan los datos correspondientes al 
                                        tipo de input detectado. para cada prueba debe dar clic en el botón "GUARDAR PRUEBA" y así sucesivamente hasta completar la barra
                                        de proceso. 
                                    </li> 
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
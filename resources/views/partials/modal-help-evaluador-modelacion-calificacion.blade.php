<div class="modal fade" id="ayuda">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ayuda del módulo para la calificación del modelado.</h5>
            </div>
            <div class="modal-body">
              <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                      <div class="panel-heading" style="background-color:#0E3D38;">
                          <h4 class="panel-title" >
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseHelp">
                                  <label class="font-white">Funciones del módulo para la calificación</label></a>
                          </h4>
                      </div>
                      <div id="collapseHelp" class="panel-collapse collapse">
                          <div class="panel-body">
                            <ul>

                              <li>Al lado izquierdo se observa el documento que subió el desarrollador. 
                              </li>
                              <li>En la parte derecha se enlistan todos los componentes que pertenecen a ese tipo de documento, los componentes que contengan una "R"
                                  serán los componentes que son de calificación obligatoria.
                              </li>
                              <li>Al dar clic en un componente se desplegará un sub menú que contiene un campo de obsevación donde el evaluador podrá 
                              poner una recomendación o la causa de la calificación (no es un campo obligatorio), un input que tiene dos estados, 
                              sí valido y no valido, que corresponde a la calificación positiva o negativa que el evaluador puede dar, 
                              una vez seleccionada la calificación se debe dar clic en el botón "GUARDAR" para guardar la calificación.
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
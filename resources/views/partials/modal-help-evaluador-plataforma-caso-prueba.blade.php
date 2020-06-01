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
                                    <label class="font-white">Funciones del módulo para interactuar con casos de prueba.</label>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseHelp" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li>Para crear un caso prubea basta con dar clic en el botón verde "CREAR CASO PRUEBA" y diligenciar el formulario que aparecerá
                                        en un modal (el apartado de abajo enseña la especificación de cada campo). 
                                    </li>
                                    <li>Una vez creado el caso de prueba, se mostrará en la parte de abajo con tres opciones. 
                                    <br><strong>-Detalles:</strong> Primera permite ver los detalles del caso prueba.
                                    <br><strong>-Calificar:</strong> Inicia deshabilitdad hasat que el desarrollador suba el formulario, cuando el desarrollador suba un formulario
                                    se habilitará y su función es redirigir al módulo que realiza el proceso de Testing.
                                    <br><strong>-Elimiar:</strong> Elimina el caso prueba seleccionado.
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#0E3D38;">
                            <h4 class="panel-title" >
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseHelp2">
                                    <label class="font-white">Descripción de los campos del formulario para crear casos de pruebas.</label>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseHelp2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li><strong>Nombre de la prueba:</strong> Cada caso de prueba debe tener un nombre que lo identifique, debe ser algo corto y entendible 
                                    para el desarrollador. 
                                    </li>
                                    <li><strong>Propósito:</strong> Cuando se crea un caso de prueba se debe decir el propósito, lo que se propone a realizar especificando 
                                    un fin, también es un objetivo importante y amplio a largo plazo. 
                                    </li>
                                    <li><strong>Alcance:</strong> En el caso de prueba se debe especificar hasta donde llega el propósito, que es lo que se pretende evaluar
                                     y de acuerdo a esto el desarrollador podrá saber hasta dónde tiene que subir la prueba.
                                    </li>
                                    <li><strong>Resultados esperados:</strong> En esta parte de las especificaciones el evaluador da entender al desarrollador que es lo que
                                     espera de la prueba, cuáles son los resultados que sebe obtener al finalizar la prueba. 
                                    </li>
                                    <li><strong>Criterios a evaluar:</strong> El desarrollador debe conocer además del propósito y los resultados esperados todos los
                                     criterios del evaluador, son cada uno de las pruebas que se van a realizar al caso de prueba, así el desarrollador
                                      podrá subir la prueba mostrando estos criterios, por ejemplo, validación de cajas de texto, que no halla inconsistencias
                                       con los requerimientos, y que la funcionalidad se cumpla entre otras. 
                                    </li>  
                                    <li><strong>Prioridad:</strong> Una especificación más es la prioridad, la prioridad es una configuración realizada por el administrador
                                     y el evaluador tiene tres opciones para clasificarla según los requerimientos, estos tres tipos son prioridad alta, 
                                     media y baja, de esta manera le da más importancia o mayor valor a unos casos de prueba respecto a otros.
                                    </li>  
                                    <li><strong>Fecha límite:</strong> Cada caso de prueba tiene un tiempo mínimo para poder subir la prueba, si esa fecha se incumple 
                                    y se vence el plazo de subir la prueba, el desarrollador ya no tendrá acceso a subir la prueba, en ese caso el evaluador 
                                    tiene la opción de modificar la fecha, pero ya quedaría a su propio criterio.
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

@extends('layouts.dash')
@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-database', 'title' => 'Estandar de Base de Datos'])
       
            <div class="portlet-body">
                <p align="justify">
                    Con este proyecto se busca desarrollar una herramienta para evaluar la calidad y modelación de las
                    bases de datos, creadas por los estudiantes de ingeniería de sistemas de la universidad de
                    Cundinamarca, con el fin de mejorar el uso, creación de la estructura y los componentes
                    elaborados. 
                </p>
                <p align="justify">
                    Esta herramienta facilitará los parámetros en los estándares aplicados para 
                    determinar el grado de las necesidades de los usuarios permitiendo evaluar el 
                    nivel en que los modelos correspondan a los datos que se desean almacenar.
                </p>
                <p align="justify">
                    El desarrollo está basado en la norma ISO/IEC 25012- ISO/IEC 19139 que presenta 
                    de forma detallada los modelos de calidad de software y datos en la cual 
                    establecen las características externas que a su vez se descomponen en 
                    sub-características y proporcionando consejos prácticos sobre el uso de modelos. 
                </p>                
                <p align="justify">
                    En el siguiente documento de la republica de Colombia, se presenta la forma 
                    adecuada de hacer uso del estandar, en el lineamiento para nombramiento de 
                    bases de datos. Con el obejtivo de describir el desarrollo en las areas de 
                    informacion y de sistemas, tenido en cuenta los componentes que se evaluaran 
                    en los archivos sql.
                </p>     
                <div class="row">
                    <!-- Boton de crear usuario -->
                    <div class="col-sm-10">
                        <button class="btn green-jungle center-block" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-book"></i>
                            Ver Estandar
                        </button>
                    </div>
                </div> 
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Guia de Estandar de Base de Datos.</h4>
                            </div>
                            <div class="modal-body">
                                <embed src="http://es.presidencia.gov.co/dapre/DocumentosSIGEPRE/L-TI-12-denominacion-bases_de_datos.pdf" frameborder="0" width="100%" height="400px">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn green-jungle" data-dismiss="modal">Cerrar</button>
                            </div>
                         </div>

                    </div>
                </div>          
            </div>        
    @endcomponent
</div>
@endsection

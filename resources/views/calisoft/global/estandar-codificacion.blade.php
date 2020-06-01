
@extends('layouts.dash')
@section('content')
<div class="col-md-12">
    @component('components.portlet', ['icon' => 'fa fa-code', 'title' => 'Estandar de Codificación'])
       
            <div class="portlet-body">
                <p align="justify">
                     La siguiente tabla que se presta a continuación es un manual de uso del estándar de codificación seleccionado por el semillero de ¨aplicaciones móviles¨ para el desarrollo de aplicativos web en la universidad de Cundinamarca, que utilicen el lenguaje de programación de PHP 
                    Se establecen 7 directrices de calificación que son los más relevantes en el momento de escribir código entre las cuáles se presentan a continuación 
                            
                </p>
                <div class="tabbable tabbable-tabdrop">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">Variables </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">Clases</a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">Funciones</a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">Constantes</a>
                        </li>
                        <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> Indentación
                                        <i class="fa fa-angle-down"></i>
                                </a>
                                
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                             <a href="#tab5-1" data-toggle="tab" tabindex="-1">Forma Correcta</a>
                                        </li>
                                        <li>
                                                <a href="#tab5-2" data-toggle="tab" tabindex="-1">Forma Incorrecta 1</a>
                                        </li>
                                        <li>
                                                <a href="#tab5-3" data-toggle="tab" tabindex="-1">Forma Incorrecta 2</a>
                                        </li>   
                                    </ul> 
                                       
                        </li>
                        <li>
                            <a href="#tab6" data-toggle="tab">Comentarios</a>
                        </li>
                        <li>
                            <a href="#tab7" data-toggle="tab">Espacios De Nombre</a>
                        </li>
                        
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <p align="justify">
                                    La notación recomendada para la declaración de variables es la 
                                    notación lowerCamelCase está consiste en que cuando las variables
                                     formadas por más de una palabra cada una de estas deberá iniciar
                                      en mayúscula exceptuando la primera palabra, si la palabra 
                                      conlleva guiones bajos en una posición diferente a la inicial 
                                      la declaración será errónea, también la longitud mínima de una 
                                      variable es de 3 caracteres exceptuando las variables $i, $j, $k 
                                      que se utilizan en los ciclos “for”.
                            </p>
                            
                        <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-variables.jpg" alt="ejemplo variables" > 
                        </div>
                        <div class="tab-pane" id="tab2">
                            <p>
                                    La notación recomendada para la declaración de clases es la notación UpperCamelCase 
                                    está consiste en que cuando las clases formadas por más de una palabra cada una de 
                                    estas deberá iniciar en mayúscula, si la clase tiene una sola palabra su primera letra 
                                    estará en mayúscula, si la palabra conlleva guiones bajos en una posición diferente a la 
                                    inicial la declaración será errónea, también la longitud mínima de una clase es de 3 
                                    caracteres   

                            </p>
                            <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-clases.jpg" alt="ejemplo clases" >  
                        </div>
                        <div class="tab-pane" id="tab3">
                            <p>
                                    La notación recomendada para la declaración de funciones es la notación lowerCamelCase 
                                    está consiste en que cuando las funciones formadas por más de una palabra cada una de 
                                    estas deberá iniciar en mayúscula exceptuando la primera palabra, si la palabra conlleva
                                     guiones bajos en una posición diferente a la inicial la declaración será errónea, también 
                                     la longitud mínima de una función es de 3 caracteres.
                            </p>
                            <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-funciones.jpg" alt="ejemplo funciones" >  
                        </div>
                        <div class="tab-pane" id="tab4">
                            <p>
                                    La notación recomendada para la declaración de constantes es la notación 
                                    Snake Case está consiste en que las constantes serán declaradas totalmente 
                                    en mayúsculas y si esta está compuesta por más de una palabra debe estar 
                                    separada por un underscore o guion abajo, también la longitud mínima de una 
                                    constante es de 3 caracteres.
                            </p>
                            <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-constantes.jpg" alt="ejemplo constantes" >  
                        </div>
                        <div class="tab-pane" id="tab5-1">
                            <p>La indentación se puede expresar como la sangría que debe tener cada estructura de código.
                                    Entiéndase por estructura de control “if”, “else”, “while”, “for”, etc. para este estándar se definió una indentación mínima de 4 espacios, lo que corresponde a una tabulación, aunque el espacio puede ser mayor, cabe resaltar que cada elemento que este dentro de la estructura debe respetar el mismo espaciado que los demás, toda estructura declarada debe siempre llevar las llaves de apertura y cierre aun cuando esté compuesta por una sola sentencia y la sentencia debe ir después de la estructura (no pueden ir en la misma línea)
                            </p>
                            <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-identacion1.jpg" alt="ejemplo indentacion" >  
                        </div>
                        <div class="tab-pane" id="tab5-2">
                                <p>
                                    forma incorrecta 1
                                </p>
                                <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-identacion2.jpg" alt="ejemplo indentacion" >  
                        </div>
                        <div class="tab-pane" id="tab5-3">
                                <p>
                                        forma incorrecta 2
                                </p>
                                <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-identacion3.jpg" alt="ejemplo indentacion" >  
                        </div>
                        <div class="tab-pane" id="tab6">
                            <p>
                                    cuando se declare una clase o una función debe ser comentada 
                                    en su cabecera, el no realizar un comentario la declaración 
                                    será errónea 
                            </p>
                            <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-comentarios.jpg" alt="ejemplo comentarios" >  
                        </div>
                        <div class="tab-pane" id="tab7">
                            <p>
                                    La notación recomendada para la declaración de espacios de 
                                    nombre es la notación UpperCamelCase está consiste en que 
                                    cuando los espacios de nombre formados por más de una palabra 
                                    cada una de estas deberá iniciar en mayúscula, si el espacio 
                                    de nombre tiene una sola palabra su primera letra estará en 
                                    mayúscula, si la palabra conlleva guiones bajos en una posición 
                                    diferente a la inicial la declaración será errónea, 
                                    también la longitud mínima de un espacio de nombre es de 3 
                                    caracteres
                            </p>
                            <img class="img-responsive center-block img-rounded" src="/img/estandar-codificacion/ejemplo-espacios-nombre.jpg" alt="ejemplo espacios de nombre" >  
                        </div>
                        
                    </div>
                </div>
                
               
                
            </div>
        </div>
        
    @endcomponent
</div>
@endsection

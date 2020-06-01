<!--Estilos para la tabview-->
<style>
    body {font-family: Arial;}
    .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    }
    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
    }
    .tab button:hover {
    background-color: #ddd;
    }
    .tab button.active {
    background-color: #ccc;
    }
    .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
    }
    </style>
    <!--Fin de estilos para la tabview-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(graficaDePuntos);
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(horizontal);
    google.charts.setOnLoadCallback(dispersion);
    //Grafica lineal 
    function drawChart() {
        //para la grafica de resultados generales por modulo
        var data = google.visualization.arrayToDataTable([
            ['Resultado', 'por modulo'],
            ['Modelado',{{$modelado}}],
            ['Plataforma',{{$plataforma}}],
            ['Codificacion',{{$codificacion}}],
            ['Base de datos',{{$resultadoBD}}]
        ]);
        var options = {
        title: 'Resultado por modulo',
        is3D: true,
        };
        //Para la grafica de valor faltante
        var falta= 100-{{$total}}
        var data2 = google.visualization.arrayToDataTable([
            ['Faltante', 'por alcanzar'],
            ['Alcance',{{$total}}],
            ['Faltante',falta],
        ]);
        var options2 = {
        title: 'Alcance',
        is3D: true,
        };
        //Llenar la grafica resultados generales
        var chart = new google.visualization.PieChart(document.getElementById('resultsPerModule'));
            chart.draw(data, options);
        //Llenar la grafica resultados generales
        var chart2 = new google.visualization.PieChart(document.getElementById('alcance'));
            chart2.draw(data2, options2);
        }
        //Grafica de puntos
        function graficaDePuntos() {
        var faltanteModelado = 100-{{$modelado}}
        var faltantePlataforma = 100-{{$plataforma}}
        var faltanteCodigo = 100-{{$codificacion}}
        var faltanteBD = 100-{{$resultadoBD}}
        var sumatoria = {{$modelado}}+{{$plataforma}}+{{$codificacion}}+{{$resultadoBD}}
        var data = google.visualization.arrayToDataTable([
          ['Modulo', 'Nota', 'Faltante','Porcentaje modular / proyecto'],
          ['Modelado',  {{$modelado}},faltanteModelado,((100*{{$modelado}})/sumatoria)],
          ['Plataforma',  {{$plataforma}},faltantePlataforma,((100*{{$plataforma}})/sumatoria)],
          ['Codificación',  {{$codificacion}},faltanteCodigo,((100*{{$codificacion}})/sumatoria)],
          ['Base de datos',  {{$resultadoBD}},faltanteBD,((100*{{$resultadoBD}})/sumatoria)]
        ]);

        var options = {
          title: 'Rango alcanzado vs. Nota faltante',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      //Grafica horizontal
      function horizontal() {
        var sumatoria = {{$modelado}}+{{$plataforma}}+{{$codificacion}}+{{$resultadoBD}}
        var data = google.visualization.arrayToDataTable([
            ['Resultados', 'Alcance ', { role: 'style' }],
            ['Modelado', {{$modelado}}, 'color: #16a085; opacity: 0.2'],
            ['Plataforma', {{$plataforma}}, 'color: #2ecc71; opacity: 0.2'],
            ['Codificación', {{$codificacion}},'color: #e67e22; opacity: 0.2'],
            ['Base de datos', {{$resultadoBD}},'color: #6c5ce7; opacity: 0.2']
        ]);

        var materialOptions = {
            chart: {
            title: 'Alcance por modulo',
            subtitle: 'puntaje, alcance o nota obtenida y seccionada por modulo'
            },
            hAxis: {
            title: 'Logro'
            },
            vAxis: {
            title: 'Modulo'
            },
            bars: 'horizontal',
            series: {
            0: {axis: '2010'}
            },
            axes: {
            x: {
                2010: {label: 'Modulo', side: 'top'}
            }
            }
        };
        var materialChart = new google.charts.Bar(document.getElementById('horizon'));
        materialChart.draw(data, materialOptions);
        }
    function dispersion() {

        var data = google.visualization.arrayToDataTable([
          ['Dispersion','Mi proyecto', 'Promedio'],
          ['Modelado',{{$modelado}}, {{$promedioGeneralDocumentos}}],
          ['Plataforma', {{$plataforma}}, {{$promedioGeneralCasos}}],
          ['Codificacion', {{$codificacion}}, {{$promedioGeneralCodificacion}}],
          ['Base de Datos', {{$resultadoBD}}, {{$promedioGeneralBD}}],
          ['Total', {{$total}}, {{$promedioGeneralTotal}}]
        ]);

        var options = {
          title: 'Dispersion de resultados del proyecto',
          hAxis: {title: 'Dispersion', minValue: 0, maxValue: 15},
          vAxis: {title: 'Promedio', minValue: 0, maxValue: 15},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('disperso'));

        chart.draw(data, options);
      }
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(correlacion);

      function correlacion() {

        var data = google.visualization.arrayToDataTable([
          ['Modulo',        'Promedio general',                 'Proyecto',         'Diferencia'],
          ['Modelado',      {{$promedioGeneralDocumentos}},     {{$modelado}},      Math.abs({{$promedioGeneralDocumentos}}-{{$modelado}})],
          ['Plataforma',    {{$promedioGeneralCasos}},          {{$plataforma}},    Math.abs({{$promedioGeneralCasos}}-{{$plataforma}})],
          ['Codificacion',  {{$promedioGeneralCodificacion}},   {{$codificacion}},  Math.abs({{$promedioGeneralCodificacion}}-{{$codificacion}})],
          ['Base de datos', {{$promedioGeneralBD}},             {{$resultadoBD}},   Math.abs({{$promedioGeneralBD}}-{{$resultadoBD}})],
          ['Total',         {{$promedioGeneralTotal}},          {{$total}},         Math.abs({{$promedioGeneralTotal}}-{{$total}})],
        ]);

        var options = {
            title: 'Si el circulo del modulo tiende a estar de color amarillo significa que esta igual o cerca del promedio de proyectos',
          colorAxis: {colors: ['#ffa801', '#eb3b5a']}
        };

        var chart = new google.visualization.BubbleChart(document.getElementById('correlacionado'));
        chart.draw(data, options);
      }
    </script>

@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        @component('components.portlet', [
            'icon' => 'fa fa-calculator', 
            'title' => 'Proyecto: '.$nombrePj
            ])
            <div id="app">
                <div class="row">
                    <!-- BARRA DE NAVEGACION -->                    
                    <div class="tab">
                        <button style="color: #2980b9;" class="tablinks"><b>{{link_to_route('resultadosAdmin', 'Lista de resultados')}}</b></button>
                        <button style="color: #2980b9;" class="tablinks"><b>{{link_to_route('informe-individual','Ver otras opciones',['id' => Crypt::encryptString($pj['0']->PK_id)])}}</b></button>
                    </div>
                </div>
                    <!-- RESULTADOS -->
                <br/>
                <h4 style="color: #7f8c8d">Filtrar diagramas o graficos</h4>
                <select class="form-control" name="valor" id="valor" onchange="ShowSelected()">
                    <option disabled value="" >--Escoger una opcion--</option>
                    <option id="5" value="todos">Mostrar todas</option>
                    <option id="4" value="dispersion">Diagrama de dispersion</option>
                    <option id="1" value="pastel">Diagrama de pastel</option>
                    <option id="2" value="puntos">Diagrama de lineas</option>
                    <option id="3" value="horizontal">Diagrama de barras (Horizontal)</option>
                    <option id="6" value="correlacion">Correlacion</option>
                </select>
                <br/>
                <br/>
                <div aling="center">
                    <h4 id="anotacionDispersa" align="center" style="color: #7f8c8d">Algunas calificaciones de su proyecto no pueden aparecer, lo cual significa que su proyecto en ese modulo obtuvo el mismo puntaje</h4>
                    <div id="disperso" align='center' style="width: 100%; height: 100%"></div>
                    <br/>
                    <hr id="separador1">
                    <br/>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">
                                    <div id="resultsPerModule" aling="center" style="width: 100%; height: 300%;" ></div>
                                </td>
                                <td style="width: 50%;">
                                    <div id="alcance" aling="center" style="width: 100%; height: 300%;" ></div>        
                                </td>
                            </tr>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <hr id="separador2">
                    <div id="curve_chart" align='center' style="width: 100%; height: 100%"></div>
                    <br/>
                    <br/>
                    <hr id="separador3">
                    <div id="horizon" align='center' style="width: 80%; height: 80%"></div>
                    <br/>
                    <hr id="separador4">
                    <div id="correlacionado" style="width: 80%; height: 80%;"></div>
                </div>
                @include('partials.modal-help-admin-grafico-general')
                </div>
            </div>
        @endcomponent  
    </div>
@endsection
<script type="text/javascript">
    function ShowSelected()
    {
    /* Para obtener el valor de cada option del select*/
        var opcion = document.getElementById("valor").value;

        /*Inicio de validacion para mostrar u ocultar alguna grafica*/
        if(opcion == "pastel"){
            document.getElementById("separador1").style.display = "none";
            document.getElementById("separador2").style.display = "none";
            document.getElementById("separador3").style.display = "none";
            document.getElementById("anotacionDispersa").style.display = "none";
            document.getElementById("resultsPerModule").style.display = "block";
            document.getElementById("alcance").style.display = "block";
            document.getElementById("curve_chart").style.display = "none";
            document.getElementById("horizon").style.display = "none";
            document.getElementById("disperso").style.display = "none";
            document.getElementById("separador4").style.display = "none";
            document.getElementById("correlacionado").style.display = "none";
        }
        if(opcion == "puntos"){
            document.getElementById("separador1").style.display = "none";
            document.getElementById("separador2").style.display = "none";
            document.getElementById("separador3").style.display = "none";
            document.getElementById("resultsPerModule").style.display = "none";
            document.getElementById("anotacionDispersa").style.display = "none";
            document.getElementById("alcance").style.display = "none";
            document.getElementById("horizon").style.display = "none";
            document.getElementById("curve_chart").style.display = "block";
            document.getElementById("disperso").style.display = "none";
            document.getElementById("separador4").style.display = "none";
            document.getElementById("correlacionado").style.display = "none";
        }
        if(opcion == "horizontal"){
            document.getElementById("separador1").style.display = "none";
            document.getElementById("separador2").style.display = "none";
            document.getElementById("separador3").style.display = "none";
            document.getElementById("resultsPerModule").style.display = "none";
            document.getElementById("anotacionDispersa").style.display = "none";
            document.getElementById("alcance").style.display = "none";
            document.getElementById("horizon").style.display = "block";
            document.getElementById("curve_chart").style.display = "none";
            document.getElementById("disperso").style.display = "none";
            document.getElementById("separador4").style.display = "none";
            document.getElementById("correlacionado").style.display = "none";
        }
        if(opcion == "dispersion"){
            document.getElementById("separador1").style.display = "none";
            document.getElementById("separador2").style.display = "none";
            document.getElementById("separador3").style.display = "none";
            document.getElementById("resultsPerModule").style.display = "none";
            document.getElementById("alcance").style.display = "none";
            document.getElementById("horizon").style.display = "none";
            document.getElementById("curve_chart").style.display = "none";
            document.getElementById("disperso").style.display = "block";
            document.getElementById("anotacionDispersa").style.display = "block";
            document.getElementById("separador4").style.display = "none";
            document.getElementById("correlacionado").style.display = "none";
        }
        if(opcion == "todos"){
            document.getElementById("separador1").style.display = "block";
            document.getElementById("separador2").style.display = "block";
            document.getElementById("separador3").style.display = "block";
            document.getElementById("resultsPerModule").style.display = "block";
            document.getElementById("alcance").style.display = "block";
            document.getElementById("horizon").style.display = "block";
            document.getElementById("curve_chart").style.display = "block";
            document.getElementById("disperso").style.display = "block";
            document.getElementById("anotacionDispersa").style.display = "block";
            document.getElementById("separador4").style.display = "block";
            document.getElementById("correlacionado").style.display = "block";
        }
        if(opcion == "correlacion"){
            document.getElementById("separador1").style.display = "none";
            document.getElementById("separador2").style.display = "none";
            document.getElementById("separador3").style.display = "none";
            document.getElementById("resultsPerModule").style.display = "none";
            document.getElementById("alcance").style.display = "none";
            document.getElementById("horizon").style.display = "none";
            document.getElementById("curve_chart").style.display = "none";
            document.getElementById("disperso").style.display = "none";
            document.getElementById("anotacionDispersa").style.display = "none";
            document.getElementById("separador4").style.display = "block";
            document.getElementById("correlacionado").style.display = "block";
        }
    }
</script>
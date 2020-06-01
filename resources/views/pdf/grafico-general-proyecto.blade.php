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
        ['Modulo', 'Alcance', 'Faltante','Porcentaje'],
        ['Modelado',  {{$modelado}},faltanteModelado,((100*{{$modelado}})/sumatoria)],
        ['Plataforma',  {{$plataforma}},faltantePlataforma,((100*{{$plataforma}})/sumatoria)],
        ['Codificación',  {{$codificacion}},faltanteCodigo,((100*{{$codificacion}})/sumatoria)],
        ['Base de datos',  {{$resultadoBD}},faltanteBD,((100*{{$resultadoBD}})/sumatoria)]
    ]);

    var options = {
        title: 'Meta alcanzada vs. Meta faltante',
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
    google.visualization.events.addListener(chart, 'ready', function () {
        correlacionado.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });

    chart.draw(data, options);
    }
</script>
@extends('pdf.master')

@section('body')
    <div class="text-center">
        <h3>{{ $pj[0]->nombre }} - Diagramas, dibujos y graficos</h3>
        <hr>
    </div>
    <div id="app">
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
@endsection
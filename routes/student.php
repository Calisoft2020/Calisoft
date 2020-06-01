<?php

use App\Container\Calisoft\Src\Controllers\StudentController;

Route::get('/proyectos', 'StudentController@proyectos')
    ->name('proyectos')
    ->middleware('create-project');

Route::post('/proyectos', 'ProyectoController@store')
    ->name('proyectos.store')
    ->middleware('create-project');

Route::get('/documentacion', 'StudentController@documentos')
    ->name('documentacion');

Route::get('/invitaciones', 'StudentController@invitaciones')
    ->name('invitaciones');

Route::get('/modelobd', 'StudentController@modelobd')
    ->name('modelobd');

Route::get('/documentosCodificacion','StudentController@documentosCodificacion')
    ->name('documentosCodificacion');

Route::get('documentosBd','StudentController@documentosBd')
    ->name('documentosBd');

Route::get('/plataformaStudent','StudentController@plataforma')
    ->name('plataformaStudent');

Route::get('/resultados','StudentController@resultados')
    ->name('resultados');

Route::get('/resultados/porcentaje-general','StudentController@resultadoGeneral')
    ->name('porcentaje-general');

Route::get('/resultados/grafica-general','StudentController@resultadosGraficas')
    ->name('grafica-general');

Route::get('/resultados/especificos','StudentController@resultadosEspecificos')
    ->name('resultados-especificos');

Route::get('/resultados/especificos/sugerencias','StudentController@sugerencias')
    ->name('resultados-especificos-sugerencias');

Route::prefix('evaluacion')->group(function () {

    Route::get('modelacion', 'StudentController@evaluacionModelado')
        ->name('evalucion.modelacion');

    Route::get('/basedatos','StudentController@basedatos')
        ->name('evaluacion.basedatos');
        
    Route::get('/codificacion','StudentController@evaluacionCodificacion')
        ->name('evaluacion.codificacion');
    
        
});


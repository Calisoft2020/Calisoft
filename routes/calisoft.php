<?php
Route::prefix('/perfil')->group(function () {
    Route::get('/', 'PerfilController@index')->name('perfil.index');
    Route::post('/', 'PerfilController@update')->name('perfil.update');
    Route::post('password', 'PerfilController@updatePassword')->name('perfil.password');
    Route::post('foto', 'PerfilController@fotoUp')->name('perfil.foto');
});


Route::get('porcentajes', 'UserController@porcentajes')->name('porcentajes');
Route::get('porcentajesbd', 'UserController@porcentajesBD')->name('porcentajesbd');

Route::get('/estandar-codificacion','UserController@estandaresCodificacion')
->name('estandar-codificacion');

Route::get('/estandar-basedatos','UserController@estandaresBasedatos')
->name('estandar-basedatos');

Route::get('porcentajesCodificacion', 'UserController@porcentajesCodificacion')->name('porcentajesCod');


Route::get('/notificaciones', 'NotificationController@vista')->name('notificaciones');



Route::prefix('pdf')->group(function () {

    Route::post('usuarios', 'PDFController@usuarios')->name('pdf.usuarios');
    Route::post('proyecto/{proyecto}/modelacion', 'PDFController@modelacion')->name('pdf.modelacion');
    Route::post('proyecto/{proyecto}/codificacion', 'PDFController@scripts')->name('pdf.scripts');
    Route::post('proyecto/{proyecto}/basedatos','PDFController@basedatos')->name('pdf.basedatos');
    Route::post('proyecto/{proyecto}/plataforma', 'PDFController@plataforma')->name('pdf.plataforma');
    Route::post('proyecto/{proyecto}/total', 'PDFController@total')->name('pdf.total');
    Route::post('codificacion','PDFController@codificacionTotal')->name('pdf.codificacion');
    Route::post('resultado-general','PDFController@studentResultadoGeneral')->name('pdf.resultado-general');
    Route::post('resultado-general-porcentaje','PDFController@studentPorcentajeGeneral')->name('pdf.resultado-general-porcentaje');
    Route::post('tabla-resultado-general','PDFController@studentTablaGeneral')->name('pdf.tabla-resultado-general');
    Route::post('resultados-evaluado', 'PDFController@resultadoEvaluado')->name('pdf.lista-general-evaluado');
    Route::post('lista-proyectos-evaluados', 'PDFController@listaProyectosAdmin')->name('pdf.lista-proyectos-evaluados-admin');
    Route::post('resultadosAdmin/admin-porcentaje-general/{id}', 'PDFController@porcentajeGeneralAdmin')->name('pdf.admin-porcentaje-general');
    Route::post('resultadosAdmin/admin-tabla-general/{id}', 'PDFController@tablaGeneralAdmin')->name('pdf.admin-tabla-general');
    Route::post('resultadosAdmin/grafica-general-admin/{id}', 'PDFController@graficaGeneralAdmin')->name('pdf.grafica-general-admin');
    Route::post('evaluator/porcentajes/{id}', 'PDFController@porcentajeGeneralEvaluador')->name('pdf.porcentaje-evaluator');
    Route::post('evaluator/tablas/general/{id}', 'PDFController@tablasEvaluador')->name('pdf.tablas-evaluator-general');
    Route::post('resultados/especificos/sugerencia/{proyecto}', 'PDFController@sugerencias')->name('pdf.student-sugerencia');
    Route::post('resultados/especificos/{proyecto}', 'PDFController@especifico')->name('pdf.student-especifico');
});

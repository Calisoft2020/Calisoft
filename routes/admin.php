<?php


Route::get('/semilleros', 'AdminController@semilleros')->name('semilleros');
Route::get('/categorias', 'AdminController@categorias')->name('categorias');
Route::get('/usuarios', 'AdminController@usuarios')->name('usuarios');
Route::get('/tdocumentos', 'AdminController@tipoDocumento')->name('tdocumentos');
Route::get('/proyecto', 'AdminController@proyectos')->name('proyecto.admin');
Route::get('/tdocumentos/{tdocumento}/componentes', 'AdminController@componentes')->name('componentes');
Route::get('/basedatos', 'AdminController@baseDatos')->name('basedatos');
Route::get('/codificacion','AdminController@codificacion')->name('codificacion');
Route::get('/resultadosAdmin','AdminController@resultados')->name('resultadosAdmin');
//Resultado individual de proyecto
Route::get('/resultadosAdmin/individual/{id}','AdminController@resultadoIndividual')->name('informe-individual');
//Busqueda filtro de proyectos en tiempo real
Route::get('/search','AdminController@busquedaProyecto')->name('search');
//Graficas generales
Route::get('/admin-grafica-general{id}','AdminController@resultadoGraficoGeneral')->name('admin-grafica-general');

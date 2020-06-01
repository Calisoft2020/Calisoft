<?php

// CRUD de Semilleros
Route::resource('semilleros', 'SemilleroController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);

// CRUD de Grupos de investigación
Route::resource('grupos-de-investigacion', 'GrupoDeInvestigacionController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);

// CRUD de categorias de proyecto
Route::resource('categorias', 'CategoriaController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);

// CRUD de usuarios
Route::resource('usuarios', 'UserController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);

// CRUD de los tipos de diagramas UML
Route::resource('tdocumentos', 'TiposDocumentoController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);

// Consulta los componentes de n tipo de documento
Route::get('tdocumentos/{tdocumento}/componentes', 'TiposDocumentoController@getComponents')
    ->name('tdocumentos.componentes');

// Crea, Actualiza y Elimina los componentes de n tipo de diagrama 
Route::resource('componentes', 'ComponenteController', [
    'only' => ['store', 'update', 'destroy'],
    'parameters' => [
        'componentes' => 'componente'
    ]
]);

// CRUD de proyectos
Route::resource('proyectos', 'ProyectoController', [
    'only' => ['index', 'update', 'destroy', 'show'],
]);

// Consulta los evaluadores para asignarlos a proyectos
Route::get('/evaluator/search', 'UserController@searchEvaluators');

// Consulta y Actualiza las metricas de calificacion del codigo fuente
Route::resource('codificacion', 'ItemsCodificacionController', [
    'only' => ['index', 'update'],
]);

// Ruta de almacenar el tipo de nomenclatura
Route::resource('basedatos', 'BaseDatosController', [
    'only' => ['index', 'store', 'update', 'destroy'],
]);